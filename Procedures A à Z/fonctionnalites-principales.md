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



---

<p align="center">
  <a href="./commentaires.md">Suivant</a>
</p>