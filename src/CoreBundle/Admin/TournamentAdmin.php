<?php
/**
 * TournamentAdmin class file
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

use MatchBundle\Entity\Tournament;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use TeamBundle\Entity\Team;
use UserBundle\Entity\User;

/**
 * Class TournamentAdmin
 *
 * @category Admin
 * @package  CoreBundle\Admin
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
class TournamentAdmin extends AbstractAdmin
{
    protected $baseRoutePattern = 'tournament';
    protected $translationDomain = 'Admin';

    /**
     * @param Tournament $object Tournament object
     *
     * @return string
     */
    public function toString($object)
    {
        return $object instanceof Team
            ? 'Tournament '.$object->getName()
            : 'Tournament';
    }

    /**
     * @param FormMapper $formMapper Form mapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Tournament')
                ->add('name', TextType::class)
                ->add('date', DateTimeType::class)
            ->end()
            ->with('Room 1')
                ->add('group1', 'entity', array(
                        'class' => 'MatchBundle\Entity\GroupMatch',
                        'multiple' => true,
                        'required' => false,
                        'mapped' => false,
                        'label' => 'Group',
                    )
                )
            ->end()
            ->with('Room 2')
                ->add('group2', 'entity', array(
                        'class' => 'MatchBundle\Entity\GroupMatch',
                        'multiple' => true,
                        'required' => false,
                        'mapped' => false,
                        'label' => 'Group',
                    )
                )
            ->end();
    }

    /**
     * @param DatagridMapper $datagridMapper Datagrid mapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('date');
    }

    /**
     * @param ListMapper $listMapper List mapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
        $listMapper->add('date');
    }

}