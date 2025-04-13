
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
  <a href="./projetSymfony-Github.md">Suivant</a>
</p>