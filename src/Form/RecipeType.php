<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Recipe;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre de la recette',
            ])
            // Champ image avec UrlType pour valider l'URL
            ->add('image', UrlType::class, [
                'label' => 'URL de l’image',
                'required' => false,  // Tu peux le rendre optionnel si nécessaire
                'attr' => [
                    'placeholder' => 'Entrez l\'URL de l\'image', // Texte d'exemple dans le champ
                ],
            ])->add('duration', null, [
                'label' => 'Durée (en minutes)',
            ])
            // Modification de ce champ pour utiliser ChoiceType
            ->add('difficulty', ChoiceType::class, [
                'label' => 'Difficulté',
                'choices' => [
                    'Facile' => 'Facile',
                    'Moyenne' => 'Moyenne',
                    'Difficile' => 'Difficile',
                ],
                'placeholder' => 'Choisir une difficulté', // Optionnel : ajouter un placeholder
            ])
            ->add('peopleCount', null, [
                'label' => 'Nombre de personnes',
            ])
            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true,
                'label' => 'Ingrédients',
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
