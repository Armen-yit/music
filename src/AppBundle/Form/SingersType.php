<?php
/**
 * Created by PhpStorm.
 * User: Armen
 * Date: 19/09/18
 * Time: 7:33 PM
 */

namespace AppBundle\Form;

use AppBundle\Entity\Singers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SingersType
 * @package AppBundle\Form
 */
class SingersType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('name', null, array('required' => true,  'label' => 'Name',
            'attr' => array(
                'placeholder' => 'Name',
                'oninvalid' => "setCustomValidity('create name')",
                'oninput' => "setCustomValidity('')"
            )))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'save')
            ))
        ;

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Singers',
            'cascade_validation' => true,
            'error_bubbling' => true,

        ));
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'singers_type';
    }
}