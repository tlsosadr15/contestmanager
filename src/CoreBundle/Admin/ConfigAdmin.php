<?php
/**
 * ConfigAdmin class file
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

use CoreBundle\Entity\Config;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ConfigAdmin
 *
 * @category Admin
 * @package  CoreBundle\Admin
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
class ConfigAdmin extends AbstractAdmin
{

    /**
     * @param Config $object Student object
     *
     * @return string
     */
    public function toString($object)
    {
        return $object instanceof Config
            ? 'Config '.$object->getId()
            : 'Config';
    }

    /**
     * @param FormMapper $formMapper Form mapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('tournamentLenght', TextType::class);
    }

    /**
     * @param ListMapper $listMapper List mapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->add('$tournamentLenght', TextType::class);
    }

}