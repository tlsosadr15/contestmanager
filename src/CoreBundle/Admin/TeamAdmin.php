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

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use TeamBundle\Entity\Team;

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
            ->add('student', 'entity', array(
                'class' => 'SchoolBundle\Entity\Student',
                'multiple' => true,
                )
            )
            ->add('teacher', 'entity', array(
                    'class' => 'UserBundle\Entity\User',
                    'multiple' => false,
                )
            );
    }

    /**
     * @param DatagridMapper $datagridMapper Datagrid mapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    /**
     * @param ListMapper $listMapper List mapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }

}