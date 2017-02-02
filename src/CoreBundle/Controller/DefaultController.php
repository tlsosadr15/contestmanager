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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * tournament action
     *
     * @return RedirectResponse
     */
    public function selectAction(Request $request)
    {
        if ($request->isMethod('GET')) {
            $data = file_get_contents('https://data.iledefrance.fr/api/records/1.0/search/?dataset=liste_des_etablissements_publics_culture&rows=20&facet=ville&ville=PARIS');
            $records = json_decode($data)->records;
            $items = [];
            foreach ($records as $record) {
                $items[$record->fields->adresse] = $record->fields->structure;
            }

            return new Response($this->render('UserBundle:Default:index.html.twig', array('items' => $items)));
        }
        elseif ($request->isMethod('POST')) {
            $data = $request->request->all();
            $url = 'https://www.google.fr/maps/place/'.$data['address'];

            return new RedirectResponse($url);
        }

    }

}
