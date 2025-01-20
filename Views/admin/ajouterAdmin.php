<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un administrateur</title>
</head>
<body>
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