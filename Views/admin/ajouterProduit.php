<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un produit</title>
</head>
<body>
    <form action="admin.php?action=ajouterProduit" method="post">
        <label for="reference">Référence :</label>
        <input type="text" id="reference" name="reference" required>
        <br>
        <label for="taille">Taille :</label>
        <input type="text" id="taille" name="taille" required>
        <br>
        <label for="couleur">Couleur :</label>
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
        <input type="text" id="image" name="image">
        <br>
        <label for="provenance">Provenance :</label>
        <input type="text" id="provenance" name="provenance" required>
        <br>
        <button type="submit">Ajouter le produit</button>
    </form>
</body>
</html>