<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des produits - VangoVibes</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/produitsAdmins.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <div>
            <a href="admin.php?action=afficherDashboard">
                <img src="Ressources/vangovibeslogo.png" alt="logo VangoVibes">
            </a>
        </div>
    </header>

    <div class="admin-page-container">
        <h1>Gestion des Produits</h1>

        <div class="actions-bar">
            <a class="produits btn-primary" href="admin.php?action=ajouterProduitForm">+ Ajouter un produit</a>
            <a class="produits btn-secondary" href="admin.php?action=afficherDashboard">&larr; Tableau de bord</a>
        </div>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="message success"><?= htmlspecialchars($_SESSION['success_message']) ?></div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="message error"><?= htmlspecialchars($_SESSION['error_message']) ?></div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th class="col-ref">Réf</th>
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
                            $imagePath = str_replace('../Ressources/', 'Ressources/', $produit['image']);
                        ?>
                        <tr class="<?= $stockFaible ? 'stock-faible' : '' ?>">
                            <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                            <td><strong><?= htmlspecialchars($produit['titre'] ?? '') ?></strong></td>
                            <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
                            <td><?= htmlspecialchars($produit['prix_achat'] ?? '') ?> €</td>
                            <td>
                                <?= htmlspecialchars($produit['quantite_stock'] ?? '') ?>
                                <?php if ($stockFaible): ?>
                                    <br><strong class="badge-stock">Faible !</strong>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($imagePath)): ?>
                                    <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($produit['titre']) ?>" class="img-miniature">
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
        </div>
    </div>
</body>
</html>