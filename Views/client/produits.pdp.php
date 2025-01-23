<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du Produit</title>
    <link rel="stylesheet" type="text/css" href="../public/css/acceuil.css"/>
</head>
<body>
    <nav class="navigation">
        <!-- Navigation code here -->
    </nav>

    <main>
        <?php if (isset($produit)): ?>
            <div class="produit-details">
                <h1><?= htmlspecialchars($produit['titre']) ?></h1>
                <img src="<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['titre']) ?>" style="width:350px; height:350px;">
                <p>Référence: <?= htmlspecialchars($produit['reference']) ?></p>
                <p><?= htmlspecialchars($produit['descriptif']) ?></p>
                <p>Prix: <?= htmlspecialchars($produit['prix_public']) ?> €</p>
                <p>Taille: <?= htmlspecialchars($produit['taille']) ?></p>
                <p>Couleur: <?= htmlspecialchars($produit['couleur']) ?></p>
                <p>Provenance: <?= htmlspecialchars($produit['provenance']) ?></p>
                <form method="post" action="client.php?action=ajouterAuPanier">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($produit['identifiant']) ?>">
                    <input type="number" name="quantite" value="1" min="1" max="<?= htmlspecialchars($produit['quantite_stock'] ?? 1) ?>">
                    <button type="submit">Ajouter au panier</button>
                </form>
            </div>
        <?php else: ?>
            <p>Produit non trouvé.</p>
        <?php endif; ?>
    </main>
</body>
</html> 