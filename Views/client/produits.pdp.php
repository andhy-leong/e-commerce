<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= isset($produit) ? htmlspecialchars($produit['titre']) : 'Détails du Produit' ?> - VangoVibes</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #fbf9f8;
            margin: 0;
            color: #2c2c2c;
            padding-bottom: 50px;
        }
        .container {
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        }
        .produit-details-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .produit-image-box {
            width: 100%;
            max-width: 380px;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            border-radius: 10px;
            background: #f7f7f7;
            margin-bottom: 20px;
        }
        .produit-image-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        h1 {
            color: #963B38;
            font-size: clamp(1.6rem, 4vw, 2.2rem);
            margin: 0 0 10px 0;
        }
        .prix {
            font-size: 1.8rem;
            font-weight: 700;
            color: #963B38;
            margin: 15px 0;
        }
        .description {
            color: #555;
            line-height: 1.7;
            margin-bottom: 20px;
        }
        .caracteristiques {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
            color: #444;
            background: #fdfaf7;
            padding: 15px;
            border-radius: 8px;
            width: 100%;
        }
        .panier-action {
            display: flex;
            gap: 10px;
            width: 100%;
            max-width: 320px;
            margin-bottom: 20px;
        }
        .panier-action input[type="number"] {
            width: 70px;
            height: 46px;
            padding: 0 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            text-align: center;
            font-size: 16px;
        }
        .panier-action button {
            flex: 1;
            height: 46px;
            background-color: #963B38;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .panier-action button:hover {
            background-color: #7a2a2a;
        }
        .btn-retour {
            color: #963B38;
            text-decoration: underline;
            font-weight: 500;
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

    <main class="container">
        <?php if (isset($produit)): 
            $imagePath = str_replace('../Ressources/', 'Ressources/', $produit['image']);
        ?>
            <div class="produit-details-card">
                <h1><?= htmlspecialchars($produit['titre']) ?></h1>
                <div class="produit-image-box">
                    <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($produit['titre']) ?>">
                </div>
                <p class="description"><?= htmlspecialchars($produit['descriptif']) ?></p>
                
                <div class="caracteristiques">
                    <span><strong>Réf :</strong> <?= htmlspecialchars($produit['reference']) ?></span>
                    <span><strong>Provenance :</strong> <?= htmlspecialchars($produit['provenance']) ?></span>
                    <span><strong>Taille :</strong> <?= htmlspecialchars($produit['taille']) ?></span>
                    <span><strong>Matière :</strong> <?= htmlspecialchars($produit['couleur']) ?></span>
                </div>
                
                <p class="prix"><?= htmlspecialchars($produit['prix_public']) ?> €</p>
                
                <form method="post" action="client.php?action=ajouterAuPanier" class="panier-action">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($produit['identifiant']) ?>">
                    <input type="number" name="quantite" value="1" min="1" max="<?= htmlspecialchars($produit['quantite_stock'] ?? 1) ?>" <?= ($produit['quantite_stock'] <= 0) ? 'disabled' : '' ?>>
                    <button type="submit" <?= ($produit['quantite_stock'] <= 0) ? 'disabled' : '' ?>>
                        <?= ($produit['quantite_stock'] <= 0) ? 'Rupture de stock' : 'Ajouter au panier' ?>
                    </button>
                </form>

                <a href="client.php?action=afficherProduits" class="btn-retour">&larr; Retour aux produits</a>
            </div>
        <?php else: ?>
            <div style="text-align: center;">
                <p>Produit non trouvé.</p>
                <a href="client.php?action=afficherProduits" class="btn-retour">&larr; Retour à la boutique</a>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>