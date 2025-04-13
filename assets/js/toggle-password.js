document.addEventListener('DOMContentLoaded', function () {
    // Gestion du mot de passe pour la connexion
    const passwordInputLogin = document.getElementById('inputPassword');
    const toggleButtonLogin = document.getElementById('togglePasswordLogin');
    const eyeIconLogin = document.getElementById('eyeIconLogin');
    
    if (passwordInputLogin && toggleButtonLogin) {
        toggleButtonLogin.addEventListener('click', function () {
            const type = passwordInputLogin.type === 'password' ? 'text' : 'password';
            passwordInputLogin.type = type;
            eyeIconLogin.classList.toggle('bi-eye-slash');
            eyeIconLogin.classList.toggle('bi-eye');
        });
    }

    // Gestion du mot de passe pour l'inscription
    const passwordInputRegister = document.getElementById('password');
    const toggleButtonRegister = document.getElementById('togglePasswordRegister');
    const eyeIconRegister = document.getElementById('eyeIconRegister');
    
    if (passwordInputRegister && toggleButtonRegister) {
        toggleButtonRegister.addEventListener('click', function () {
            const type = passwordInputRegister.type === 'password' ? 'text' : 'password';
            passwordInputRegister.type = type;
            eyeIconRegister.classList.toggle('bi-eye-slash');
            eyeIconRegister.classList.toggle('bi-eye');
        });
    }
});
