<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Administrateur</title>
    <link rel="stylesheet" type="text/css"  href="../public/css/header.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/login.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
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
            <a href="admin.php?action=afficherDashboard">
                <img src="../Ressources/vangovibeslogo.png" alt="logo">
            </a>
        </div>
    </header>
    <h1>Connexion Administrateur</h1>
    <?php if (isset($_SESSION['error_message'])): ?>
        <p class="error-message"><?= htmlspecialchars($_SESSION['error_message']) ?></p>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
    <form action="admin.php?action=login" method="post">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Mot de passe :</label>
        <div style="position: relative;">
            <input type="password" id="password" name="password" required>
            <i class="fas fa-eye-slash" id="togglePassword" onclick="togglePasswordVisibility()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
        </div>
        <br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html> 