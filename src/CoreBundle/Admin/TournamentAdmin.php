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

use MatchBundle\Entity\GroupMatch;
use MatchBundle\Entity\Tournament;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use TeamBundle\Entity\Team;

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
     * @param Tournament $object Student
     */
    public function prePersist($object) {
        $groups = array(
            $this->getForm()->get('group1')->getData(),
            $this->getForm()->get('group2')->getData(),
        );
        $this->addGroups($object, $groups);
    }

    /**
     * Add groups in the tournament
     *
     * @param Tournament $object Tournament
     * @param array $groupsList Groups
     */
    private function addGroups($object, $groupsList) {
        foreach ($groupsList as $groups) {
            foreach ($groups as $group) {
                $object->addGroup($group);
            }
        }
    }
    
    /**
     * @param FormMapper $formMapper Form mapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Tournament')
                ->add('name', TextType::class)
                ->add('halfDay', 'choice', array(
                    'choices' => array(
                        'Am' => 'Morning',
                        'Pm' => 'Afternoon',
                    )
                ))
                ->add('date', DateTimeType::class)
            ->end()
            ->with('Room 1')
                ->add('group1', 'entity', array(
                        'class' => 'MatchBundle\Entity\GroupMatch',
                        'multiple' => true,
                        'required' => false,
                        'mapped' => false,
                        'label' => 'Groups',
                    )
                )
            ->end()
            ->with('Room 2')
                ->add('group2', 'entity', array(
                        'class' => 'MatchBundle\Entity\GroupMatch',
                        'multiple' => true,
                        'required' => false,
                        'mapped' => false,
                        'label' => 'Groups',
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
        $listMapper
            ->addIdentifier('name')
            ->add('date')
            ->add('halfDay');
    }

}