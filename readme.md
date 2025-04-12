# Projet Symfony 7 - "Projet Blanc" avec Bootstrap 5

Ce projet est un modèle de base pour démarrer une application Symfony 7 sous Windows, avec Bootstrap 5 pour le front-end. Il inclut une gestion d'authentification, un système de rôles (admin/utilisateur), des entités typiques (Recette, Catégorie, Ingrédient, Difficulté), un backoffice et plusieurs fonctionnalités dynamiques comme les likes, les commentaires et le filtrage.

## 🛠 Prérequis

- PHP >= 8.1
- [Composer](https://getcomposer.org/)
- [Symfony CLI](https://symfony.com/download)
- Node.js + npm
- Un terminal bash (ex: Git Bash, WSL, ou Terminal VS Code)
- Un serveur de base de données (ex: MySQL)


Markdown

# Structure Complète du Projet SYMFONY_RECETTEMARMITON

SYMFONY_RECETTEMARMITON/
│
├── 📂 assets/ ----------------------------------------------> Fichiers front-end (JS, CSS, images) compilés avec Webpack Encore
│   ├── 📂 controllers/ -------------------------------------> Contrôleurs JS pour Stimulus (Symfony UX)
│   ├── 📂 images/ ------------------------------------------> Images sources utilisées dans le projet
│   │   └── 🖼️ logo.png
│   ├── 📂 js/ ----------------------------------------------> Scripts JS personnalisés
│   │   └── 📜 theme.js -------------------------------------> Script de gestion du thème clair/sombre
│   └── 📂 styles/ ------------------------------------------> Fichiers CSS personnalisés
│       └── 🎨 app.css
│
├── 📂 bin/ -------------------------------------------------> Contient le binaire de la console Symfony
│   └── 📜 console
│
├── 📂 config/ ----------------------------------------------> Fichiers de configuration de l'application Symfony
│   ├── 📂 packages/ ----------------------------------------> Configurations des bundles
│   ├── 📂 routes/ ------------------------------------------> Routes supplémentaires
│   ├── 📜 routes.yaml --------------------------------------> Configuration globale des routes
│   └── 📜 services.yaml ------------------------------------> Déclaration des services personnalisés
│
├── 📂 migrations/ ------------------------------------------> Fichiers de migration Doctrine pour la base de données
│
├── 📂 public/ ----------------------------------------------> Dossier public exposé via le serveur web
│   ├── 📂 css/ ---------------------------------------------> Fichiers CSS compilés
│   ├── 📂 js/ ----------------------------------------------> Fichiers JS compilés
│   └── 📜 index.php ----------------------------------------> Point d'entrée de l'application Symfony
│
├── 📂 src/ -------------------------------------------------> Code source PHP de l'application
│   ├── 📂 Controller/ --------------------------------------> Contrôleurs Symfony
│   │   ├── 📜 SecurityController.php
│   │   └── 📜 UserController.php
│   ├── 📂 Entity/ ------------------------------------------> Entités Doctrine (représentation des tables)
│   │   ├── 📜 Comment.php
│   │   ├── 📜 Ingredient.php
│   │   ├── 📜 Like.php
│   │   ├── 📜 Recipe.php
│   │   └── 📜 User.php
│   ├── 📂 Form/ --------------------------------------------> Classes de formulaire Symfony
│   │   ├── 📜 CommentType.php
│   │   ├── 📜 IngredientType.php
│   │   ├── 📜 RecipeType.php
│   │   └── 📜 RegistrationFormType.php
│   ├── 📂 Repository/ --------------------------------------> Requêtes personnalisées Doctrine
│   │   ├── 📜 CommentRepository.php
│   │   ├── 📜 IngredientRepository.php
│   │   ├── 📜 LikeRepository.php
│   │   ├── 📜 RecipeRepository.php
│   │   └── 📜 UserRepository.php
│   └── 📂 Security/ ----------------------------------------> Authentification et sécurité
│       ├── 📜 AppCustomAuthenticator.php
│       └── 📜 Kernel.php
│
├── 📂 templates/ -------------------------------------------> Fichiers de vues (Twig)
│   ├── 📂 _partials/ ---------------------------------------> Partials réutilisables (header, footer, cartes, etc.)
│   │   ├── 📜 footer.html.twig
│   │   ├── 📜 header.html.twig
│   │   └── 📜 recipe-card.html.twig
│   ├── 📂 admin/ -------------------------------------------> Espace d’administration
│   │   └── 📜 index.html.twig
│   ├── 📂 admin_ingredient/ -------------------------------> Gestion des ingrédients (admin)
│   │   ├── 📜 _ingredient-card.html.twig
│   │   ├── 📜 create.html.twig
│   │   └── 📜 index.html.twig
│   ├── 📂 comment/ ----------------------------------------> Affichage/gestion des commentaires
│   │   └── 📜 index.html.twig
│   ├── 📂 home/ -------------------------------------------> Page d’accueil
│   │   └── 📜 index.html.twig
│   ├── 📂 ingredient/ -------------------------------------> Vue des ingrédients (utilisateur)
│   │   ├── 📜 index.html.twig
│   │   └── 📜 list.html.twig
│   ├── 📂 recette/ ----------------------------------------> Pages liées aux recettes
│   │   ├── 📜 create.html.twig
│   │   ├── 📜 index.html.twig
│   │   └── 📜 show.html.twig
│   └── 📂 registration/ -----------------------------------> Formulaire d’inscription
│       └── 📜 register.html.twig
│
├── 📂 translations/ ----------------------------------------> Fichiers de traduction (i18n)
│
├── 📂 vendor/ ----------------------------------------------> Dépendances installées par Composer (automatique)
│
├── 📜 .env -------------------------------------------------> Configuration des variables d’environnement
├── 📜 .gitignore -------------------------------------------> Fichiers à ignorer par Git
├── 📜 composer.json ----------------------------------------> Dépendances PHP et configuration Composer
├── 📜 composer.lock ----------------------------------------> Versions exactes des dépendances PHP
├── 📜 package.json -----------------------------------------> Dépendances Node.js (JS/CSS)
├── 📜 package-lock.json ------------------------------------> Versions exactes des dépendances Node.js
├── 📜 readme.md --------------------------------------------> Documentation principale du projet
└── 📜 symfony.lock -----------------------------------------> Informations de version pour Symfony Flex


## ⚙️ Étapes de création du projet

### 1. Création du projet Symfony

```bash
symfony new projet_blanc --webapp
cd projet_blanc
