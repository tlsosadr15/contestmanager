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
     * resource=true,
     * section="Teams",
     * description= "Get all teams",
     * output= "UserBundle\Entity\User"
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
     * resource=true,
     * section="Teams",
     * description= "Get team by id",
     * output="TeamBundle\Entity\Team",
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

}