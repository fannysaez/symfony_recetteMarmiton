# 💬 Commentaires

1. ⚙️ Création de l'entité Comment

```bash

symfony console make:entity Comment

```


Champs recommandés :

```bash
  
content (text)

createdAt (datetime_immutable)

user (ManyToOne vers User)

recipe (ManyToOne vers Recipe)

```

---

2. 🧪 Migration

```bash
  
symfony console make:migration
symfony console doctrine:migrations:migrate

```

---

3. 📝 Création du formulaire CommentType

```bash
  
symfony console make:form CommentType

```


```php
  
// src/Form/CommentType.php

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

$builder
    ->add('content', TextareaType::class, [
        'label' => 'Votre commentaire',
        'attr' => ['rows' => 4],
    ]);

```

4. ✍️ Affichage et enregistrement des commentaires

Dans le contrôleur `RecipeController`, dans la méthode `show()` :

```php

#[Route('/recette/{id}', name: 'recipe_show')]
public function show(Recipe $recipe, Request $request, EntityManagerInterface $em): Response
{
    $comment = new Comment();
    $form = $this->createForm(CommentType::class, $comment);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $comment->setCreatedAt(new \DateTimeImmutable());
        $comment->setUser($this->getUser());
        $comment->setRecipe($recipe);

        $em->persist($comment);
        $em->flush();

        return $this->redirectToRoute('recipe_show', ['id' => $recipe->getId()]);
    }

    return $this->render('recipe/show.html.twig', [
        'recipe' => $recipe,
        'form' => $form->createView(),
    ]);
}

```

5. 🧾 Affichage des commentaires dans le template

```twig

<h3>Commentaires</h3>

{% if app.user %}
    {{ form_start(form) }}
        {{ form_row(form.content) }}
        <button class="btn btn-success">Envoyer</button>
    {{ form_end(form) }}
{% else %}
    <p><a href="{{ path('app_login') }}">Connectez-vous</a> pour commenter.</p>
{% endif %}

<hr>

{% for comment in recipe.comments|sort((a, b) => b.createdAt <=> a.createdAt) %}
    <div class="mb-3 border rounded p-2">
        <strong>{{ comment.user.email }}</strong>
        <small class="text-muted"> - {{ comment.createdAt|date('d/m/Y H:i') }}</small>
        <p>{{ comment.content }}</p>
    </div>
{% else %}
    <p>Aucun commentaire pour l’instant.</p>
{% endfor %}

```
On trie les commentaires par date descendante avec sort() (Symfony 6.3+ ou Twig avec filtre custom si besoin).

6. 🔒 Sécurité d’ajout

Le formulaire n’est visible que si l’utilisateur est `connecté (app.user)`. La sécurité dans le contrôleur est assurée avec :

```php

$comment->setUser($this->getUser());

```

7. 🧹 Suppression de commentaire (optionnel)

Tu peux générer un `CommentController` via :

```bash

```






---

<p align="center">
  <a href="./theme-sombre-clair.md">Suivant</a>
</p>