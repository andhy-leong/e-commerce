<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css"  href="../public/css/header.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/login.css"/>
</head>
<body>
    <header>
        <div>
            <a href="client.php?action=afficherProduits">
                <img src="../Ressources/vangovibeslogo.png" alt="logo">
            </a>
        </div>
    </header>
    <h1>Connexion</h1>
    <?php if (isset($errorMessage)): ?>
        <p style="color: red;"><?= htmlspecialchars($errorMessage) ?></p>
    <?php endif; ?>
    <form action="client.php?action=login" method="post">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>
    
    <div class="center-text">
        <p>Vous n'avez toujours pas de compte? <a href="client.php?action=registerForm">S'inscrire</a></p>
        <p>Vous êtes administrateur? <a href="admin.php?action=loginForm">Connectez-vous</a></p>
    </div>
</body>
</html>