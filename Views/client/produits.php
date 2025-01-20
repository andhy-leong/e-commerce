<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Produits</title>
    <link rel="stylesheet" type="text/css"  href="../public/css/accueil.css"/>
</head>
<body>
    <header>
        <div><img src="../Ressources/vangovibeslogo.png" alt="logo"></div>
        <div>
        <form method="get" action="client.php">
            <input type="hidden" name="action" value="afficherProduits">
            <input type="text" name="search" placeholder="🔎Rechercher un produit">
            <button type="submit">Rechercher</button>
        </form>
        </div>
        <div>    
            <?php if (isset($_SESSION['client_id'])): ?>
            <?= htmlspecialchars($_SESSION['client_prenom'] ) . ' ' . htmlspecialchars($_SESSION['client_nom'] ) ?>
            <a href="client.php?action=espaceClient"><img src="../Ressources/connexionlogo.png" alt="Connexion"></a>
            <?php else: ?>
            <a href="client.php?action=loginForm"><img src="../Ressources/connexionlogo.png" width="50" height="50" alt="Connexion"></a>
            <?php endif; ?>
        </div>
        <div>
            <a href="client.php?action=afficherPanier"><img src="../Ressources/panierlogo.png" width="52" height="52" alt="Panier"></a>
        </div>
        
    </header>

    
    <?php if (isset($_SESSION['message'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_SESSION['message']) ?></p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="image-grid">
            <div>
                <img src="../Ressources/vangovango_accueil1.jpg" width="100%" height="250px" alt="Image d'accueil">
            </div>
            <div>
                <img src="../Ressources/vangovango_accueil2.jpg" width="100%" height="250px" alt="Image d'accueil">
            </div>
            <div>
            <img src="../Ressources/vangovango_accueil3.jpg" width="100%" height="250px" alt="Image d'accueil">
            </div>
            <div class="descriptif_accueil">
                <p>Le Vangovango est un bracelet traditionnel originaire de Madagascar, célèbre pour sa beauté et son artisanat.</p>
                <p>Chaque pièce est unique, travaillée avec soin à partir de matériaux nobles, offrant une qualité exceptionnelle et un design intemporel. Que vous cherchiez à ajouter une touche d'élégance à votre tenue quotidienne ou à offrir un cadeau chargé de signification, le Vangovango est le choix parfait. Sa fabrication respecte des standards stricts, garantissant non seulement un bijou de haute qualité, mais aussi un engagement envers l'environnement. </p>
            </div>
    </div>


    <form method="get" action="client.php">
        <input type="hidden" name="action" value="afficherProduits">
        <label for="sort">Trier par :</label>
        <select name="sort" id="sort">
            <option value="nom_asc">Nom (A-Z)</option>
            <option value="nom_desc">Nom (Z-A)</option>
            <option value="prix_asc">Prix (croissant)</option>
            <option value="prix_desc">Prix (décroissant)</option>
        </select>
        <button type="submit">Trier</button>
    </form>
    <table>
        <div>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <div class="produit">
                    <img src="<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['titre']) ?>" style="width:350px; height:350px;">
                    <h2><?= htmlspecialchars($produit['titre']) ?></h2>
                    <p>Référence: <?= htmlspecialchars($produit['reference']) ?></p>
                    <p><?= htmlspecialchars($produit['descriptif']) ?></p>
                    <p><?= htmlspecialchars($produit['provenance']) ?></p>
                    <p>Taille: <?= htmlspecialchars($produit['taille']) ?></p>
                    <p>Matériaux: <?= htmlspecialchars($produit['couleur']) ?></p>
                    <p>Prix: <?= htmlspecialchars($produit['prix_public']) ?> €</p>
                        <form method="post" action="client.php?action=ajouterAuPanier">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($produit['identifiant'] ?? '') ?>">
                            <input type="number" name="quantite" value="1" min="1" max="<?= htmlspecialchars($produit['quantite_stock'] ?? 1) ?>">
                            <button type="submit" <?= ($produit['quantite_stock'] <= 0) ? 'disabled' : '' ?>>Ajouter au panier</button>
                        </form>
                </div>
            <?php endforeach; ?>
        </tbody>
        </div>
    </table>
</body>
</html>