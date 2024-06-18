<?php

namespace App\Form;

use App\Entity\Camion;
use App\Entity\Categorie;
use App\Entity\Tracteur;
use App\Entity\TypeCamion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CamionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('remorque')
            ->add('dateIntegration', null, [
                'widget' => 'single_text',
            ])
            ->add('location')
            ->add('statut')
            ->add('observation')
            ->add('kmActuel')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom',
            ])
            ->add('typeCamion', EntityType::class, [
                'class' => TypeCamion::class,
                'choice_label' => 'nom',
            ])
            ->add('tracteur', EntityType::class, [
                'class' => Tracteur::class,
                'choice_label' => 'nom',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Camion::class,
        ]);
    }
}
