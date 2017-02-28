<?php
/**
 * TournamentForm file
 *
 * PHP Version 7
 *
 * @category Block
 * @package  MatchBundle\Form
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
namespace MatchBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * TournamentForm class
 *
 * @category Block
 * @package  MatchBundle\Form
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
class TournamentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('tournament', EntityType::class, array(
                'class' => 'MatchBundle\Entity\Tournament',
                'choice_label' => 'name',
                'translation_domain' => 'Admin',
                'attr' => array('class' => 'form-group'),
          ))
          ->add('submit', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-primary'),
                'translation_domain' => 'Admin',
                'label' => 'Start the final phase',
          ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MatchBundle\Entity\Tournament',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'matchbundle_tournament';
    }
}
