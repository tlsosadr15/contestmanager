<?php
/**
 * TeamAdmin class file
 *
 * PHP Version 7.0
 *
 * @category Admin
 * @package  CoreBundle\Admin
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
namespace CoreBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use TeamBundle\Entity\Team;
use UserBundle\Entity\User;

/**
 * Class TeamAdmin
 *
 * @category Admin
 * @package  CoreBundle\Admin
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
class TeamAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'team';
    protected $translationDomain = 'Admin';

    /**
     * @param Team $object Team object
     *
     * @return string
     */
    public function toString($object)
    {
        return $object instanceof Team
            ? 'Team '.$object->getName()
            : 'Team';
    }

    /**
     * @param FormMapper $formMapper Form mapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class)
            ->add('group', 'entity', array(
                    'class' => 'MatchBundle\Entity\GroupMatch',
                    'multiple' => false,
                    'required' => false,
                )
            );
    }

    /**
     * @param DatagridMapper $datagridMapper Datagrid mapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('group');
    }

    /**
     * @param ListMapper $listMapper List mapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
        $listMapper->add('group');
    }

}