<?php

namespace App\Form;

use App\Entity\PatientInformations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientInformationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('Age')
            ->add('Sexe')
            ->add('country')
            ->add('phone')
            ->add('email')
            ->add('demande')
            ->add('specialisation')
            ->add('tourismeRegion')
            ->add('housing')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PatientInformations::class,
        ]);
    }
}
