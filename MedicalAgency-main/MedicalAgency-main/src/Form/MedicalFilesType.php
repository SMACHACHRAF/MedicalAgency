<?php

namespace App\Form;

use App\Entity\MedicalFiles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class MedicalFilesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weight')
            ->add('size')
            ->add('IsAlcohloic', null, [
                'label' => 'Are you an Alcohlic?',
                'required' => false,

            ])
            ->add('qtealcohol', null, [
                'label' => 'Qte Alcohol (Select IsAlcohol First)',
                'required' => false,
                'attr' => array('style' => 'display:none;')
            ])
            ->add('IsSmoking', null, [
                'label' => 'Are you a smoker?',
                'required' => false,

            ])
            ->add('qte_smoking', null, [
                'label' => 'Qte Smoking (Select IsSmoking First)',
                'required' => false,
                'attr' => array('style' => 'display:none;')
            ])
            ->add('CurrentDisease', CollectionType::class, [
                'entry_type' => CurrentDiseaseType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,

                'label' => false
            ])

            ->add('treatments', CollectionType::class, [
                'entry_type' => CurrentTreatmentsType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false
            ])

            ->add('PrevOper', CollectionType::class, [
                'entry_type' => OperationsType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,

                'label' => false
            ])
            ->add('health_info')
            ->add('Medical_File', VichFileType::class)
//
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MedicalFiles::class,
        ]);
    }
}
