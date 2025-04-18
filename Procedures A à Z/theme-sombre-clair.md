# 🎨 Thème sombre / clair & responsive

1. ⚙️ Base HTML avec classes Bootstrap 5

Dans base.html.twig, assure-toi d’avoir :

```html
<!DOCTYPE html>
<html lang="fr" data-bs-theme="light"> <!-- par défaut -->
<head>
    ...
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    {% include '_partials/navbar.html.twig' %}
    
    <div class="container mt-4">
        {% block body %}{% endblock %}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {% block javascripts %}{% endblock %}
</body>
</html>
```

---

2. 🌗 Ajout du bouton de switch thème

Dans ton navbar.html.twig :

```twig
<button id="theme-toggle" class="btn btn-sm btn-outline-secondary ms-auto">
    Thème : <span id="theme-label">Clair</span>
</button>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggle = document.getElementById('theme-toggle');
        const label = document.getElementById('theme-label');
        const html = document.documentElement;
        const storedTheme = localStorage.getItem('theme');

        if (storedTheme) {
            html.setAttribute('data-bs-theme', storedTheme);
            label.textContent = storedTheme === 'dark' ? 'Sombre' : 'Clair';
        }

        toggle.addEventListener('click', () => {
            const current = html.getAttribute('data-bs-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-bs-theme', next);
            label.textContent = next === 'dark' ? 'Sombre' : 'Clair';
            localStorage.setItem('theme', next);
        });
    });
</script>

```

* Le data-bs-theme est lu automatiquement par Bootstrap 5.3+
* On utilise localStorage pour mémoriser le choix du thème
* Pas besoin de surcharge CSS, tout est natif Bootstrap

---

3. ✅ Responsive Design

Bootstrap 5 est responsive par défaut grâce à son grid system. Assure-toi :

- d’utiliser des classes .container, .row, .col-md-6, etc.
- de rendre les cartes recettes responsives :

```twig
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
    {% for recipe in recipes %}
        <div class="col">
            <div class="card h-100">
                <img src="{{ asset(recipe.imagePath) }}" class="card-img-top" alt="{{ recipe.title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ recipe.title }}</h5>
                    <p class="card-text">Durée : {{ recipe.duration }} min</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Par {{ recipe.author.email }}</small>
                </div>
            </div>
        </div>
    {% endfor %}
</div>

```

---

🎨 Étape 1 : Ajouter le toggle HTML dans le layout

Ouvre ton fichier de layout principal (par exemple : templates/base.html.twig) :

```twig
<!-- templates/base.html.twig -->

<!DOCTYPE html>
<html lang="fr" data-bs-theme="light"> {# Valeur par défaut #}
<head>
    <meta charset="UTF-8">
    <title>{% block title %}Recettes{% endblock %}</title>
    <link rel="stylesheet" href="{{ asset('build/app.css') }}">
    {% block stylesheets %}{% endblock %}
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo / marque -->
            <a class="navbar-brand" href="#">Marmiton</a>

            <!-- Toggle dark mode -->
            <div class="form-check form-switch ms-auto">
                <input class="form-check-input" type="checkbox" id="themeToggle">
                <label class="form-check-label" for="themeToggle">🌙</label>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        {% block body %}{% endblock %}
    </div>

    {% block javascripts %}
        <script src="{{ asset('build/app.js') }}"></script>
    {% endblock %}
</body>
</html>

```

🧠 Étape 2 : Ajoute le JavaScript theme.js

Crée un fichier JS (si tu n’en as pas déjà un) :

```bash
touch assets/theme.js
```

```js
// assets/theme.js

document.addEventListener("DOMContentLoaded", function () {
    const themeToggle = document.getElementById("themeToggle");
    const html = document.documentElement;

    // Appliquer le thème depuis localStorage
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        html.setAttribute("data-bs-theme", savedTheme);
        themeToggle.checked = savedTheme === "dark";
    }

    // Événement du switch
    themeToggle.addEventListener("change", function () {
        const newTheme = this.checked ? "dark" : "light";
        html.setAttribute("data-bs-theme", newTheme);
        localStorage.setItem("theme", newTheme);
    });
});

```

🔧 Étape 3 : Importer le JS dans Webpack Encore

Dans ton assets/app.js, ajoute à la fin :

```bash
import './theme.js';
```

🎨 Étape 4 : Activer Bootstrap 5 data-bs-theme

Bootstrap 5.3+ supporte nativement les thèmes via `data-bs-theme="dark" ou light`.

Tu peux ajouter tes propres styles CSS si besoin dans `app.css` :

```css
// assets/styles/app.css

body {
    transition: background-color 0.3s ease, color 0.3s ease;
}

[data-bs-theme="dark"] {
    background-color: #121212;
    color: #f1f1f1;

    .navbar {
        background-color: #1f1f1f !important;
    }

    .card {
        background-color: #2a2a2a;
        color: #ffffff;
    }

    .form-control {
        background-color: #2a2a2a;
        color: #fff;
        border-color: #444;
    }
}

```

Puis n'oublie pas de l'importer dans `app.js` :

```js
import './styles/app.css';
```

---

<p align="center">
  <a href="../readme.md">Suivant</a>
</p>