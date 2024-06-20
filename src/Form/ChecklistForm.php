<?php
// src/Form/ChecklistType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChecklistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque', TextType::class, ['label' => 'Marque'])
            ->add('modele', TextType::class, ['label' => 'Modèle'])
            ->add('seb', TextType::class, ['label' => 'SEB'])
            ->add('it', TextType::class, ['label' => 'IT'])
            ->add('seb_berne', TextType::class, ['label' => 'SEB Berne'])
            ->add('horometre', TextType::class, ['label' => 'Horomètre'])
            ->add('vin', TextType::class, ['label' => 'VIN'])
            ->add('km', TextType::class, ['label' => 'Km'])
            ->add('date', DateType::class, ['widget' => 'single_text', 'label' => 'Date de contrôle'])
            ->add('heure', TimeType::class, ['widget' => 'single_text', 'label' => 'Heure de contrôle'])
            ->add('site', TextType::class, ['label' => 'Site'])
            ->add('controleur', TextType::class, ['label' => 'Contrôle effectué par'])
            ->add('feux_multi', ChoiceType::class, [
                'label' => 'Feux plaque immatriculation',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal'
                ],
                'expanded' => true,
                'multiple' => false
            ])
            ->add('feux_batterie', ChoiceType::class, [
                'label' => 'Couvercle du coffre batterie (présence)',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true, // Pour afficher les boutons radio au lieu d'un menu déroulant
                'multiple' => false, // Sélection unique
            ])
            ->add('feux_clignotant', ChoiceType::class, [
                'label' => 'Feux clignotant G et D',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('feux_stop', ChoiceType::class, [
                'label' => 'Feux stop',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('feux_position', ChoiceType::class, [
                'label' => 'Feux de position',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('feux_croisement', ChoiceType::class, [
                'label' => 'Feux de croisement',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('feux_recul', ChoiceType::class, [
                'label' => 'Feux de recul',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('feux_gabarit', ChoiceType::class, [
                'label' => 'Feux de gabarit',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('feux_antibrouillard', ChoiceType::class, [
                'label' => 'Feux antibrouillard av et ar',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('gyrophare', ChoiceType::class, [
                'label' => 'Gyrophare',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('eclairage_interieur', ChoiceType::class, [
                'label' => 'Eclairage intérieur cabine',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('klaxon', ChoiceType::class, [
                'label' => 'Klaxon',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('eclairage_tableau', ChoiceType::class, [
                'label' => 'Eclairage tableau de bord',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('amortisseur_hydro', ChoiceType::class, [
                'label' => 'Amortisseur hydraulique',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('barre_torsion', ChoiceType::class, [
                'label' => 'Lame ressort essieux av',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('lame_ressort_av', ChoiceType::class, [
                'label' => 'Lame ressort 2 essieux avant',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('barre_stabilite_av', ChoiceType::class, [
                'label' => 'Barre de stabilité avant',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('biellette_barre_stab_av', ChoiceType::class, [
                'label' => 'Biellette barre stabilisatrice avant',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('butee_debattement', ChoiceType::class, [
                'label' => 'Butée de débattement',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('lame_ressort_ar', ChoiceType::class, [
                'label' => 'Lame ressort arrière',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('tampon_lame_ar', ChoiceType::class, [
                'label' => 'Tampon de lame arrière',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('etrier_lame_bride', ChoiceType::class, [
                'label' => 'Étrier de lame (bride)',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('vis_serrage_anneau_accouplement', ChoiceType::class, [
                'label' => 'Vis de serrage anneau accouplement',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('cric_levage_cabine', ChoiceType::class, [
                'label' => 'Cric de levage cabine',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('amortisseur_cabine_av', ChoiceType::class, [
                'label' => 'Amortisseur cabine avant',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('amortisseur_cabine_ar', ChoiceType::class, [
                'label' => 'Amortisseur cabine arrière',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('verin_essieux_2_av', ChoiceType::class, [
                'label' => 'Vérin essieux 2 avant',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('tiran_stabilisation_etat', ChoiceType::class, [
                'label' => 'Tiran de stabilisation (état)',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('triangle_stabilisateur_etat', ChoiceType::class, [
                'label' => 'Triangle stabilisateur (état)',
                'choices' => [
                    'Bon' => 'bon',
                    'Mal' => 'mal',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            // Ajoutez les autres champs radio ici de la même manière...
            ->add('observations', TextareaType::class, [
                'label' => 'Observations',
                'attr' => ['rows' => 4, 'cols' => 50]
            ])
            ->add('nom', TextType::class, ['label' => 'Nom'])
            ->add('submit', SubmitType::class, ['label' => 'Soumettre']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
?>