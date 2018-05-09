<?php

namespace AppBundle\Form;

//use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand')
            ->add('model')
            ->add('price',TextType::class)
            ->add('topSpeed')
            ->add('doors', ChoiceType::class, array(
                'choices' => array(
                    '2' => 2,
                    '4' => 4,
                )
            ))
            ->add('wheels', ChoiceType::class, array(
                'choices'  => array(
                    '2' => 2,
                    '4' => 4,
                ),
            ))
            ->add('engine',TextType::class)
            ->add('fuel')
            ->add('torque')
            ->add('convertable')
            ->add('save', SubmitType::class)

        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'app_bundle_car_type';
    }
}
