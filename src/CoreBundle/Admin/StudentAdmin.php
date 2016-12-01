<?php
/**
 * StudentAdmin class file
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

use SchoolBundle\Entity\Student;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class StudentAdmin
 *
 * @category Admin
 * @package  CoreBundle\Admin
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
class StudentAdmin extends AbstractAdmin
{

    /**
     * @param Student $object Student object
     *
     * @return string
     */
    public function toString($object)
    {
        return $object instanceof Student
            ? 'Student '.$object->getFirstName()
            : 'Student';
    }

    /**
     * @param FormMapper $formMapper Form mapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('school', 'entity', array(
                    'class' => 'SchoolBundle\Entity\School',
                    'multiple' => false,
                    'required' => false,
                )
            )
            ->add('team', 'entity', array(
                    'class' => 'TeamBundle\Entity\Team',
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
            ->add('firstName')
            ->add('lastName')
            ->add('team')
            ->add('school');
    }

    /**
     * @param ListMapper $listMapper List mapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('firstName');
        $listMapper
            ->add('lastName', TextType::class)
            ->add('team')
            ->add('school');
    }

}