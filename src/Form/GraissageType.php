<?php

namespace App\Form;

use App\Entity\Camion;
use App\Entity\Graissage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GraissageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateGraissage', null, [
                'widget' => 'single_text',
            ])
            ->add('kmGraissage')
            ->add('ecartType')
            ->add('nbKmRestant')
            ->add('camion', EntityType::class, [
                'class' => Camion::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Graissage::class,
        ]);
    }
}
