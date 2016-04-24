<?php

namespace TeamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializationContext;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class RestController extends Controller
{
    
    /**
     * @ApiDoc(
     * section="Teams",
     * description= "Get all teams",
     * )
    */
    public function getTeamsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $teams = $em->getRepository('TeamBundle:Team')->findAll();
        
        return $teams;
    }
    
    /**
     * @ApiDoc(
     * section="Teams",
     * description= "Get team by id",
     * requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Id of the team"
     *      }
     *  }
     * )
    */
    public function getTeamAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository('TeamBundle:Team')->findOneBy(array('id' => $id));
        
        return $team;
    }

    /**
     * @Rest\Get("/teams/school/{id}", requirements={"id" = "\d+"})
     * @ApiDoc(
     * section="Teams",
     * description= "TODO - Get teams of the same school",
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
     *      404="Returned when teams not found"
     * }
     * )
    */
    public function schoolTeamsAction($id)
    {
        //TODO
    }

    /**
     * @Rest\Get("/teams/rank")
     * @ApiDoc(
     * section="Teams",
     * description= "TODO - Get rank of teams",
     * statusCodes={
     *      200="Returned when successful",
     *      404="Returned when teams not found"
     * }
     * )
    */
    public function rankTeamsAction($id)
    {
        //TODO
    }

}