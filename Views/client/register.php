<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css"  href="../public/css/header.css"/>
    <link rel="stylesheet" type="text/css"  href="../public/css/login.css"/>
</head>
<body>
    <header>
        <div>
            <a href="client.php?action=afficherProduits">
                <img src="../Ressources/vangovibeslogo.png" alt="logo">
            </a>
        </div>
    </header>
    <h1>Inscription</h1>
    <form action="client.php?action=register" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <br>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
        <br>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="telephone" required>
        <br>
        <label for="adresse">Adresse :</label>
        <input type="text" id="numero_rue" name="numero_rue" placeholder="Numéro de rue" required>
        <input type="text" id="nom_rue" name="nom_rue" placeholder="Nom de rue" required>
        <input type="text" id="code_postal" name="code_postal" placeholder="Code postal" required>
        <input type="text" id="ville" name="ville" placeholder="Ville" required>
        <br>
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        <br>
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html> 