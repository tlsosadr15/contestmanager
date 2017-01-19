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
use MatchBundle\Entity\Versus;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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

    protected $halfDay = "";

    /**
     * @param Tournament $object Tournament object
     *
     * @return string
     */
    public function toString($object)
    {
        return $object instanceof Tournament
            ? 'Tournament '.$object->getName()
            : 'Tournament';
    }

    /**
     * @param Tournament $object Student
     */
    public function prePersist($object) {
        $this->halfDay = strtolower($object->getHalfDay());
        $groupsList = $this->formatGroupsList();
        $this->addGroups($object, $groupsList);
//        $this->startTournament($groupsList);
    }
    
    /**
     * @param FormMapper $formMapper Form mapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
//        $roomNumber = $this->getConfigurationPool()->getContainer()->getParameter('room_number');
        $entityManager = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $config = $entityManager->getRepository('CoreBundle:Config')->findOneBy(array());

        $formMapper
            ->with('Tournament')
                ->add('name', TextType::class)
                ->add('halfDay', 'choice', array(
                    'choices' => array(
                        'Am' => $this->trans('Morning'),
                        'Pm' => $this->trans('Afternoon'),
                    )
                ))
                ->add('date', DateTimeType::class)
            ->end();
            for ($i = 1; $i <= $config->getRoomNumber(); $i++) {
                $formMapper
                    ->with('Room '.$i)
                        ->add('group'.$i, 'entity', array(
                                'class' => 'MatchBundle\Entity\GroupMatch',
                                'multiple' => true,
                                'required' => false,
                                'mapped' => false,
                                'label' => 'Groups',
                            )
                        )
                    ->end();
            }
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
     * Format array groups
     *
     * @return array
     */
    private function formatGroupsList() {
        $groupsList = [];
        $roomNumber = $this->getConfigurationPool()->getContainer()->getParameter('room_number');

        for ($i = 1; $i <= $roomNumber; $i++) {
            $groupsList[] = $this->getForm()->get('group'.$i)->getData();
        }

        return $groupsList;
    }

    /**
     * Start the tournament
     *
     * @param array $groupsList Groups
     */
    private function startTournament($groupsList) {
        foreach ($groupsList as $groups) {
            $this->SetRandomMatchs($groups);
        }
    }

    /**
     * Set random matchs
     *
     * @param array $groups Groups
     */
    private function SetRandomMatchs($groups) {
//        $times = $this->getConfigurationPool()->getContainer()->getParameter($this->halfDay.'_match_schedule');
//        foreach ($times as $time) {
//            $match = new Versus();
//        }
    }

}