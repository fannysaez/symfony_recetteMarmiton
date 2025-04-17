# Projet Symfony 7 - "Projet Blanc" avec Bootstrap 5

Ce projet est un modèle de base pour démarrer une application Symfony 7 sous Windows, avec Bootstrap 5 pour le front-end. Il inclut une gestion d'authentification, un système de rôles (admin/utilisateur), des entités typiques (Recette, Catégorie, Ingrédient, Difficulté), un backoffice et plusieurs fonctionnalités dynamiques comme les likes, les commentaires et le filtrage.


---

## 🛠 Prérequis

- PHP >= 8.1
- [Composer](https://getcomposer.org/)
- [Symfony CLI](https://symfony.com/download)
- Node.js + npm
- Un terminal bash (ex: Git Bash, ou Terminal VS Code)
- Un serveur de base de données (ex: MySQL)

---

## 📚 Table des matières

* [🚀 Présentation du projet](#-présentation-du-projet)  
* [⚙️ Prérequis](#️-prérequis)  
* [🛠️ Installation](#-installation)  
* [▶️ Lancement de l'application](#️-lancement-de-lapplication)  
  - [⚙️ Commandes Symfony 7 CLI](./Procedures%20A%20à%20Z/commandes-symfony7-CLI.md)  
  - [🤝 Commandes Collaboration](./Procedures%20A%20à%20Z/commandes-collaboration.md)  
  - [🌐 Projet Symfony-GitHub](./Procedures%20A%20à%20Z/projetSymfony-Github.md)  
  - [🛠️ Commandes Générales](./Procedures%20A%20à%20Z/commandes.md)  
      - [🔒 Sécurité et Authentification](./Procedures%20A%20à%20Z/securite-et-authentification.md)  
      - [🧩 Fonctionnalités principales](./Procedures%20A%20à%20Z/fonctionnalites-principales.md)  
      - [💬 Commentaires](./Procedures%20A%20à%20Z/commentaires.md)  
      - [🔎 filtres](#filtres)  
      - [🎨 Thème sombre/clair & responsive](#-thème-sombreclair--responsive)  

---

# Structure de Projet 

La structure du projet `Symfony_recetteMarmiton` est la suivante :

```plaintext
📁 Symfony_recetteMarmiton  
├── 📂 **assets/**                                       _Fichiers front-end (JS, CSS, images)_  
│   ├── 📂 **controllers/**                              _Contrôleurs JS (Stimulus)_  
│   │   └── 📜 **hello_controller.js**                   _Exemple de contrôleur Stimulus_  
│   ├── 📂 **images/**                                   _Images utilisées dans le projet_  
│   │   └── 🖼️ **logo.png**                              _Logo du site_  
│   ├── 📂 **js/**                                       _Scripts JS personnalisés_  
│   │   └── 📜 **theme.js**                              _Script de gestion du thème sombre/clair_  
│   └── 📂 **styles/**                                   _Fichiers CSS personnalisés_  
│       └── 🎨 **app.css**                               _CSS principal_  
├── 📂 **bin/**                                          _Binaire de la console Symfony_  
│   └── 📜 **console**                                   _Commande CLI Symfony_  
├── 📂 **config/**                                       _Fichiers de configuration du projet_  
│   ├── 📂 **packages/**                                 _Configuration des bundles (Doctrine, Twig, Security, etc.)_  
│   │   ├── 📜 **doctrine.yaml**                         _Configuration de la base de données_  
│   │   ├── 📜 **twig.yaml**                             _Configuration du moteur de templates Twig_  
│   │   └── 📜 **security.yaml**                         _Configuration des rôles et de l'accès_  
│   ├── 📂 **routes/**                                   _Définition des routes supplémentaires_  
│   │   └── 📜 **annotations.yaml**                      _Chargement des routes par annotations_  
│   ├── 📜 **routes.yaml**                               _Routes principales globales_  
│   └── 📜 **services.yaml**                             _Déclaration des services personnalisés_  
├── 📂 **migrations/**                                   _Migrations Doctrine (structure BDD)_  
│   └── 📜 **VersionXXXXXX.php**                         _Fichier de migration généré automatiquement_  
├── 📂 **public/**                                       _Dossier exposé au navigateur (web root)_  
│   ├── 📂 **css/**                                      _CSS généré (via Webpack Encore)_  
│   ├── 📂 **js/**                                       _JS généré_  
│   └── 📜 **index.php**                                 _Point d'entrée de l'application Symfony_  
├── 📂 **src/**                                          _Code source de l'application (backend)_  
│   ├── 📂 **Controller/**                               _Contrôleurs gérant les routes et la logique_  
│   │   ├── 📜 **RecipeController.php**                  _Contrôleur des recettes_  
│   │   ├── 📜 **CommentController.php**                 _Contrôleur des commentaires_  
│   │   └── 📜 **SecurityController.php**                _Connexion / déconnexion_  
│   ├── 📂 **Entity/**                                   _Entités Doctrine = Modèles de données_  
│   │   ├── 📜 **Recipe.php**                            _Entité Recette_  
│   │   ├── 📜 **Ingredient.php**                        _Entité Ingrédient_  
│   │   ├── 📜 **Comment.php**                           _Entité Commentaire_  
│   │   ├── 📜 **Like.php**                              _Entité Like_  
│   │   └── 📜 **User.php**                              _Entité Utilisateur_  
│   ├── 📂 **Form/**                                     _Formulaires Symfony liés aux entités_  
│   │   ├── 📜 **RecipeType.php**                        _Formulaire de recette_  
│   │   ├── 📜 **CommentType.php**                       _Formulaire de commentaire_  
│   │   ├── 📜 **IngredientType.php**                    _Formulaire d'ingrédient_  
│   │   └── 📜 **RegistrationFormType.php**              _Formulaire d’inscription utilisateur_  
│   ├── 📂 **Repository/**                               _Requêtes personnalisées (Doctrine)_  
│   │   ├── 📜 **RecipeRepository.php**                  _Requêtes liées aux recettes_  
│   │   ├── 📜 **CommentRepository.php**                 _Requêtes liées aux commentaires_  
│   │   └── 📜 **UserRepository.php**                    _Requêtes liées aux utilisateurs_  
│   └── 📂 **Security/**                                 _Sécurité, login, authentification_  
│       ├── 📜 **AppCustomAuthenticator.php**            _Authentificateur personnalisé_  
│       └── 📜 **Kernel.php**                            _Configuration du noyau Symfony_  
├── 📂 **templates/**                                    _Templates Twig (vue HTML)_  
│   ├── 📂 **_partials/**                                _Morceaux réutilisables de template_  
│   │   ├── 📜 **header.html.twig**                      _En-tête du site_  
│   │   ├── 📜 **footer.html.twig**                      _Pied de page_  
│   │   └── 📜 **recipe-card.html.twig**                 _Affichage d'une recette en carte_  
│   ├── 📂 **admin/**                                    _Dashboard Admin_  
│   │   └── 📜 **index.html.twig**                       _Accueil admin_  
│   ├── 📂 **admin_ingredient/**                         _Gestion des ingrédients (admin)_  
│   │   ├── 📜 **create.html.twig**                      _Formulaire ajout ingrédient_  
│   │   ├── 📜 **index.html.twig**                       _Liste des ingrédients_  
│   │   └── 📜 **_ingredient-card.html.twig**            _Carte ingrédient admin_  
│   ├── 📂 **comment/**                                  _Affichage des commentaires_  
│   │   └── 📜 **index.html.twig**                       _Liste des commentaires_  
│   ├── 📂 **home/**                                     _Page d’accueil du site_  
│   │   └── 📜 **index.html.twig**                       _Recettes populaires_  
│   ├── 📂 **ingredient/**                               _Pages des ingrédients (front utilisateur)_  
│   │   ├── 📜 **index.html.twig**                       _Liste des ingrédients_  
│   │   └── 📜 **list.html.twig**                        _Détail d’un ingrédient_  
│   ├── 📂 **recette/**                                  _Pages de gestion des recettes_  
│   │   ├── 📜 **create.html.twig**                      _Création d’une recette_  
│   │   ├── 📜 **index.html.twig**                       _Liste des recettes_  
│   │   └── 📜 **show.html.twig**                        _Détail d’une recette_  
│   └── 📂 **registration/**                             _Pages liées à l’inscription_  
│       └── 📜 **register.html.twig**                    _Formulaire d’inscription_  
├── 📂 **translations/**                                 _Fichiers de traduction (i18n)_  
│   └── 📜 **messages.fr.yaml**                          _Traductions en français_  

```
---

## ⚙️ Étapes de création du projet

### 1. Création du projet Symfony

```bash
symfony new projet_blanc --webapp
cd projet_blanc
```

---
## ▶️ Lancement de l'application

1. Lancer le serveur Symfony local :

```bash
symfony serve
```

2. Accéder à l'application :

* Ouvrez votre navigateur et allez à `http://localhost:8000`.

--- 

## 🧪 Configuration de la base de données

Dans le fichier `.env`, configurer la ligne :

```env
DATABASE_URL="mysql://root@127.0.0.1:3306/symfony_recetteMarmiton?serverVersion=8.0.32&charset=utf8mb4"
```

ensuite :

```bash
symfony console doctrine:database:create
```
---
<p align="center">
  <a href="Procedures A à Z/commandes-symfony7-CLI.md">Suivant</a>
</p>