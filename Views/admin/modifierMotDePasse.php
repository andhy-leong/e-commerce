<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le mot de passe</title>
    <link rel="stylesheet" type="text/css"  href="css/header.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header>
        <div>
            <a href="admin.php?action=afficherDashboard">
                <img src="../Ressources/vangovibeslogo.png" alt="logo">
            </a>
        </div>
    </header>
    <form action="admin.php?action=modifierMotDePasse" method="post">
        <label for="ancienMotDePasse">Ancien mot de passe :</label>
        <input type="password" id="ancienMotDePasse" name="ancienMotDePasse" required>
        <br>
        <label for="nouveauMotDePasse">Nouveau mot de passe :</label>
        <input type="password" id="nouveauMotDePasse" name="nouveauMotDePasse" required>
        <br>
        <button type="submit">Modifier le mot de passe</button>
    </form>
</body>
</html> 