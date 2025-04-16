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

<p align="center">
  <a href="./theme-sombre-clair.md">Suivant</a>
</p>