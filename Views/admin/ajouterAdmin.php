<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un administrateur</title>
    <link rel="stylesheet" type="text/css"  href="../public/css/header.css"/>
</head>
<body>
<header>
        <div>
        <a href="admin.php?action=afficherDashboard">
                <img src="../Ressources/vangovibeslogo.png" alt="logo">
            </a>
        </div>
    </header>
    <h1>Ajouter un Administrateur</h1>
    <form action="admin.php?action=ajouterAdmin" method="post">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Ajouter l'administrateur</button>
    </form>
</body>
</html> 