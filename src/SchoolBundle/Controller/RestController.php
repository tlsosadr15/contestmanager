<?php

namespace SchoolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class RestController extends Controller
{
    
    /**
     * @ApiDoc(
     * section="Schools",
     * description= "Get all schools",
     * statusCodes={
     *      200="Returned when successful",
     * }
     * )
    */
    public function getSchoolsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $schools = $em->getRepository('SchoolBundle:School')->findAll();
        
        return $schools;
    }

    /**
     * @ApiDoc(
     * section="Schools",
     * description= "Get school by id",
     * requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Id school"
     *      }
     *  },
     * statusCodes={
     *      200="Returned when successful",
     *      404="Returned when school not found"
     * }
     * )
    */
    public function getSchoolAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $school = $em->getRepository('SchoolBundle:School')->findOneBy(array('id' => $id));
        if( empty($school) ){
            return new JsonResponse('school not found', 404);
        }
        return $school;
    }
}
