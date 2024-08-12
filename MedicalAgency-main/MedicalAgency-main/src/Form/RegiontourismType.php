<?php

namespace App\Form;

use App\Entity\TourismeRegion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegiontourismType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Arrival_date', DateType::class, array(
                'widget' => 'single_text',
                'data'=>new \DateTime(),
                'required' => true

            ))

            ->add('estimate_period', ChoiceType::class, [
                'choices' => [
                    'Not planned' => 'Non prévue',
                    '1 Week' => '7',
                    '2 Weeks' => '14',
                    '3 Weeks' => '21',
                    '1 Month' => '30',
                ],
                'placeholder' => 'Select your estimate period',
                 'required' => true

            ])
            ->add('Guide', ChoiceType::class, [
                'choices' => [
                        'Yes' => true,
                    'No' => false,

                ],
                'required' => true

            ])
            ->add('Car', ChoiceType::class, [
                'choices' => [
                    'With Car' => true,
                    'Without Car' => false,
                ],
                'required' => true

            ])
            ->add('medicalCity',null,[
                'placeholder' => 'Select a city',
                'required' => true

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TourismeRegion::class,
        ]);
    }
}
