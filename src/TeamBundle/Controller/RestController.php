<?php

namespace TeamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializationContext;
use FOS\RestBundle\View\View;

class RestController extends Controller
{
    
    public function getTeamsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $teams = $em->getRepository('TeamBundle:Team')->findAll();
        
        return $teams;
    }
    
    public function getTeamAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $team = $em->getRepository('TeamBundle:Team')->findOneBy(array('id' => $id));
        
        return $team;
    }

}