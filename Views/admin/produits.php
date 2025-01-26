<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
    <link rel="stylesheet" type="text/css" href="../public/css/header.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/produitsAdmins.css"/>
</head>
<body>
<header>
    <div>
        <a href="admin.php?action=afficherDashboard">
            <img src="../Ressources/vangovibeslogo.png" alt="logo">
        </a>
    </div>
</header>
<h1>Liste des Produits</h1>
    <a class="produits" href="admin.php?action=ajouterProduitForm">Ajouter un produit</a>

    <table>
        <thead>
            <tr>
                <th style="width: 10%;">Référence</th>
                <th style="width: 10%;">Taille</th>
                <th style="width: 10%;">Matériaux</th>
                <th style="width: 10%;">Prix Public</th>
                <th style="width: 10%;">Prix Achat</th>
                <th style="width: 20%;">Titre</th>
                <th style="width: 20%;">Descriptif</th>
                <th style="width: 10%;">Quantité en Stock</th>
                <th style="width: 10%;">Image</th>
                <th style="width: 10%;">Provenance</th>
                <th style="width: 10%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <form action="admin.php?action=modifierProduit" method="post">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($produit['identifiant']) ?>">
                        <td><input type="text" name="reference" value="<?= htmlspecialchars($produit['reference'] ?? '') ?>" required></td>
                        <td><input type="text" name="taille" value="<?= htmlspecialchars($produit['taille'] ?? '') ?>" required></td>
                        <td><input type="text" name="couleur" value="<?= htmlspecialchars($produit['couleur'] ?? '') ?>" required></td>
                        <td><input type="number" name="prix_public" value="<?= htmlspecialchars($produit['prix_public'] ?? '') ?>" step="0.01" required></td>
                        <td><input type="number" name="prix_achat" value="<?= htmlspecialchars($produit['prix_achat'] ?? '') ?>" step="0.01" required></td>
                        <td><input type="text" name="titre" value="<?= htmlspecialchars($produit['titre'] ?? '') ?>" required></td>
                        <td><textarea name="descriptif" required><?= htmlspecialchars($produit['descriptif'] ?? '') ?></textarea></td>
                        <td><input type="number" name="quantite_stock" value="<?= htmlspecialchars($produit['quantite_stock'] ?? '') ?>" required></td>
                        <td><input type="text" name="image" value="<?= htmlspecialchars($produit['image'] ?? '') ?>"></td>
                        <td><input type="text" name="provenance" value="<?= htmlspecialchars($produit['provenance'] ?? '') ?>" required></td>
                        <td>
                            <button type="submit">Modifier</button>
                            <a class="produits" href="admin.php?action=supprimerProduit&id=<?= htmlspecialchars($produit['identifiant'] ?? '') ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</a>
                        </td>
                    </form>
                </tr>
                <?php if ($produit['quantite_stock'] <= 10): ?>
                    <tr>
                        <td colspan="11" style="color: red; text-align: center;">
                            Attention : Le stock de <?= htmlspecialchars($produit['titre']) ?> est faible (<?= htmlspecialchars($produit['quantite_stock']) ?> en stock) Pensez à réapprovisionner votre stock.
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>