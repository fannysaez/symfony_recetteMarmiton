# Projet Symfony 7 - "Projet Blanc" avec Bootstrap 5

Ce projet est un modèle de base pour démarrer une application Symfony 7 sous Windows, avec Bootstrap 5 pour le front-end. Il inclut une gestion d'authentification, un système de rôles (admin/utilisateur), des entités typiques (Recette, Catégorie, Ingrédient, Difficulté), un backoffice et plusieurs fonctionnalités dynamiques comme les likes, les commentaires et le filtrage.


---

## 🛠 Prérequis

- PHP >= 8.1
- [Composer](https://getcomposer.org/)
- [Symfony CLI](https://symfony.com/download)
- Node.js + npm
- Un terminal bash (ex: Git Bash, WSL, ou Terminal VS Code)
- Un serveur de base de données (ex: MySQL)

---

## 📚 Table des matières

1. [🚀 Présentation du projet](#-présentation-du-projet)  
2. [⚙️ Prérequis](#️-prérequis)  
3. [🛠️ Installation](#️-installation)  
4. [▶️ Lancement de l'application](#️-lancement-de-lapplication)  
5. [🗃️ Structure du projet](#️-structure-du-projet)  
6. [🧩 Fonctionnalités principales](#-fonctionnalités-principales)  
7. [👤 Authentification et rôles](#-authentification-et-rôles)  
8. [🖼️ Gestion des entités (CRUD)](#️-gestion-des-entités-crud)  
9. [💬 Commentaires & Likes](#-commentaires--likes)  
10. [🔎 Filtres et recherche avancée](#-filtres-et-recherche-avancée)  
11. [🎨 Thème sombre/clair & responsive](#-thème-sombreclair--responsive)  
12. [🧪 Données de test (fixtures)](#-données-de-test-fixtures)  
13. [🔐 Sécurité & accès](#-sécurité--accès)  
14. [📂 Arborescence complète](#-arborescence-complète)  
15. [📝 Crédits & Auteurs](#-crédits--auteurs)

---

# Structure de Projet 

📁 Symfony_recetteMarmiton  
├── 📂 assets/ ---------------------------> Fichiers front-end non compilés (JS, CSS, images)  
│   ├── 📂 controllers/ ------------------> Contrôleurs JS (Stimulus)  
│   │   └── 📜 hello_controller.js -------> Exemple de contrôleur Stimulus  
│   ├── 📂 images/ -----------------------> Images brutes utilisées dans le projet  
│   │   └── 🖼️ logo.png -------------------> Logo du site  
│   ├── 📂 js/ ---------------------------> Scripts JS personnalisés  
│   │   └── 📜 theme.js ------------------> Script de gestion du thème sombre/clair  
│   └── 📂 styles/ -----------------------> Fichiers CSS personnalisés  
│       └── 🎨 app.css -------------------> CSS principal  
├── 📂 bin/ ------------------------------> Binaire de la console Symfony  
│   └── 📜 console -----------------------> Commande CLI Symfony  
├── 📂 config/ ---------------------------> Fichiers de configuration du projet  
│   ├── 📂 packages/ ---------------------> Config des bundles (Doctrine, Twig, Security...)  
│   │   ├── 📜 doctrine.yaml -------------> Configuration de la base de données  
│   │   ├── 📜 twig.yaml -----------------> Configuration du moteur de templates Twig  
│   │   └── 📜 security.yaml -------------> Configuration des rôles et de l'accès  
│   ├── 📂 routes/ -----------------------> Définition des routes supplémentaires  
│   │   └── 📜 annotations.yaml ----------> Chargement des routes par annotations  
│   ├── 📜 routes.yaml -------------------> Routes principales globales  
│   └── 📜 services.yaml -----------------> Déclaration des services personnalisés  
├── 📂 migrations/ -----------------------> Migrations Doctrine (structure BDD)  
│   └── 📜 VersionXXXXXX.php -------------> Fichier de migration généré automatiquement  
├── 📂 public/ ---------------------------> Dossier exposé au navigateur (web root)  
│   ├── 📂 css/ --------------------------> CSS généré (via Webpack Encore)  
│   ├── 📂 js/ ---------------------------> JS généré  
│   └── 📜 index.php ---------------------> Point d'entrée de l'application Symfony  
├── 📂 src/ ------------------------------> Code source de l'application (backend)  
│   ├── 📂 Controller/ -------------------> Contrôleurs gérant les routes et la logique  
│   │   ├── 📜 RecipeController.php ------> Contrôleur des recettes  
│   │   ├── 📜 CommentController.php -----> Contrôleur des commentaires  
│   │   └── 📜 SecurityController.php ----> Connexion / déconnexion  
│   ├── 📂 Entity/ -----------------------> Entités Doctrine = Modèles de données  
│   │   ├── 📜 Recipe.php ----------------> Entité Recette  
│   │   ├── 📜 Ingredient.php ------------> Entité Ingrédient  
│   │   ├── 📜 Comment.php ---------------> Entité Commentaire  
│   │   ├── 📜 Like.php ------------------> Entité Like  
│   │   └── 📜 User.php ------------------> Entité Utilisateur  
│   ├── 📂 Form/ -------------------------> Formulaires Symfony liés aux entités  
│   │   ├── 📜 RecipeType.php ------------> Formulaire de recette  
│   │   ├── 📜 CommentType.php -----------> Formulaire de commentaire  
│   │   ├── 📜 IngredientType.php --------> Formulaire d'ingrédient  
│   │   └── 📜 RegistrationFormType.php --> Formulaire d’inscription utilisateur  
│   ├── 📂 Repository/ -------------------> Requêtes personnalisées (Doctrine)  
│   │   ├── 📜 RecipeRepository.php ------> Requêtes liées aux recettes  
│   │   ├── 📜 CommentRepository.php -----> Requêtes liées aux commentaires  
│   │   └── 📜 UserRepository.php --------> Requêtes liées aux utilisateurs  
│   └── 📂 Security/ ---------------------> Sécurité, login, authentification  
│       ├── 📜 AppCustomAuthenticator.php -> Authentificateur personnalisé  
│       └── 📜 Kernel.php ----------------> Configuration du noyau Symfony  
├── 📂 templates/ ------------------------> Templates Twig (vue HTML)  
│   ├── 📂 _partials/ --------------------> Morceaux réutilisables de template  
│   │   ├── 📜 header.html.twig ----------> En-tête du site  
│   │   ├── 📜 footer.html.twig ----------> Pied de page  
│   │   └── 📜 recipe-card.html.twig -----> Affichage d'une recette en carte  
│   ├── 📂 admin/ ------------------------> Dashboard Admin  
│   │   └── 📜 index.html.twig -----------> Accueil admin  
│   ├── 📂 admin_ingredient/ -------------> Gestion des ingrédients (admin)  
│   │   ├── 📜 create.html.twig ----------> Formulaire ajout ingrédient  
│   │   ├── 📜 index.html.twig -----------> Liste des ingrédients  
│   │   └── 📜 _ingredient-card.html.twig -> Carte ingrédient admin  
│   ├── 📂 comment/ ----------------------> Affichage des commentaires  
│   │   └── 📜 index.html.twig -----------> Liste des commentaires  
│   ├── 📂 home/ -------------------------> Page d’accueil du site  
│   │   └── 📜 index.html.twig -----------> Recettes populaires  
│   ├── 📂 ingredient/ -------------------> Pages des ingrédients (front utilisateur)  
│   │   ├── 📜 index.html.twig -----------> Liste des ingrédients  
│   │   └── 📜 list.html.twig ------------> Détail d’un ingrédient  
│   ├── 📂 recette/ ----------------------> Pages de gestion des recettes  
│   │   ├── 📜 create.html.twig ----------> Création d’une recette  
│   │   ├── 📜 index.html.twig -----------> Liste des recettes  
│   │   └── 📜 show.html.twig ------------> Détail d’une recette  
│   └── 📂 registration/ -----------------> Pages liées à l’inscription  
│       └── 📜 register.html.twig --------> Formulaire d’inscription  
├── 📂 translations/ ---------------------> Fichiers de traduction (i18n)  
│   └── 📜 messages.fr.yaml --------------> Traductions en français

---

<p align="center">
  <a href="Procedures A à Z/installation.md">Suivant</a>
</p>