<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Client</title>
    <link rel="stylesheet" type="text/css" href="../public/css/header.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/login.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("mot_de_passe");
            var toggleButton = document.getElementById("togglePassword");
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
    </script>
</head>
<body>
    <header>
        <div>
            <a href="client.php?action=afficherProduits">
                <img src="../Ressources/vangovibeslogo.png" alt="logo">
            </a>
        </div>
    </header>
    <h1>Connexion Client</h1>
    <?php if (isset($_SESSION['error_message'])): ?>
        <p class="error-message"><?= htmlspecialchars($_SESSION['error_message']) ?></p>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
    <form action="client.php?action=login" method="post">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="mot_de_passe">Mot de passe :</label>
        <div style="position: relative;">
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            <i class="fas fa-eye-slash" id="togglePassword" onclick="togglePasswordVisibility()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
        </div>
        <br>
        <button type="submit">Se connecter</button>
    </form>
    
    <div class="center-text">
        <p>Vous n'avez toujours pas de compte? <a href="client.php?action=registerForm">S'inscrire</a></p>
        <p>Vous êtes administrateur? <a href="admin.php?action=loginForm">Connectez-vous</a></p>
    </div>
</body>
</html>