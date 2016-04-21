<?php

namespace MatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use JMS\Serializer\SerializationContext;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;

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
     * @Rest\Get("/matchs/team/{id}", name="")
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
     * @Rest\Post("/matchs/team/score", name="")
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
     *      404="Returned when match not found"
     * }
     * )
    */
    public function scoreTeamMatchAction()
    {
        $em = $this->getDoctrine()->getManager();
        $matchs = $em->getRepository('MatchBundle:Versus')->findAll();
        
        return $matchs;
    }
}
