<?php

namespace App\Form;

use App\Entity\Etiquette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

// Cette classe nous aide à construire notre formulaire
class EtiquetteType extends AbstractType 
{
    // Nous devons utiliser la méthode buildForm pour construire le formulaire
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Construire le formulaire avec les champs et les types appropriés
        $builder
            // Etat
            ->add('etat', ChoiceType::class, 
            [
                'choices' =>
                [
                    'En Réparation' => 'En Réparation',
                    'Prêt à l\'emploi' => 'Prêt à l\'emploi',
                    'En attente de maintenance' => 'En attente de maintenance',
                    'En Mission' => 'En Mission',
                    'Réservé' => 'Réservé',
                ],
            ])
            
            // Disponibilité
            ->add('disponibilite', ChoiceType::class, 
            [
                'choices' =>
                [
                    'Disponible'=>true,
                    'Indisponible'=>false,
                ],
            ])
            
            // Statut
            // ->add('statut', ChoiceType::class, 
            // [
            //     'choices' => 
            //     [
            //         'Niveau de Carburant Bas' => 'Niveau de Carburant Bas',
            //         'Tout est OK' => 'Tout est OK',
            //         'Usure des Pneus' => 'Usure des Pneus',
            //         'Problème de Moteur' => 'Problème de Moteur',
            //         'Problème technique' => 'Problème technique',
            //         'Autres Problèmes' => 'Autres Problèmes',
            //     ],
            // ])
            
            // Enregistrement
            ->add
            (
                'save', SubmitType::class, 
                [
                'label' => 'Modifiez l\'étiquette'
                ]
            );
    }
    
    // Configuration des options
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults
        (
        [
            'data_class' => Etiquette::class,
        ]
    );
    }
}
