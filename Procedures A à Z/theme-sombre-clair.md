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
---

<p align="center">
  <a href="../readme.md">Suivant</a>
</p>