<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier - VangoVibes</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
        }
        body {
            background-color: #fbf9f8;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin: 0;
            padding-bottom: 50px;
            color: #2c2c2c;
        }
        .panier-container {
            width: 92%;
            max-width: 1000px;
            margin: 25px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #eee;
        }
        h1 {
            color: #963B38;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: clamp(1.6rem, 4vw, 2.2rem);
        }
        .message {
            padding: 12px 18px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-weight: 500;
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-top: 15px;
            margin-bottom: 25px;
            border-radius: 8px;
            border: 1px solid #eee;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 550px;
        }
        th, td {
            padding: 12px 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background-color: #f7f5f4;
            color: #555;
            font-weight: 600;
        }
        tr:hover {
            background-color: #fafafa;
        }
        .form-retirer {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }
        .form-retirer input[type="number"] {
            width: 55px;
            height: 36px;
            padding: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: center;
        }
        .form-retirer button {
            height: 36px;
            padding: 0 12px;
            background-color: #c93b3b;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 13px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .form-retirer button:hover {
            background-color: #a82828;
        }
        .panier-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            padding: 20px 0;
            border-top: 2px solid #f0f0f0;
            margin-top: 10px;
        }
        .total-texte {
            font-size: 1.4rem;
            font-weight: 700;
            color: #963B38;
            margin: 0;
        }
        .panier-actions {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }
        .btn-continuer {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            border: 2px solid #963B38;
            color: #963B38;
            background-color: transparent;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.2s;
            min-height: 46px;
        }
        .btn-continuer:hover {
            background-color: #963B38;
            color: #ffffff;
        }
        .btn-valider {
            padding: 12px 28px;
            background-color: #963B38;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
            min-height: 46px;
        }
        .btn-valider:hover {
            background-color: #7a2a2a;
            transform: translateY(-2px);
        }
        .panier-vide {
            text-align: center;
            padding: 40px 10px;
            color: #666;
        }
        @media (max-width: 600px) {
            .panier-container {
                padding: 16px;
                width: 95%;
            }
            .panier-total {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }
            .panier-actions {
                flex-direction: column;
                width: 100%;
            }
            .btn-continuer, .btn-valider {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div>
            <a href="client.php?action=afficherProduits">
                <img src="Ressources/vangovibeslogo.png" alt="logo VangoVibes">
            </a>
        </div>
    </header>

    <div class="panier-container">
        <h1>Mon Panier</h1>

        <?php if (isset($_SESSION['confirmation_message'])): ?>
            <div class="message"><?= htmlspecialchars($_SESSION['confirmation_message']) ?></div>
            <?php unset($_SESSION['confirmation_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="message"><?= htmlspecialchars($_SESSION['message']) ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (empty($_SESSION['panier'])): ?>
            <div class="panier-vide">
                <p>Votre panier est actuellement vide.</p>
                <a href="client.php?action=afficherProduits" class="btn-continuer">&larr; Découvrir nos bracelets</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix Unitaire</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totalPanier = 0;
                        foreach ($_SESSION['panier'] as $produitId => $quantite): 
                            $produit = $produitController->getProduitById($produitId); 
                            $prixTotal = $produit['prix_public'] * $quantite;
                            $totalPanier += $prixTotal;
                        ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($produit['titre']) ?></strong></td>
                                <td><?= htmlspecialchars($quantite) ?></td>
                                <td><?= htmlspecialchars($produit['prix_public']) ?> €</td>
                                <td><strong><?= htmlspecialchars($prixTotal) ?> €</strong></td>
                                <td>
                                    <form method="post" action="client.php?action=retirerDuPanier" class="form-retirer">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($produitId) ?>">
                                        <input type="number" name="quantite" value="1" min="1" max="<?= htmlspecialchars($quantite) ?>">
                                        <button type="submit">Retirer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="panier-total">
                <p class="total-texte">Total : <?= htmlspecialchars($totalPanier) ?> €</p>
                <div class="panier-actions">
                    <a href="client.php?action=afficherProduits" class="btn-continuer">&larr; Continuer mes achats</a>
                    <form method="post" action="client.php?action=validerPanier" style="margin: 0;">
                        <button type="submit" class="btn-valider">Valider la Commande</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>