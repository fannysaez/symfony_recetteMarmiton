# 🔎 Filtre personnalisé pour les recettes selon trois critères :

* Durée maximale de préparation
* Difficulté
* Ingrédients

## 🧩 Objectif

Permettre à un utilisateur de filtrer les recettes sans recherche textuelle, uniquement à l’aide de critères sélectionnés via un formulaire.

### 🧾 1. Générer le formulaire RecipeFilterType

```bash
symfony console make:form RecipeFilterType
```

Puis, modifie le fichier généré :

```php
// src/Form/RecipeFilterType.php
namespace App\Form;

use App\DTO\RecipeFilter;
use App\Entity\Difficulty;
use App\Entity\Ingredient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('maxDuration', IntegerType::class, [
                'required' => false,
                'label' => 'Durée maximale (en min)',
            ])
            ->add('difficulty', EntityType::class, [
                'class' => Difficulty::class,
                'required' => false,
                'placeholder' => 'Toutes les difficultés',
                'choice_label' => 'level',
            ])
            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecipeFilter::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
```

---


### 🎮 2. Modifier RecipeController pour intégrer le formulaire

Dans ton contrôleur des recettes :

```bash
code src/Controller/RecipeController.php
```

Ajoute dans la méthode index :

```php
use App\DTO\RecipeFilter;
use App\Form\RecipeFilterType;

#[Route('/recettes', name: 'recipe_index')]
public function index(Request $request, RecipeRepository $repository): Response
{
    $filter = new RecipeFilter();
    $form = $this->createForm(RecipeFilterType::class, $filter);
    $form->handleRequest($request);

    $recipes = $repository->findByFilters($filter);

    return $this->render('recipe/index.html.twig', [
        'recipes' => $recipes,
        'form' => $form->createView(),
    ]);
}
```

---

### 📁 3. Modifier le RecipeRepository

Ouvre :

```bash
code src/Repository/RecipeRepository.php
```

---

<p align="center">
  <a href="./theme-sombre-clair.md">Suivant</a>
</p>