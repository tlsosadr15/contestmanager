<?php

namespace MatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializationContext;
use FOS\RestBundle\View\View;

class RestController extends Controller
{
    
    public function getMatchsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $matchs = $em->getRepository('MatchBundle:Versus')->findAll();
        
        return $matchs;
    }
}
