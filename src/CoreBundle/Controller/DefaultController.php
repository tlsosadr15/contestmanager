<?php
/**
 * DefaultController file
 *
 * PHP Version 7
 *
 * @category Controller
 * @package  CoreBundle\Controller
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * DefaultController class
 *
 * @category Controller
 * @package  CoreBundle\Controller
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
class DefaultController extends Controller
{
    /**
     * tournament action
     *
     * @return RedirectResponse
     */
    public function tournamentAction()
    {
        return new RedirectResponse('/');
    }

    /**
     * Mobile app action
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function mobileAppUploadAction(Request $request)
    {
        $form = $this->createFormBuilder()
          ->add('appAndroid', FileType::class, array('required' => false))
          ->add('appIos', FileType::class, array('required' => false))
          ->getForm();

        if ($request->isMethod('GET')) {
            return $this->render('CoreBundle:Default:app_upload.html.twig', array('form' => $form->createView()));
        }

        foreach ($request->files as $uploadedFiles) {
            /** @var UploadedFile $uploadedFile */
            foreach ($uploadedFiles as $uploadedFile) {
                if ($uploadedFile) {
                    $directory = $this->container->get('kernel')->getRootDir().'/../web/upload';
                    if (!is_dir($directory)) {
                        mkdir($directory);
                    }
                    $uploadedFile->move($directory, $uploadedFile->getClientOriginalName());
                }
            }
        }

        return $this->render('CoreBundle:Default:app_upload.html.twig', array(
              'success' => 'File uploaded',
              'form' => $form->createView(),
        ));
    }

    /**
     * Mobile app action
     *
     * @param Request $request
     *
     * @return BinaryFileResponse
     */
    public function mobileAppDownloadAction(Request $request)
    {
        $device = $request->query->get('device');
        $version = $request->query->get('version');

        if (!$device) {
            return $this->render('CoreBundle:Default:app_download.html.twig');
        }

        $extenxion = $device == 'android' ? 'apk' : 'ios';
        $filePath = $this->container->get('kernel')->getRootDir().'/../web/upload/ContestManager-'.$version.'.'.$extenxion;

        if (!is_file($filePath)) {
            return $this->render('CoreBundle:Default:app_download.html.twig', array('error' => 'File ContestManager.'.$extenxion.' not found'));
        }
        $response = new BinaryFileResponse($filePath);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'ContestManager.'.$extenxion);

        return $response;
    }

    /**
     * Mobile app action
     *
     * @param Request $request
     *
     * @return BinaryFileResponse
     */
    public function scoreTournamentsAction(Request $request)
    {
        $idTourament = $request->query->get('id');

        $entityManager = $this->getDoctrine()->getManager();
        $tournament = $entityManager->getRepository('MatchBundle:Tournament')->findOneBy(array('id' => $idTourament));
        $groups = $entityManager->getRepository('MatchBundle:GroupMatch')->findAll();

       /* if( empty($tournaments) ){
            return new JsonResponse('matchs not found', 404);
        }
        */
        $idGroups = $this->getGroupsId($tournament);
        $scores = $this->getTeamsOfGroups($idGroups);
        return $this->render('CoreBundle:Default:scores_tournament.html.twig', array('scores' => $scores));
    }

    /**
     * Get id tournaments of a team
     *
     * @param Tournament $tournament Tournament
     *
     * @return array
     */
    private function getGroupsId($tournament) {
        $allGroups = [];
        $i=0;
        $matchs = $tournament->getMatch();
        foreach ($matchs as $match){
            $scores = $match->getScore()->toArray();
            foreach ($scores as $score){
                $inser = true;
                $idGroup = $score->getTeam()->getGroup()->getId();
                $nameGroup = $score->getTeam()->getGroup()->getName();
                foreach ($allGroups as $group){
                    if($group['idGroup'] == $idGroup) $inser = false;
                }
                if($inser) {
                    $allGroups[$i]['idGroup'] = $idGroup;
                    $allGroups[$i]['nameGroup'] = $nameGroup;
                    $i++;
                }
            }
        }
        return $allGroups;
    }

    /**
     * Get id tournaments of a team
     *
     * @param Tournament $tournament Tournament
     *
     * @return array
     */
    private function getTeamsOfGroups($allGroups) {
        $allTeams = [];
        $i=0;
        foreach ($allGroups as $group){ 
            $teamsGroups = [];
            $idGroup = $group['idGroup'];
            $nameGroup = $group['nameGroup'];
            $entityManager = $this->getDoctrine()->getManager();
            $teams = $entityManager->getRepository('TeamBundle:Team')->findBy(array('group' => $idGroup));
            $allTeams[$i]['idGroup'] = $idGroup;
            $allTeams[$i]['nameGroup'] = $nameGroup;
            foreach ($teams as $team){ 
                $teamBestScore = $team->getBestScore();
                $teamGroupId = $team->getGroup()->getId();
                $nameTeam = $team->getName();
                $teams['nameTeam'] = $nameTeam;
                $teams['bestScoreTeam'] = $teamBestScore;
                $teamsGroups[] = $teams;
            }
            $teamsGroups = $this->trieTeam($teamsGroups);
            $allTeams[$i]['teams'] = $teamsGroups;
            $i++;
        }
        return $allTeams;
    }

    /**
     * Get id tournaments of a team
     *
     * @param Tournament $tournament Tournament
     *
     * @return array
     */
    private function trieTeam($allTeams) {
        $array = [];
        $teamsGroups = [];
        foreach ($allTeams as $team){ 
            $scores[] = $team['bestScoreTeam'];
        }
        arsort($scores);
        foreach ($scores as $score){ 
            foreach ($allTeams as $team){ 
                $teamBestScore = $team['bestScoreTeam'];
                $nameTeam = $team['nameTeam'];
                if($score == $team['bestScoreTeam']){
                    $array['nameTeam'] = $nameTeam;
                    $array['bestScoreTeam'] = $teamBestScore;
                    $teamsGroups[] = $array;
                }
            }
        }
        return $teamsGroups;
    }
}
