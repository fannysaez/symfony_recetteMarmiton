# Commandes Symfony 7 - CLI & Dépendances

## Sommaire

- Installation des dépendances via npm
- Importer Bootstrap via Importmap
- Commandes Symfony 7 CLI - Principales
- Commandes Symfony 7 - Création de commandes et filtres personnalisés
- Revenir en arrière après avoir modifié une entité
- Outils de débogage principaux
- Mes Projets

---

## Installation des dépendances via npm

| Commande                                  | Description                                                |
|-------------------------------------------|------------------------------------------------------------|
| `npm install bootstrap @popperjs/core sass --save` | Installe Bootstrap 5 et ses dépendances via npm.          |

---

## Importer Bootstrap via Importmap

| Commande                                  | Description                                                |
|-------------------------------------------|------------------------------------------------------------|
| `php bin/console importmap:require bootstrap` | Ajoute Bootstrap via Importmap dans le projet Symfony.     |

---

## Commandes Symfony 7 CLI - Principales

| Commande                                     | Description                                                                 |
|----------------------------------------------|-----------------------------------------------------------------------------|
| `symfony new mon_projet --webapp`            | Crée un nouveau projet Symfony 7 avec Twig, Doctrine, Security, etc.        |
| `symfony serve`                              | Lance le serveur local de développement.                                   |
| `symfony composer install`                   | Installe les dépendances PHP du projet.                                    |
| `symfony console make:entity`                | Crée une nouvelle entité Doctrine.                                         |
| `symfony console make:controller NomController` | Crée un contrôleur avec une vue Twig.                                      |
| `symfony console make:form`                  | Crée un formulaire basé sur une entité.                                    |
| `symfony console make:crud NomEntité`        | Génère un CRUD complet (formulaires + vues).                               |
| `symfony console make:user`                  | Crée une entité User avec rôles et authentification.                         |
| `symfony console make:auth`                  | Génère un système de connexion.                                             |
| `symfony console doctrine:migrations:migrate` | Applique les migrations à la base.                                          |

---

## Commandes Symfony 7 - Création de commandes et filtres personnalisés

| Commande                                   | Description                                                                 |
|--------------------------------------------|-----------------------------------------------------------------------------|
| `symfony console make:command`             | Crée une commande Symfony personnalisée (dans `src/Command`).              |
| `symfony console make:filter`              | Crée un filtre personnalisé.                                               |
| `symfony console make:twig-extension`      | Crée une extension Twig personnalisée.                                    |
| `symfony console make:subscriber`          | Crée un abonné à un événement Symfony.                                     |

---

## Revenir en arrière après avoir modifié une entité

| Commande                                   | Description                                                |
|--------------------------------------------|------------------------------------------------------------|
| `symfony console d:d:c`                    | Supprime les tables de la base de données.                  |
| `symfony console d:m:diff`                 | Génère un fichier de différence de migration.              |
| `symfony console d:m:m`                    | Applique les migrations à la base.                           |

---

## Outils de débogage principaux

| Outil                     | Description                                     |
|---------------------------|-------------------------------------------------|
| `symfony console debug:router` | Affiche la liste des routes disponibles.        |
| `symfony console debug:twig`   | Affiche les extensions Twig activées.          |

---

<p align="center">
  <a href="Procedures A à Z/commandes-symfony7-CLI.md">Suivant</a>
</p>
