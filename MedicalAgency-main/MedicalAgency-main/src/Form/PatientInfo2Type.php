<?php

namespace App\Form;

use App\Entity\PatientInformations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientInfo2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Age', IntegerType::class,array(
                'label' => 'Age ',
                'attr' => array(
                    'placeholder' => 'Your age'
                )
            ))

            ->add('Sexe', ChoiceType::class, [
                'choices' => [
                    'Women' => true,
                    'Men' => false,
                ],
                'placeholder' => 'Your gender',
                'required' => true
            ])


            ->add('housing',null,[
                'placeholder' => 'Select your housing place',
                 'required' => true

            ])
            ->add('tourismeRegion',RegiontourismType::class)

            ->add('Send', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-success'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

            'data_class' => PatientInformations::class,
        ]);
    }
}
