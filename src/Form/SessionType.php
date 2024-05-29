<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Apprenant;
use App\Entity\Programme;
use App\Entity\Unite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('nbPlaces', NumberType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control' 
                ]
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control' 
                ]
            ])
            ->add('programmes', EntityType::class, [
                'class' => Programme::class,
                'choice_label' => 'id',
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control' 
                ]
            ])
            // ->add('programmes', EntityType::class, [
            //     'class' => Unite::class,
            //     'choice_label' => 'intitule'
            // ])

            // ->add('estCloturee', CheckboxType::class, [
            //     'required' => false,
            // ])
            ->add('Valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success btn-formulaire'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
