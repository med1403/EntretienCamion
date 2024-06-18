<?php

namespace App\Form;

use App\Entity\Assurance;
use App\Entity\Camion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AssuranceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control js-datepicker', 'placeholder' => 'Enter the start date']
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control js-datepicker', 'placeholder' => 'Enter the end date']
            ])
            ->add('compagnie', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter the company name']
            ])
            ->add('numPolice', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter the policy number']
            ])
            ->add('camion', EntityType::class, [
                'class' => Camion::class,
                'choice_label' => 'id',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Select the truck']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Assurance::class,
        ]);
    }
}
