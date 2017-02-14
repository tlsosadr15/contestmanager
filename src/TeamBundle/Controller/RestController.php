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
        $entityManager = $this->getDoctrine()->getManager();
        $teams = $entityManager->getRepository('TeamBundle:Team')->findAll();
        
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
        $entityManager = $this->getDoctrine()->getManager();
        $team = $entityManager->getRepository('TeamBundle:Team')->findOneBy(array('id' => $id));
        
        return $team;
    }

}