document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.like-simple-btn').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const recipeId = btn.getAttribute('data-recipe-id');
            fetch(`/recette/${recipeId}/like`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (typeof data.liked !== 'undefined') {
                        btn.setAttribute('data-liked', data.liked ? '1' : '0');
                        // Animation SVG cœur
                        const svg = btn.querySelector('svg.like-simple-icon path');
                        if (svg) {
                            svg.setAttribute('fill', data.liked ? '#e63946' : '#e0e0e0');
                        }
                        // Mettre à jour dynamiquement le tooltip
                        const tooltip = btn.querySelector('.custom-tooltip');
                        if (tooltip) {
                            tooltip.textContent = data.liked ? 'Dislike' : 'Like';
                        }
                        // Animation pulse
                        btn.classList.remove('pulse');
                        void btn.offsetWidth; // force reflow
                        btn.classList.add('pulse');
                    }
                });
        });
    });
});
