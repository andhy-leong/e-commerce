<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un produit</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/ajouterProduitAdmin.css"/>
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
<h1>Ajouter un Produit</h1>
<form action="admin.php?action=ajouterProduit" method="post">
    <label for="reference">Référence :</label>
    <input type="text" id="reference" name="reference" required>
    <br>
    <label for="taille">Taille :</label>
    <input type="text" id="taille" name="taille" required>
    <br>
    <label for="couleur">Matériaux :</label>
    <input type="text" id="couleur" name="couleur" required>
    <br>
    <label for="prix_public">Prix Public :</label>
    <input type="number" id="prix_public" name="prix_public" step="0.01" required>
    <br>
    <label for="prix_achat">Prix Achat :</label>
    <input type="number" id="prix_achat" name="prix_achat" step="0.01" required>
    <br>
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" required>
    <br>
    <label for="descriptif">Descriptif :</label>
    <textarea id="descriptif" name="descriptif" required></textarea>
    <br>
    <label for="quantite_stock">Quantité en Stock :</label>
    <input type="number" id="quantite_stock" name="quantite_stock" required>
    <br>
    <label for="image">Image (URL) :</label>
    <p><i>Laissez vide pour l'instant. L'ajout d'image se fait via le bouton "Modifier" après la création.</i></p>
    <input type="text" id="image" name="image" placeholder="Ressources/Vangovango/image.png">
    <br>
    <label for="provenance">Provenance :</label>
    <input type="text" id="provenance" name="provenance" required>
    <br>
    <button type="submit">Ajouter le produit</button>
</form>
</body>
</html>