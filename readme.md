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

<!-- 📁 Symfony_recetteMarmiton  
├── 📂 assets/ ------------------ Fichiers front-end (JS, CSS, images) compilés avec Webpack Encore  
│   ├── 📂 controllers/ ----------- Contrôleurs JS pour Stimulus (Symfony UX)  
│   ├── 📂 images/ --------------- Images sources utilisées dans le projet  
│   ├── 📂 js/ -------------------- Scripts JS personnalisés  
│   └── 📂 styles/ ---------------- Fichiers CSS personnalisés  
├── 📂 bin/ ----------------------- Contient le binaire de la console Symfony  
├── 📂 config/ -------------------- Fichiers de configuration de l'application Symfony  
├── 📂 migrations/ ---------------- Fichiers de migration Doctrine  
├── 📂 public/ --------------------- Dossier public exposé via le serveur web  
├── 📂 src/ ------------------------ Code source PHP du projet  
│   ├── 📂 Controller/ ------------ Contrôleurs Symfony  
│   ├── 📂 Entity/ --------------- Entités Doctrine (représentation des tables)  
│   ├── 📂 Form/ ------------------ Classes de formulaire Symfony  
│   ├── 📂 Repository/ ------------ Requêtes personnalisées Doctrine  
│   └── 📂 Security/ -------------- Authentification et sécurité  
├── 📂 templates/ ------------------ Fichiers de vue (Twig)  
├── 📂 translations/ -------------- Fichiers de traduction (i18n)  
├── 📂 vendor/ -------------------- Dépendances installées par Composer  
├── 📜 .env ----------------------- Variables d’environnement  
└── 📜 composer.json --------------- Dépendances PHP et configuration Composer -->

