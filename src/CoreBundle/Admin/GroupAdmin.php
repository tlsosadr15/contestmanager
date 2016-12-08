<?php
/**
 * GroupAdmin class file
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

use MatchBundle\Entity\GroupMatch;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use TeamBundle\Entity\Team;

/**
 * Class GroupAdmin
 *
 * @category Admin
 * @package  CoreBundle\Admin
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
class GroupAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'group';

    /**
     * @param Team $object Team object
     *
     * @return string
     */
    public function toString($object)
    {
        return $object instanceof GroupMatch
            ? 'Group '.$object->getName()
            : 'Group';
    }

    /**
     * @param FormMapper $formMapper Form mapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class)
            ->add('teacher', 'entity', array(
                    'class' => 'UserBundle\Entity\User',
                    'multiple' => false,
                    'required' => false,
                )
            )
            ->add('school', 'entity', array(
                    'class' => 'SchoolBundle\Entity\School',
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
        $datagridMapper->add('name');
        $datagridMapper->add('school');
    }

    /**
     * @param ListMapper $listMapper List mapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
        $listMapper->add('teacher');
        $listMapper->add('school');
    }

}