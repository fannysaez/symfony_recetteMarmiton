## Initialiser un projet Symfony via un compte GitHub

| Commande | Description |
|----------|-------------|
| `symfony new mon_projet --webapp` | Crée un nouveau projet Symfony 7 avec Twig, Doctrine, Security, etc. |
| `git init` | Initialise un nouveau dépôt Git dans le dossier du projet. |
| `git remote add origin https://github.com/username/mon_projet.git` | Ajoute un dépôt distant GitHub à votre projet. Remplacez `username/mon_projet.git` par votre propre dépôt GitHub. |
| `git status` | Vérifie le statut actuel du dépôt Git pour voir les fichiers non suivis et non commis. |
| `git config --global --add safe.directory 'C:/Users/fanny/Desktop/Briefs/Brief 16 - Marmite Ronde_Symfony/symfony_recetteMarmiton'` | Ajoute un répertoire comme sûr dans Git, nécessaire si Git signale un problème avec les chemins contenant des espaces ou des caractères spéciaux. |
| `git add .` | Ajoute tous les fichiers du projet au suivi Git. |
| `git commit -m "Initial commit"` | Crée un commit avec le message "Initial commit". |
| `git push -u origin master` | Pousse les changements vers le dépôt GitHub (branche `master` ou `main` selon le nom de votre branche par défaut). |
---

<p align="center">
  <a href="./commandes.md">Suivant</a>
</p>