<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializationContext;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class RestController extends Controller
{
    /**
     * @ApiDoc(
     * resource=true,
     * resourceDescription="Operations on users",
     * description= "Get all users",
     * output= "UserBundle\Entity\User"
     * )
    */
    public function getUsersAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('UserBundle:User')->findAll();
        
        return $users;
    }
    
    /**
     * @Rest\Post("/user/login", name="_login")
     * @ApiDoc(
     * resource=true,
     * resourceDescription="Operations on users",
     * description= "User login",
     * parameters={
     *      {"name"="username", "dataType"="string", "required"=true, },
     *      {"name"="password", "dataType"="string", "required"=true, }
     *  }
     * )
    */
    public function loginAction(Request $request){
        $username = $request->get('username');
        $password = $request->get('password');
        exit($password);
        return false;
        
        $user = $this->get('fos_user.user_manager')->findUserBy(array('username' => $email));
        $logger = $this->get('logger');
        if( empty($user) ){
            return false;
        }
        $logger->info('user found for '.$email);
        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
        if (!$encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt())) {
            return false;
        }
        
        return $user;
    }
    
    /**
     * @ApiDoc(
     * resource=true,
     * section="Operations on users",
     * description= "Get user by id",
     * output="UserBundle\Entity\User",
     * requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Id of the user"
     *      }
     *  }
     * )
    */
    public function getUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('UserBundle:User')->findOneBy(array('id' => $id));
        
        return $user;
    }
    
    /**
     * @ApiDoc(
     * resource=true,
     * resourceDescription="Operations on users",
     * description= "Edit user by id",
     * requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Id of the user"
     *      }
     *  }
     * )
    */
    public function putUserAction($id)
    {
        exit('edit');
    }
}
