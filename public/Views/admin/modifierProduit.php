<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le Produit</title>
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
<h1>Modifier le Produit</h1>

<?php if (empty($produit)): ?>
    <p>Produit non trouvé.</p>
<?php else: ?>
<form action="admin.php?action=modifierProduit" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($produit['identifiant']) ?>">
    
    <input type="hidden" name="current_image" value="<?= htmlspecialchars($produit['image']) ?>">

    <label for="reference">Référence :</label>
    <input type="text" id="reference" name="reference" value="<?= htmlspecialchars($produit['reference']) ?>" required>
    <br>
    <label for="taille">Taille :</label>
    <input type="text" id="taille" name="taille" value="<?= htmlspecialchars($produit['taille']) ?>" required>
    <br>
    <label for="couleur">Matériaux :</label>
    <input type="text" id="couleur" name="couleur" value="<?= htmlspecialchars($produit['couleur']) ?>" required>
    <br>
    <label for="prix_public">Prix Public :</label>
    <input type="number" id="prix_public" name="prix_public" value="<?= htmlspecialchars($produit['prix_public']) ?>" step="0.01" required>
    <br>
    <label for="prix_achat">Prix Achat :</label>
    <input type="number" id="prix_achat" name="prix_achat" value="<?= htmlspecialchars($produit['prix_achat']) ?>" step="0.01" required>
    <br>
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($produit['titre']) ?>" required>
    <br>
    <label for="descriptif">Descriptif :</label>
    <textarea id="descriptif" name="descriptif" required><?= htmlspecialchars($produit['descriptif']) ?></textarea>
    <br>
    <label for="quantite_stock">Quantité en Stock :</label>
    <input type="number" id="quantite_stock" name="quantite_stock" value="<?= htmlspecialchars($produit['quantite_stock']) ?>" required>
    <br>
    
    <label>Image actuelle :</label>
    <?php 
        // Corrige l'ancien mauvais chemin s'il est présent
        $imagePath = str_replace('../Ressources/', 'Ressources/', $produit['image']); 
    ?>
    <img src="<?= htmlspecialchars($imagePath) ?>" alt="Image actuelle" style="max-width: 100px; max-height: 100px; margin-bottom: 10px; display: block; border-radius: 4px;">
    
    <label for="image">Changer l'image (optionnel) :</label>
    <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/gif">
    <br>
    <br>

    <label for="provenance">Provenance :</label>
    <input type="text" id="provenance" name="provenance" value="<?= htmlspecialchars($produit['provenance']) ?>" required>
    <br>
    <button type="submit">Mettre à jour le produit</button>
</form>
<?php endif; ?>
</body>
</html>