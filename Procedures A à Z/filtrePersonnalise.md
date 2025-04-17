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

Ajoute :

```php
use App\DTO\RecipeFilter;

public function findByFilters(RecipeFilter $filter): array
{
    $qb = $this->createQueryBuilder('r')
        ->leftJoin('r.difficulty', 'd')
        ->leftJoin('r.ingredients', 'i')
        ->addSelect('d', 'i');

    if ($filter->maxDuration) {
        $qb->andWhere('r.duration <= :duration')
            ->setParameter('duration', $filter->maxDuration);
    }

    if ($filter->difficulty) {
        $qb->andWhere('r.difficulty = :difficulty')
            ->setParameter('difficulty', $filter->difficulty);
    }

    if (!empty($filter->ingredients)) {
        $qb->andWhere('i IN (:ingredients)')
            ->setParameter('ingredients', $filter->ingredients);
    }

    return $qb->getQuery()->getResult();
}
```

---

### 🎨 4. Modifier le template Twig

```bash
code templates/recipe/index.html.twig
```

Ajoute au début :

```twig
<h2>Filtres</h2>
{{ form_start(form) }}
<div class="row mb-3">
    <div class="col-md-4">
        {{ form_row(form.maxDuration) }}
    </div>
    <div class="col-md-4">
        {{ form_row(form.difficulty) }}
    </div>
    <div class="col-md-4">
        {{ form_row(form.ingredients) }}
    </div>
</div>
<button class="btn btn-primary">Filtrer</button>
{{ form_end(form) }}
<hr>

```

Et garde la suite pour afficher les recettes.

---

✅ Commandes utiles récapitulatives

```bash
# # Créer DTO
# mkdir -p src/DTO && touch src/DTO/RecipeFilter.php

# Générer le formulaire
php bin/console make:form RecipeFilterType

# Ouvrir les fichiers nécessaires
code src/DTO/RecipeFilter.php
code src/Form/RecipeFilterType.php
code src/Controller/RecipeController.php
code src/Repository/RecipeRepository.php
code templates/recipe/index.html.twig

```

---

<p align="center">
  <a href="./theme-sombre-clair.md">Suivant</a>
</p>