<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
</head>
<body>
    <h1>Mon Panier</h1>

    <?php if (empty($_SESSION['panier'])): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalPanier = 0; // Initialiser le total du panier
                foreach ($_SESSION['panier'] as $produitId => $quantite): 
                    $produit = $produitController->getProduitById($produitId); 
                    $prixTotal = $produit['prix_public'] * $quantite; // Calculer le total pour ce produit
                    $totalPanier += $prixTotal; // Ajouter au total du panier
                ?>
                    <tr>
                        <td><?= htmlspecialchars($produit['titre']) ?></td>
                        <td><?= htmlspecialchars($quantite) ?></td>
                        <td><?= htmlspecialchars($produit['prix_public']) ?> €</td>
                        <td><?= htmlspecialchars($prixTotal) ?> €</td>
                        <td>
                            <form method="post" action="client.php?action=retirerDuPanier">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($produitId) ?>">
                                <button type="submit">Retirer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Total du Panier : <?= htmlspecialchars($totalPanier) ?> €</h2>

        <form method="post" action="client.php?action=validerPanier">
            <button type="submit">Valider la Commande</button>
        </form>
    <?php endif; ?>

    <a href="client.php">Continuer vos achats</a>
</body>
</html>