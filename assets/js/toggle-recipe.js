document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-recipe-content').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const content = this.closest('.card').querySelector('.recipe-content');
            if (content) {
                content.classList.toggle('hidden');
            }
        });
    });
});
