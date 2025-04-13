## Initialiser un projet Symfony via un compte GitHub

| Commande | Description |
|----------|-------------|
| `symfony new mon_projet --webapp` | Crée un nouveau projet Symfony 7 avec Twig, Doctrine, Security, etc. |
| `git init` | Initialise un nouveau dépôt Git dans le dossier du projet. |
| `git remote add origin https://github.com/username/mon_projet.git` | Ajoute un dépôt distant GitHub à votre projet. Remplacez `username/mon_projet.git` par votre propre dépôt GitHub. |
| `git status` | Vérifie le statut actuel du dépôt Git pour voir les fichiers non suivis et non commis. |
| `git add .` | Ajoute tous les fichiers du projet au suivi Git. |
| `git config --global --add safe.directory 'C:/Users/fanny/Desktop/Briefs/Brief 16 - Marmite Ronde_Symfony/symfony_recetteMarmiton'` | Ajoute un répertoire comme sûr dans Git, nécessaire si Git signale un problème avec les chemins contenant des espaces ou des caractères spéciaux. |
| `git commit -m "Initial commit"` | Crée un commit avec le message "Initial commit". |
| `git push -u origin main` | Pousse les changements vers le dépôt GitHub (branche `main`). |

---

## Travailler à plusieurs sur un projet (GitHub)

| Commande | Description |
|----------|-------------|
| `git clone https://github.com/username/mon_projet.git` | Clone le dépôt GitHub sur votre machine locale. Remplacez `username/mon_projet.git` par l'URL de votre dépôt. |
| `git fetch` | Récupère les dernières modifications du dépôt distant sans les appliquer à votre branche locale. |
| `git pull origin main` | Récupère et fusionne les dernières modifications de la branche `main` depuis le dépôt distant. |
| `git checkout -b nouvelle-branche` | Crée et bascule sur une nouvelle branche pour travailler sur une fonctionnalité sans affecter la branche principale. |
| `git add .` | Ajoute tous les fichiers modifiés au suivi de Git. |
| `git commit -m "Message de commit"` | Crée un commit avec un message décrivant les changements effectués. |
| `git push origin nouvelle-branche` | Pousse les modifications locales de la branche `nouvelle-branche` vers le dépôt distant. |
| `git pull origin nouvelle-branche` | Récupère les dernières modifications de la branche spécifique avant de pousser vos propres modifications. |
| `git merge nouvelle-branche` | Fusionne les modifications de la branche `nouvelle-branche` dans la branche courante. |
| `git rebase main` | Applique les commits de la branche courante au-dessus de la branche `main`, pour une histoire de commit plus linéaire. |
| `git push --set-upstream origin main` | Si vous travaillez sur la branche principale pour la première fois, cette commande lie votre branche locale à la branche `main` du dépôt distant. |

---

<p align="center">
  <a href="./...">Suivant</a>
</p>
