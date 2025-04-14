# 🔒 Sécurité et Authentification — Symfony 7

1. 🎨 Création de l'entité User

```bash
symfony console make:user
```

a Questions du CLI :

```bash
Nom de classe utilisateur : User

Stocker dans la base ? → yes

Identifiant ? → email (souvent le plus utilisé)

Ajouter un mot de passe ? → yes

Utiliser des rôles ? → yes

Voulez-vous un hash de mot de passe ? → yes
```

Résultat :
```bash
Une classe User générée dans src/Entity/User.php

Avec les champs : id, email, roles, password

💡 Le champ roles est de type json, et contient un tableau de rôles comme ["ROLE_USER"], ["ROLE_ADMIN"].
```

---

2. 🔐 Configuration du système d’authentification

```bash
symfony console make:auth
```

Choisis :

```bash
Quel type d’auth ? → Login form authenticator

Nom du firewall → main (défaut)

Nom de la classe authenticator ? → AppAuthenticator

Page de login ? → générée automatiquement
```

Tu obtiendras :

```bash
src/Security/AppAuthenticator.php (logique de login)

templates/security/login.html.twig
```

---

3. 🧪 Création formulaire d'inscription

```bash
symfony console make:registration-form
```

Ce générateur crée :
```bash
Un contrôleur RegistrationController.php

Un formulaire RegistrationFormType.php

La logique d'encodage du mot de passe + enregistrement

 Le mot de passe est automatiquement hashé grâce à l’UserPasswordHasherInterface.
```

---

4. 🛡️ Configuration de security.yaml

Fichier : `config/packages/security.yaml`

Voici une version typique :

```yaml

security:
    password_hashers:
        App\Entity\User:
            algorithm: auto

    providers:
        app_user_provider:
            entity:
                class: App\Entity\User
                property: email

    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false

        main:
            lazy: true
            provider: app_user_provider
            form_login:
                login_path: login
                check_path: login
                enable_csrf: true
            logout:
                path: logout
                target: /

    access_control:
        # 🔒 Routes protégées
        - { path: ^/admin, roles: ROLE_ADMIN }
        - { path: ^/profile, roles: ROLE_USER }
        - { path: ^/recette/new, roles: ROLE_USER }
        - { path: ^/recette/edit, roles: ROLE_USER }

```

---

5. 🎭 Gestion des rôles

```bash
ROLE_USER : par défaut attribué à tous (dans getRoles() tu ajoutes manuellement)

ROLE_ADMIN : à attribuer dans la BDD ou via fixtures (si tu les utilises)
```

Pour tester rapidement :

```sql

UPDATE user SET roles = '["ROLE_ADMIN"]' WHERE email = 'admin@exemple.com';

```

---

6. 🔏 Protéger l’accès aux recettes `(contrôleur)`

Dans ton `RecipeController.php`, restreins l'accès :
Exemple pour modifier une recette :

```php

#[Route('/recette/{id}/edit', name: 'recipe_edit')]
public function edit(Recipe $recipe, Security $security, Request $request, EntityManagerInterface $em): Response
{
    // Vérifie que l'utilisateur est l'auteur ou admin
    if ($security->getUser() !== $recipe->getUser() && !$security->isGranted('ROLE_ADMIN')) {
        throw $this->createAccessDeniedException();
    }

    // formulaire...
}

```
✅ Avec ça, seuls l’auteur de la recette ou un admin pourront la modifier.

---

7. 🔄 Login / Logout

Symfony crée automatiquement les routes `/login` et `/logout`.

Le formulaire de login est généré : `templates/security/login.html.twig`

Le logout fonctionne via un lien :

```twig

<a href="{{ path('app_logout') }}">Déconnexion</a>

```

8. ✅ Vérification si utilisateur connecté dans Twig

```twig

{% if app.user %}
    Bonjour {{ app.user.email }}
{% endif %}

```

Et pour vérifier un rôle :

```twig

{% if is_granted('ROLE_ADMIN') %}
    <a href="{{ path('admin_dashboard') }}">Admin</a>
{% endif %}

```

---

9. 🔐 Bonus : restreindre des sections de templates

```twig

{% if app.user and app.user == recipe.user or is_granted('ROLE_ADMIN') %}
    <a href="{{ path('recipe_edit', { id: recipe.id }) }}">Modifier</a>
{% endif %}

```

---

<p align="center">
  <a href="./fonctionnalites-principales.md">Suivant</a>
</p>