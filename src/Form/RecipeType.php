<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Entity\Ingredient;
use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType; // Ajouté pour le champ description
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityManagerInterface;

class RecipeType extends AbstractType
{
    private $ingredientRepository;

    // Injection du repository dans le constructeur
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->ingredientRepository = $entityManager->getRepository(Ingredient::class);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre de la recette',
            ])
            ->add('image', UrlType::class, [
                'label' => 'URL de l’image',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrez l\'URL de l\'image',
                ],
            ])
            ->add('duration', null, [
                'label' => 'Durée (en minutes)',
            ])
            ->add('difficulty', ChoiceType::class, [
                'label' => 'Difficulté',
                'choices' => [
                    'Facile' => 'Facile',
                    'Moyenne' => 'Moyenne',
                    'Difficile' => 'Difficile',
                ],
                'placeholder' => 'Choisir une difficulté',
            ])
            ->add('peopleCount', null, [
                'label' => 'Nombre de personnes',
            ])
            // Liste des ingrédients avec des cases à cocher en colonne
            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true, // Permet la sélection multiple
                'expanded' => true, // Affiche les cases à cocher
                'label' => 'Ingrédients',
                'constraints' => [
                    new Count([
                        'max' => 2,
                        'maxMessage' => 'Vous ne pouvez choisir que 2 ingrédients maximum.',
                    ]),
                ],
                'attr' => [
                    'class' => 'ingredients-checkboxes', // Classe pour personnaliser l'apparence
                ],
            ])
            // Champ pour les tags libres (saisie séparée par des virgules)
            ->add('tags', TextType::class, [
                'label' => 'Tags (séparés par des virgules)',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'ex: rapide, vegan, été',
                ],
                'help' => 'Tapez les tags séparés par des virgules. Les tags seront créés s’ils n’existent pas.',
            ])
            // Ajout du champ de description
            ->add('description', TextareaType::class, [
                'label' => 'Description de la recette',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Décrivez la recette, les étapes et autres informations pertinentes...',
                    'rows' => 5, // Limite la hauteur du champ texte
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
