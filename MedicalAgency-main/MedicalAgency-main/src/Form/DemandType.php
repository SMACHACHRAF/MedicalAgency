<?php

namespace App\Form;

use App\Entity\PatientInformations;
use App\Repository\PatientInformationsRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class , array(
                'required' => true,
                'label' => false
            ))
            ->add('country',CountryType::class, [
                'placeholder' => 'Select you country',
        'label' => false
            ])
            ->add('phone',IntegerType::class)
            ->add('email',EmailType::class)
            ->add('specialisation',null,[
                'placeholder' => 'Choose your operation specialisation',
                        'label' => false

            ])
            ->add('demande',TextareaType::class, [
                'label' => false])
            ->add('Send',SubmitType::class, [
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PatientInformations::class,
        ]);
    }


}
