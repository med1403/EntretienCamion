<?php

namespace App\Form;

use App\Entity\Reparation;
use App\Entity\Incidence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ReparationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            
            ->add('incident', EntityType::class, [
                'class' => Incidence::class,
                'choice_label' => 'id',
                'placeholder' => 'Select an Incident ID',
                'attr' => ['class' => 'form-control'],
            ])

            ->add('date_reparation', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter the description']
            ])
            ->add('cout', MoneyType::class, [
                'currency' => 'GNF',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter the cost']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reparation::class,
        ]);
    }
}