📁 Symfony_recetteMarmiton  
├── 📂 assets/ --------------------> Fichiers front-end (JS, CSS, images) compilés avec Webpack Encore  
│   ├── 📂 controllers/ -----------> Contrôleurs JS pour Stimulus (Symfony UX)   
│   ├── 📂 images/ ----------------> Images sources utilisées dans le projet  
│   │   └── 🖼️ logo.png           --> Exemple d'image utilisée pour le logo du site
│   ├── 📂 js/ --------------------> Scripts JS personnalisés  
│   │   └── 📜 theme.js -----------> Script de gestion du thème clair/sombre
│   └── 📂 styles/ ----------------> Fichiers CSS personnalisés  
│       └── 🎨 app.css ------------> Fichier CSS principal, incluant les styles de base pour l'application
├── 📂 bin/ -----------------------> Contient le binaire de la console Symfony  
│   └── 📜 console ---------------> Outil de ligne de commande Symfony (exécution de commandes personnalisées)
├── 📂 config/ --------------------> Fichiers de configuration de l'application Symfony  
│   ├── 📂 packages/ --------------> Configurations des bundles Symfony (ex. Doctrine, Twig, Security)  
│   ├── 📂 routes/ ----------------> Routes supplémentaires définies dans le projet  
│   ├── 📜 routes.yaml -----------> Configuration globale des routes (associées aux contrôleurs)  
│   └── 📜 services.yaml ---------> Déclaration des services personnalisés, injection des dépendances
├── 📂 migrations/ ----------------> Fichiers de migration Doctrine pour la base de données  
│   └── 📜 Version1234567890.php --> Exemple d'une migration Doctrine générée pour une mise à jour de base de données
├── 📂 public/ --------------------> Dossier public exposé via le serveur web  
│   ├── 📂 css/ -------------------> Fichiers CSS compilés (depuis `assets/styles/`)  
│   ├── 📂 js/ --------------------> Fichiers JS compilés (depuis `assets/js/`)  
│   └── 📜 index.php --------------> Point d'entrée de l'application Symfony (route principale)
├── 📂 src/ -----------------------> Code source PHP de l'application  
│   ├── 📂 Controller/ ------------> Contrôleurs Symfony gérant les actions et la logique métier  
│   │   ├── 📜 SecurityController.php --> Contrôleur pour la gestion de la sécurité (connexion, déconnexion)
│   │   └── 📜 UserController.php --> Contrôleur pour la gestion des utilisateurs (inscription, profil)  
│   ├── 📂 Entity/ ----------------> Entités Doctrine (représentation des tables en base de données)  
│   │   ├── 📜 Comment.php        --> Entité représentant un commentaire (liée à une recette)
│   │   ├── 📜 Ingredient.php     --> Entité représentant un ingrédient  
│   │   ├── 📜 Like.php           --> Entité représentant un "like" (évaluation d'une recette)
│   │   ├── 📜 Recipe.php         --> Entité représentant une recette (avec ingrédients, catégorie, etc.)
│   │   └── 📜 User.php           --> Entité représentant un utilisateur (avec informations liées à l'authentification)
│   ├── 📂 Form/ ------------------> Classes de formulaire Symfony pour la gestion des données utilisateur  
│   │   ├── 📜 CommentType.php    --> Formulaire pour la création/modification d'un commentaire  
│   │   ├── 📜 IngredientType.php --> Formulaire pour la gestion des ingrédients  
│   │   ├── 📜 RecipeType.php     --> Formulaire pour la gestion des recettes  
│   │   └── 📜 RegistrationFormType.php --> Formulaire pour l'inscription de nouveaux utilisateurs  
│   ├── 📂 Repository/ ------------> Requêtes personnalisées Doctrine (repository)  
│   │   ├── 📜 CommentRepository.php --> Requêtes personnalisées pour la gestion des commentaires  
│   │   ├── 📜 IngredientRepository.php --> Requêtes personnalisées pour la gestion des ingrédients  
│   │   ├── 📜 LikeRepository.php --> Requêtes personnalisées pour la gestion des likes  
│   │   ├── 📜 RecipeRepository.php --> Requêtes personnalisées pour la gestion des recettes  
│   │   └── 📜 UserRepository.php --> Requêtes personnalisées pour la gestion des utilisateurs  
│   └── 📂 Security/ --------------> Authentification et sécurité (gestion des utilisateurs, rôles)  
│       ├── 📜 AppCustomAuthenticator.php --> Authenticator personnalisé pour gérer l'authentification  
│       └── 📜 Kernel.php         --> Configuration de base de l'application Symfony (middleware, services)
├── 📂 templates/ -----------------> Fichiers de vues (Twig)  
│   ├── 📂 _partials/ -------------> Partials réutilisables (header, footer, cartes, etc.)  
│   │   ├── 📜 footer.html.twig   --> Template pour le footer  
│   │   ├── 📜 header.html.twig   --> Template pour l'entête de page  
│   │   └── 📜 recipe-card.html.twig --> Template pour l'affichage d'une recette en carte  
│   ├── 📂 admin/ -----------------> Espace d’administration (gestion des entités)  
│   │   └── 📜 index.html.twig    --> Vue principale du dashboard administrateur  
│   ├── 📂 admin_ingredient/ ------> Gestion des ingrédients (admin)  
│   │   ├── 📜 _ingredient-card.html.twig --> Template pour afficher les ingrédients dans l'admin  
│   │   ├── 📜 create.html.twig   --> Vue pour la création d'un ingrédient  
│   │   └── 📜 index.html.twig    --> Vue listant tous les ingrédients dans l'admin  
│   ├── 📂 comment/ ---------------> Affichage/gestion des commentaires  
│   │   └── 📜 index.html.twig    --> Vue pour afficher la liste des commentaires  
│   ├── 📂 home/ ------------------> Page d’accueil  
│   │   └── 📜 index.html.twig    --> Vue pour l'accueil avec un résumé des recettes populaires  
│   ├── 📂 ingredient/ ------------> Vue des ingrédients (utilisateur)  
│   │   ├── 📜 index.html.twig    --> Vue listant tous les ingrédients  
│   │   └── 📜 list.html.twig     --> Vue détaillant un ingrédient spécifique  
│   ├── 📂 recette/ ---------------> Pages liées aux recettes  
│   │   ├── 📜 create.html.twig   --> Vue de création d'une recette  
│   │   ├── 📜 index.html.twig    --> Vue listant toutes les recettes  
│   │   └── 📜 show.html.twig     --> Vue détaillant une recette spécifique  
│   └── 📂 registration/ ----------> Formulaire d’inscription  
│       └── 📜 register.html.twig --> Template d'inscription des utilisateurs  
├── 📂 translations/


## ⚙️ Étapes de création du projet

### 1. Création du projet Symfony

```bash
symfony new projet_blanc --webapp
cd projet_blanc
