<?php

namespace CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    
    public function prePersistEntity($entity) {
        
        if ("UserBundle\Entity\User" == $this->entity['class']) {
            $firstName = $entity->getFirstName();
            $lastName = $entity->getLastName();
            $username = $firstName."_".$lastName;
            $entity->setUsername($username);
        }
        
        if ("MatchBundle\Entity\Versus" == $this->entity['class']) {
            $entity->setFinished(false);
        }
    }
    
    protected function createNewForm($entity, array $entityProperties)
    {
        $newForm = parent::createNewForm($entity, $entityProperties);

        if ("UserBundle\Entity\User" == $this->entity['class']) {

        $newForm->remove('roles');
        $newForm->add('roles', 'choice', array(
                'choices' => array('ROLE_USER' => 'ROLE_USER', 'ROLE_ADMIN' => 'ROLE_ADMIN', 'AUCUN'=>'AUCUN'),
                'multiple'=>true,
                'empty_data'=>array('AUCUN')));
        }
        
        if ("MatchBundle\Entity\Versus" == $this->entity['class']) {

        $newForm->add('date_match','datetime', array(
                'date_format'=>'ddMMMy')) ;
        }

        return $newForm;
        
    }
    
}
