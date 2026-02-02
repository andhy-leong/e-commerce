// public/js/passwordShow.js
function togglePasswordVisibility(inputId, iconId) {
    var passwordInput = document.getElementById(inputId);
    var toggleButton = document.getElementById(iconId);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleButton.classList.remove("fa-eye-slash"); // Icône barrée
        toggleButton.classList.add("fa-eye"); // Icône normale
    } else {
        passwordInput.type = "password";
        toggleButton.classList.remove("fa-eye"); // Icône normale
        toggleButton.classList.add("fa-eye-slash"); // Icône barrée
    }
}