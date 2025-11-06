<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Fournisseur</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/ajoutFournisseur.css"/>
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
<h1>Ajouter un Fournisseur</h1>
<form action="admin.php?action=ajouterFournisseur" method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
    <br>
    <label for="adresse">Adresse :</label>
    <input type="text" id="adresse" name="adresse" required>
    <br>
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="telephone">Téléphone :</label>
    <input type="text" id="telephone" name="telephone" required>
    <br>
    <label for="produits_vendus">Produits Vendus :</label>
    <select id="produits_vendus" name="produits_vendus" required>
        <option value="">Sélectionnez un produit</option>
        <option value="Collier">Collier</option>
        <option value="Bracelet">Bracelet</option>
        <option value="Pendantif">Pendantif</option>
        <option value="Boucle d'oreille">Boucle d'oreille</option>
    </select>
    <br>
    <button class="boutonAjouter" type="submit">Ajouter le Fournisseur</button>
</form>
</body>
</html> 