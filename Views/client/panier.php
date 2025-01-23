<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <link rel="stylesheet" type="text/css"  href="../public/css/header.css"/>
    <style>
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            color: #155724;
            background-color: #d4edda; /* Couleur de fond verte */
        }
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
    </style>
</head>
<body>
    <header>
        <div>
            <a href="client.php?action=afficherProduits">
                <img src="../Ressources/vangovibeslogo.png" alt="logo">
            </a>
        </div>
    </header>
    <h1>Mon Panier</h1>

    <?php if (isset($_SESSION['confirmation_message'])): ?>
        <div class="message"><?= htmlspecialchars($_SESSION['confirmation_message']) ?></div>
        <?php unset($_SESSION['confirmation_message']); // Supprimer le message après l'affichage ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="message"><?= htmlspecialchars($_SESSION['message']) ?></div>
        <?php unset($_SESSION['message']); // Supprimer le message après l'affichage ?>
    <?php endif; ?>

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
                                <input type="number" name="quantite" value="1" min="1" max="<?= htmlspecialchars($quantite) ?>">
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