<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/produitsAdmins.css"/>
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
<h1>Liste des Produits</h1>
    <a class="produits" href="admin.php?action=ajouterProduitForm">Ajouter un produit</a>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="message success"><?= htmlspecialchars($_SESSION['success_message']) ?></div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="message error"><?= htmlspecialchars($_SESSION['error_message']) ?></div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th class="col-ref">Référence</th>
                <th class="col-titre">Titre</th>
                <th class="col-prix">Prix Public</th>
                <th class="col-prix">Prix Achat</th>
                <th class="col-stock">Stock</th>
                <th class="col-img">Image</th>
                <th class="col-desc">Descriptif</th>
                <th class="col-actions">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <?php 
                    $stockFaible = $produit['quantite_stock'] <= 10;
                ?>
                <tr class="<?= $stockFaible ? 'stock-faible' : '' ?>">
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
                    <td><?= htmlspecialchars($produit['prix_achat'] ?? '') ?> €</td>
                    <td>
                        <?= htmlspecialchars($produit['quantite_stock'] ?? '') ?>
                        <?php if ($stockFaible): ?>
                            <br><strong>(Stock faible !)</strong>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($produit['image'])): ?>
                            <img src="<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['titre']) ?>" class="img-miniature">
                        <?php endif; ?>
                    </td>
                    <td class="col-desc-contenu"><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td class="actions-cell">
                        <a class="bouton-modifier" href="admin.php?action=modifierProduitForm&id=<?= htmlspecialchars($produit['identifiant']) ?>">Modifier</a>
                        <a class="bouton-supprimer" href="admin.php?action=supprimerProduit&id=<?= htmlspecialchars($produit['identifiant'] ?? '') ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>