<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a, button {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }
        a:hover, button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <a href="admin.php?action=ajouterProduitForm">Ajouter un produit</a>

    <table>
        <thead>
            <tr>
                <th>Référence</th>
                <th>Taille</th>
                <th>Couleur</th>
                <th>Prix Public</th>
                <th>Prix Achat</th>
                <th>Titre</th>
                <th>Descriptif</th>
                <th>Quantité en Stock</th>
                <th>Image</th>
                <th>Provenance</th>
                <th>Actions</th>
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
                            <a href="admin.php?action=supprimerProduit&id=<?= htmlspecialchars($produit['identifiant'] ?? '') ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</a>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>