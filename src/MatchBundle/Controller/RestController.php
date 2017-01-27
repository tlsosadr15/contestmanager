<?php

namespace MatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializationContext;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use MatchBundle\Entity\Score;

class RestController extends Controller
{
    /**
     * @ApiDoc(
     * section="Matchs",
     * description= "Get all matchs",
     * statusCodes={
     *      200="Returned when successful",
     * }
     * )
    */
    public function matchsAction()  
    {
        $em = $this->getDoctrine()->getManager();
        $matchs = $em->getRepository('MatchBundle:Versus')->findAll();
        
        return $matchs;
    }

    /**
     * @ApiDoc(
     * section="Groups",
     * description= "Get all groups",
     * statusCodes={
     *      200="Returned when successful",
     * }
     * )
    */
    public function groupsMatchsAction()  
    {
        $em = $this->getDoctrine()->getManager();
        $groups = $em->getRepository('MatchBundle:GroupMatch')->findAll();

        //$groups = $groups[0]->__unset('team');
        foreach ($groups as $group){
            $group = $group->__unset('team');
        }

        return $groups;
    }

     /**
     * @ApiDoc(
     * section="Groups",
     * description= "Get team of a group",
     * requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Id Group"
     *      }
     *  },
     * statusCodes={
     *      200="Returned when successful",
     *      404="Returned when the group are not found"
     * }
     * )
    */
    public function getGroupMatchAction($id)  
    {
        $em = $this->getDoctrine()->getManager();
        $matchs = $em->getRepository('MatchBundle:GroupMatch')->findBy(array('id' => $id));

        return $matchs;
    }
    
    /**
     * @Rest\Get("/matchs/{id}", requirements={"id" = "\d+"})
     * @ApiDoc(
     * section="Matchs",
     * description= "Get matchs of by id",
     * requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Id Team"
     *      }
     *  },
     * statusCodes={
     *      200="Returned when successful",
     *      404="Returned when the matchs are not found"
     * }
     * )
    */
    public function idMatchsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $matchs = $em->getRepository('MatchBundle:Versus')->findBy(array('id' => $id));
        if( empty($matchs) ){
            return new JsonResponse('matchs not found', 404);
        }
        
        return $matchs;
    }
    
    /**
     * @Rest\Get("/matchs/team/{id}", requirements={"id" = "\d+"})
     * @ApiDoc(
     * section="Matchs",
     * description= "Get matchs of a team",
     * requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Id Team"
     *      }
     *  },
     * statusCodes={
     *      200="Returned when successful",
     *      404="Returned when the matchs are not found"
     * }
     * )
    */
    public function teamMatchsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $matchs = $em->getRepository('MatchBundle:Score')->findBy(array('team' => $id));
        if( empty($matchs) ){
            return new JsonResponse('matchs not found', 404);
        }
        
        return $matchs;
    }
    
    /**
     * @Rest\Post("/matchs/team/score")
     * @ApiDoc(
     * section="Matchs",
     * description= "Post the score of a team in a match",
     * parameters={
     *      {"name"="id_team", "dataType"="integer", "required"=true, },
     *      {"name"="id_match", "dataType"="integer", "required"=true, },
     *      {"name"="score", "dataType"="integer", "required"=true, }
     * },
     * statusCodes={
     *      200="Returned when successful",
     *      400="Returned when bad request",
     *      404="Returned when match/team not found"
     * }
     * )
    */
    public function scoreTeamMatchAction(Request $request)
    {
        $id_team = $request->get('id_team');
        $id_match = $request->get('id_match');
        $scoreV = $request->get('score');
        
        if(!$id_team || !$id_match || !$scoreV){
            return new JsonResponse('Missing parameter(s)', 400);
        }
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository('TeamBundle:Team')->findOneBy(array('id' => $id_team));
        $match = $em->getRepository('MatchBundle:Versus')->findOneBy(array('id' => $id_match));
        $match->setFinished(true);
        $em->persist($match);
        
        if(!$match || !$team){
            return new JsonResponse('Ressource(s) not found', 404);
        }
        $score = new Score();
        $score->setTeam($team);
        $score->setVersus($match);
        $score->setScore($scoreV);
        $em->persist($score);
        $em->flush();

        return new JsonResponse('Success', 200); 
    }
}
