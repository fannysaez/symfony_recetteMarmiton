# 🧩 Fonctionnalités principales

L’objectif ici est de permettre aux utilisateurs de créer, modifier, supprimer, consulter des recettes, et de les organiser par catégories, niveaux de difficulté, ingrédients, etc.

1. ⚙️ Création des entités principales

On va commencer par créer les entités avec leurs relations.

Entité Recipe

```bash

symfony console make:entity Recipe

```
```bash
Champs recommandés :

    title (string)

    content (text)

    duration (integer)

    nbPeople (integer)

    image (string, optionnel si tu veux uploader)

    createdAt (datetime_immutable)

    updatedAt (datetime_immutable)

```

```bash
    user (ManyToOne vers User)

    difficulty (ManyToOne vers Difficulty)

    ingredients (ManyToMany vers Ingredient)

    On ajoute ManyToMany si une recette a plusieurs ingrédients, et inversement.
```
---

Entité Ingredient :

```bash

symfony console make:entity Ingredient

```bash

name (string)

unit (string, ex : "g", "ml", "pièce")

recipes (ManyToMany vers Recipe)

```

---

Entité Difficulty :

```bash

symfony console make:entity Difficulty

```bash

level (string – ex : "Facile", "Moyenne", "Difficile")

recipes (OneToMany vers Recipe)

Relation : User → Recipe

La relation ManyToOne est faite au moment de la création de Recipe.
```

---

2. 💾 CRUD automatique

Symfony permet de générer les contrôleurs + formulaires + templates :

```bash

php bin/console make:crud Recipe
php bin/console make:crud Ingredient
php bin/console make:crud Difficulty

```

Tu peux supprimer ou modifier les templates si tu veux un affichage personnalisé.

---

3. 🧠 Remplir automatiquement certains champs (createdAt, user, etc.)

Dans RecipeController, lors de la création d'une recette :

```php

#[Route('/recette/new', name: 'recipe_new')]
public function new(Request $request, EntityManagerInterface $em, Security $security): Response
{
    $recipe = new Recipe();

    $form = $this->createForm(RecipeType::class, $recipe);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $recipe->setCreatedAt(new \DateTimeImmutable());
        $recipe->setUpdatedAt(new \DateTimeImmutable());
        $recipe->setUser($security->getUser()); // associer à l'utilisateur connecté

        $em->persist($recipe);
        $em->flush();

        return $this->redirectToRoute('recipe_index');
    }

    return $this->render('recipe/new.html.twig', [
        'form' => $form->createView(),
    ]);
}

```

---

4. 🖼 Upload d’image pour les recettes (optionnel)
a) Installer VichUploader :

```bash
composer require vich/uploader-bundle
```

b) Configurer l’entité Recipe :

Ajoute un champ imageFile (non mappé en base), et configure Vich :

```php

#[Vich\UploadableField(mapping: 'recipe_images', fileNameProperty: 'image')]
private ?File $imageFile = null;

```

Configure ensuite le mapping dans vich_uploader.yaml :

```yaml

vich_uploader:
    db_driver: orm
    mappings:
        recipe_images:
            uri_prefix: /uploads/recipes
            upload_destination: '%kernel.project_dir%/public/uploads/recipes'

```


Et dans le formulaire :

```php

$builder->add('imageFile', VichImageType::class, [
    'required' => false,
    'label' => 'Image',
]);

```

---

5. 🗑 Sécuriser la modification/suppression d’une recette

Dans RecipeController :

```php
if ($security->getUser() !== $recipe->getUser() && !$security->isGranted('ROLE_ADMIN')) {
    throw $this->createAccessDeniedException();
}
```

---

6. 📄 Affichage d’une recette en détail

Dans templates/recipe/show.html.twig :

```twig
<h2>{{ recipe.title }}</h2>
<img src="{{ asset('uploads/recipes/' ~ recipe.image) }}" alt="{{ recipe.title }}">
<p>Durée : {{ recipe.duration }} min</p>
<p>Pour {{ recipe.nbPeople }} personnes</p>
<p>Par : {{ recipe.user.email }}</p>
<p>Créée le {{ recipe.createdAt|date('d/m/Y') }}</p>
<p>Difficulté : {{ recipe.difficulty.level }}</p>
<p>Catégorie : {{ recipe.category.name }}</p>

<h3>Ingrédients :</h3>
<ul>
    {% for ingredient in recipe.ingredients %}
        <li>{{ ingredient.name }} ({{ ingredient.unit }})</li>
    {% endfor %}
</ul>

<p>{{ recipe.content|nl2br }}</p>
```

---

7. ✅ Exemple d'affichage dans une carte Bootstrap (page liste)

```twig

<div class="card mb-4">
    <img src="{{ asset('uploads/recipes/' ~ recipe.image) }}" class="card-img-top" alt="{{ recipe.title }}">
    <div class="card-body">
        <h5 class="card-title">{{ recipe.title }}</h5>
        <p class="card-text">
            {{ recipe.duration }} min · {{ recipe.nbPeople }} pers<br>
            Catégorie : {{ recipe.category.name }}
        </p>
        <a href="{{ path('recipe_show', {id: recipe.id}) }}" class="btn btn-primary">Voir la recette</a>
    </div>
</div>

```

---

8. 📂 Organisation des pages

    /recette : liste des recettes

    /recette/new : formulaire de création

    /recette/{id} : page de détail

    /recette/{id}/edit : édition (si auteur/admin)

    /recette/{id} (DELETE) : suppression (si auteur/admin)

---

<p align="center">
  <a href="./commentaires.md">Suivant</a>
</p>