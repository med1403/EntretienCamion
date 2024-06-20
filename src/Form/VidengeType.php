<?php

namespace App\Form;

use App\Entity\Camion;
use App\Entity\GradeVidenge;
use App\Entity\ListPiece;
use App\Entity\Videnge;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VidengeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('kmVidenge')
            ->add('ecartType')
            ->add('camion', EntityType::class, [
                'class' => Camion::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('listPiece', EntityType::class, [
                'class' => ListPiece::class,
                'choice_label' => 'id',
            ])
            ->add('gradeVidenge', EntityType::class, [
                'class' => GradeVidenge::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Videnge::class,
        ]);
    }
}
