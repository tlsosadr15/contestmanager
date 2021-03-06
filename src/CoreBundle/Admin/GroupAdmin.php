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
use UserBundle\Entity\User;

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
    protected $translationDomain = 'Admin';

    /**
     * @param Team $object Team object
     *
     * @return string
     */
    public function toString($object)
    {
        return $object instanceof GroupMatch
            ? $object->getName()
            : 'Group';
    }

    /**
     * @param GroupMatch $object Student
     */
    public function prePersist($object) {
        /** @var User $user */
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $roles = $user->getRoles();
        if (!in_array('ROLE_SUPER_ADMIN', $roles)) {
            $object->setTeacher($user);
        }
    }

    /**
     * @param FormMapper $formMapper Form mapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $roles = $user->getRoles();

        $formMapper->add('name', TextType::class);

        if (in_array('ROLE_SUPER_ADMIN', $roles)) {
            $formMapper
                ->add('teacher', 'entity', array(
                        'class' => 'UserBundle\Entity\User',
                        'multiple' => false,
                        'required' => false,
                    )
                );
        }

    }

    /**
     * @param DatagridMapper $datagridMapper Datagrid mapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('teacher');
    }

    /**
     * @param ListMapper $listMapper List mapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
        $listMapper->add('teacher');
    }

}