export function initDarkMode() {
    document.addEventListener("DOMContentLoaded", function () {
        const body = document.body;
        const switchInput = document.getElementById("darkModeSwitch");
        const footer = document.getElementById("site-footer");
        const navbars = document.querySelectorAll(".navbar");

        if (!switchInput) return;

        const applyTheme = (isDark) => {
            // Body
            body.classList.toggle("bg-dark", isDark);
            body.classList.toggle("text-light", isDark);
            body.classList.toggle("bg-light", !isDark);
            body.classList.toggle("text-dark", !isDark);

            // Navbar (header)
            navbars.forEach(nav => {
                nav.classList.toggle("navbar-dark", isDark);
                nav.classList.toggle("bg-dark", isDark);
                nav.classList.toggle("navbar-light", !isDark);
                nav.classList.toggle("bg-light", !isDark);
            });

            // Footer
            if (footer) {
                footer.classList.toggle("bg-dark", isDark);
                footer.classList.toggle("text-light", isDark);
                footer.classList.toggle("bg-light", !isDark);
                footer.classList.toggle("text-dark", !isDark);
            }

            // Footer links
            document.querySelectorAll(".footer-link").forEach(link => {
                link.classList.toggle("text-light", isDark);
                link.classList.toggle("text-dark", !isDark);
            });

            // Footer titles
            document.querySelectorAll(".footer-title").forEach(title => {
                title.classList.toggle("text-light", isDark);
                title.classList.toggle("text-dark", !isDark);
            });

            // Footer icons
            document.querySelectorAll(".footer-icon").forEach(icon => {
                icon.classList.toggle("text-white", isDark);
                icon.classList.toggle("text-dark", !isDark);
            });
        };

        const isDark = localStorage.getItem("theme") === "dark";
        applyTheme(isDark);
        switchInput.checked = isDark;

        switchInput.addEventListener("change", function () {
            const isChecked = this.checked;
            localStorage.setItem("theme", isChecked ? "dark" : "light");
            applyTheme(isChecked);
        });
    });
}
