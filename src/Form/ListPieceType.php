<?php

namespace App\Form;

use App\Entity\ListPiece;
use App\Entity\Piece;
use App\Entity\Videnge;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListPieceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite')
            ->add('prix_total')
            ->add('piece', EntityType::class, [
                'class' => Piece::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('videnges', EntityType::class, [
                'class' => Videnge::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ListPiece::class,
        ]);
    }
}
