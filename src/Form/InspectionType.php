<?php

namespace App\Form;

use App\Entity\Camion;
use App\Entity\Inspecteur;
use App\Entity\Inspection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InspectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateInspection', null, [
                'widget' => 'single_text',
            ])
            ->add('resultat')
            ->add('commentaire')
            ->add('inspecteur', EntityType::class, [
                'class' => Inspecteur::class,
                'choice_label' => 'id',
            ])
            ->add('camion', EntityType::class, [
                'class' => Camion::class,
                'choice_label' => 'remorque',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inspection::class,
        ]);
    }
}
