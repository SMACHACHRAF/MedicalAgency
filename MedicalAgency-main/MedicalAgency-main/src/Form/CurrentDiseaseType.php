<?php

namespace App\Form;

use App\Entity\CurrentDisease;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CurrentDiseaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('DiseaseName')
            ->add('DiseaseDate', DateType::class, array(
        'widget' => 'single_text',
        'data'=>new \DateTime(),
        'required' => true
    ))

        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CurrentDisease::class,
        ]);
    }
}
