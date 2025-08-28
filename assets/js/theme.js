export function initDarkMode() {
    function applyTheme(isDark) {
        const body = document.body;
        const footer = document.getElementById("site-footer");
        const navbars = document.querySelectorAll(".navbar");
        body.classList.toggle("bg-dark", isDark);
        body.classList.toggle("text-light", isDark);
        body.classList.toggle("bg-light", !isDark);
        body.classList.toggle("text-dark", !isDark);
        body.classList.toggle("dark", isDark);
        navbars.forEach(nav => {
            nav.classList.toggle("navbar-dark", isDark);
            nav.classList.toggle("bg-dark", isDark);
            nav.classList.toggle("navbar-light", !isDark);
            nav.classList.toggle("bg-light", !isDark);
        });
        if (footer) {
            footer.classList.toggle("bg-dark", isDark);
            footer.classList.toggle("text-light", isDark);
            footer.classList.toggle("bg-light", !isDark);
            footer.classList.toggle("text-dark", !isDark);
        }
        document.querySelectorAll(".footer-link").forEach(link => {
            link.classList.toggle("text-light", isDark);
            link.classList.toggle("text-dark", !isDark);
        });
        document.querySelectorAll(".footer-title").forEach(title => {
            title.classList.toggle("text-light", isDark);
            title.classList.toggle("text-dark", !isDark);
        });
        document.querySelectorAll(".footer-icon").forEach(icon => {
            icon.classList.toggle("text-white", isDark);
            icon.classList.toggle("text-dark", !isDark);
        });
    }

    function syncSwitchWithTheme() {
        const switchInput = document.getElementById("darkModeSwitch");
        if (switchInput) {
            const isDark = localStorage.getItem("theme") === "dark";
            switchInput.checked = isDark;
            switchInput.onchange = function () {
                localStorage.setItem("theme", this.checked ? "dark" : "light");
                applyTheme(this.checked);
            };
        }
    }

    // Appliquer le thème dès le chargement
    document.addEventListener("DOMContentLoaded", function () {
        const isDark = localStorage.getItem("theme") === "dark";
        applyTheme(isDark);
        syncSwitchWithTheme();
        // Observer les changements du DOM pour réappliquer le thème et resynchroniser le switch
        const observer = new MutationObserver(() => {
            const isDark = localStorage.getItem("theme") === "dark";
            applyTheme(isDark);
            syncSwitchWithTheme();
        });
        observer.observe(document.body, { childList: true, subtree: true });
    });
}