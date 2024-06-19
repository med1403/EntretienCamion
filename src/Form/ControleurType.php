<?php

namespace App\Form;

use App\Entity\Controleur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControleurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('numeroDeTel', TextType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('adresseEmail', TextType::class, [
                'label' => 'Adresse email',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('numeroDeBadge', TextType::class, [
                'label' => 'Numéro de badge',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('dateDeNaissance', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('categoriesPermis', TextType::class, [
                'label' => 'Catégories de permis de conduire',
                'attr' => ['class' => 'form-control'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Controleur::class,
        ]);
    }
}
