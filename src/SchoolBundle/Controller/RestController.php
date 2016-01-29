<?php

namespace SchoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class RestController extends Controller
{
    
    public function getSchoolsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $schools = $em->getRepository('SchoolBundle:School')->findAll();
        
        return $schools;
    }
}
