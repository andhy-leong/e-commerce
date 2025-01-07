<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
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
                <th>Icône</th>
                <th>Provenance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_achat'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['quantite_stock'] ?? '') ?></td>
                    <td><img src="<?= htmlspecialchars($produit['image'] ?? '') ?>" alt="Image" style="width:50px;height:50px;"></td>
                    <td><img src="<?= htmlspecialchars($produit['icone'] ?? '') ?>" alt="Icône" style="width:30px;height:30px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td>
                        <a href="admin.php?action=supprimerProduit&id=<?= htmlspecialchars($produit['identifiant'] ?? '') ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>