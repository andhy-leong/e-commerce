<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Produits</title>
</head>
<body>
    <h1>Liste des Produits</h1>

    <!-- Affichage du message de succès -->
    <?php if (isset($_SESSION['message'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_SESSION['message']) ?></p>
        <?php unset($_SESSION['message']); // Supprimez le message après l'affichage ?>
    <?php endif; ?>

    <!-- Barre de recherche -->
    <form method="get" action="client.php">
        <input type="hidden" name="action" value="afficherProduits">
        <input type="text" name="search" placeholder="Rechercher un produit">
        <button type="submit">Rechercher</button>
    </form>

    <!-- Combobox pour trier les produits -->
    <form method="get" action="client.php">
        <input type="hidden" name="action" value="afficherProduits">
        <label for="sort">Trier par :</label>
        <select name="sort" id="sort">
            <option value="nom_asc">Nom (A-Z)</option>
            <option value="nom_desc">Nom (Z-A)</option>
            <option value="prix_asc">Prix (croissant)</option>
            <option value="prix_desc">Prix (décroissant)</option>
            <option value="mieux_notes">Mieux notés</option>
        </select>
        <button type="submit">Trier</button>
    </form>

    <!-- Affichage du nom du client ou lien de connexion/inscription -->
    <?php if (isset($_SESSION['client_id'])): ?>
        <p>Bienvenue, <?= htmlspecialchars($_SESSION['client_prenom'] . ' ' . $_SESSION['client_nom']) ?></p>
        <a href="client.php?action=espaceClient">Accéder à mon espace client</a>
    <?php else: ?>
        <a href="client.php?action=loginForm">Se connecter / S'inscrire</a>
    <?php endif; ?>

    <!-- Lien vers le panier -->
    <a href="client.php?action=afficherPanier">Voir le panier</a>

    <!-- Liste des produits -->
    <table>
        <thead>
            <tr>
                <th>Référence</th>
                <th>Titre</th>
                <th>Descriptif</th>
                <th>Image</th>
                <th>Provenance</th>
                <th>Taille</th>
                <th>Couleur</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><img src="<?= htmlspecialchars($produit['image'] ?? '') ?>" alt="Image du produit" style="width:50px;height:50px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
                    <td>
                        <?php if ($produit['quantite_stock'] <= 5): ?>
                            <?= htmlspecialchars($produit['quantite_stock']) ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <form method="post" action="client.php?action=ajouterAuPanier">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($produit['identifiant'] ?? '') ?>">
                            <input type="number" name="quantite" value="1" min="1" max="<?= htmlspecialchars($produit['quantite_stock'] ?? 1) ?>">
                            <button type="submit" <?= ($produit['quantite_stock'] <= 0) ? 'disabled' : '' ?>>Ajouter au panier</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>