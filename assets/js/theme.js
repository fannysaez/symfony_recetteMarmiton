export function initDarkMode() {
    document.addEventListener("DOMContentLoaded", function () {
        const body = document.body;
        const switchInput = document.getElementById("darkModeSwitch");

        if (!switchInput) return;

        const applyTheme = (isDark) => {
            if (isDark) {
                body.classList.add("bg-dark", "text-light");
                document.querySelectorAll(".navbar").forEach(el => el.classList.remove("navbar-light", "bg-light"));
                document.querySelectorAll(".navbar").forEach(el => el.classList.add("navbar-dark", "bg-dark"));
            } else {
                body.classList.remove("bg-dark", "text-light");
                document.querySelectorAll(".navbar").forEach(el => el.classList.remove("navbar-dark", "bg-dark"));
                document.querySelectorAll(".navbar").forEach(el => el.classList.add("navbar-light", "bg-light"));
            }
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