<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - VangoVibes</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <div>
            <a href="client.php?action=afficherProduits">
                <img src="Ressources/vangovibeslogo.png" alt="logo VangoVibes">
            </a>
        </div>
    </header>
    <h1>Inscription</h1>
    <form action="client.php?action=register" method="post" class="form-register">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required autocomplete="family-name">
        
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required autocomplete="given-name">
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required autocomplete="email">
        
        <label for="telephone">Téléphone :</label>
        <input type="tel" id="telephone" name="telephone" required autocomplete="tel">
        
        <label>Adresse postale :</label>
        <div class="adresse-groupe">
            <input type="text" id="numero_rue" name="numero_rue" placeholder="N° de rue" required>
            <input type="text" id="nom_rue" name="nom_rue" placeholder="Nom de rue" required>
            <input type="text" id="code_postal" name="code_postal" placeholder="Code postal" required>
            <input type="text" id="ville" name="ville" placeholder="Ville" required>
        </div>
        
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required autocomplete="new-password">
        
        <button type="submit">S'inscrire</button>
    </form>
    
    <div class="center-text">
        <p>Vous avez déjà un compte ? <a href="client.php?action=loginForm">Se connecter</a></p>
        <p><a href="client.php?action=afficherProduits" class="retour-lien">&larr; Retour à la boutique</a></p>
    </div>
</body>
</html>