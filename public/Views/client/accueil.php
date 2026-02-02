<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - VangoVibes</title>
    <link rel="stylesheet" type="text/css" href="css/acceuil.css"/> 
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <div class="navigation">
        <div class="logo">
             <img src="../Ressources/vangovibeslogo.png" alt="logo">
        </div>
        <div class="rechercher">
            <span>🔍</span>
            <input type="text" placeholder="Rechercher un produit...">
            <button>Rechercher</button>
        </div>
        <div class="utilisateur">
            <?php if(isset($_SESSION['client_id'])): ?>
                <a href="client.php?action=espaceClient">Mon Compte</a>
                <a href="client.php?action=logout">Déconnexion</a>
            <?php else: ?>
                <a href="client.php?action=loginForm" class="connexion">Login</a>
            <?php endif; ?>
            <a href="#" class="panier">Panier</a>
        </div>
    </div>

    <header>
        <div class="carousel">
            <ul class="carousel-track">
                <li class="carousel-slide"><img src="../Ressources/vangovango_accueil1.jpg" alt="Slide 1"></li>
                <li class="carousel-slide"><img src="../Ressources/vangovango_accueil2.jpg" alt="Slide 2"></li>
                <li class="carousel-slide"><img src="../Ressources/vangovango_accueil3.jpg" alt="Slide 3"></li>
            </ul>
            <div class="carousel-indicators">
                <button class="dot current-slide"></button>
                <button class="dot"></button>
                <button class="dot"></button>
            </div>
        </div>
        
        <div class="titre">
            <h1>Bienvenue sur VangoVibes</h1>
            <p>Découvrez nos collections uniques.</p>
        </div>
    </header>

    <main>
        <div class="affichage-produits">
            <h2>Nos Produits</h2>

            <form method="GET" action="client.php" style="margin-bottom: 20px;">
                <input type="hidden" name="action" value="accueil">
                <label for="tri">Trier par : </label>
                <select name="tri" id="tri" onchange="this.form.submit()">
                    <option value="defaut" <?php if(!isset($_GET['tri']) || $_GET['tri'] == 'defaut') echo 'selected'; ?>>Nouveautés</option>
                    <option value="prix_croissant" <?php if(isset($_GET['tri']) && $_GET['tri'] == 'prix_croissant') echo 'selected'; ?>>Prix croissant</option>
                    <option value="prix_decroissant" <?php if(isset($_GET['tri']) && $_GET['tri'] == 'prix_decroissant') echo 'selected'; ?>>Prix décroissant</option>
                    <option value="nom" <?php if(isset($_GET['tri']) && $_GET['tri'] == 'nom') echo 'selected'; ?>>Nom (A-Z)</option>
                </select>
            </form>

            <div class="produit-grid">
                <?php if(isset($produits) && !empty($produits)): ?>
                    <?php foreach($produits as $produit): ?>
                        <a href="client.php?action=afficherProduit&id=<?= $produit['id_produit'] ?>" class="produit-card">
                            <div class="produit">
                                <img src="../Ressources/Vangovango/<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom']) ?>">
                                <h4><?= htmlspecialchars($produit['nom']) ?></h4>
                                <p><?= htmlspecialchars($produit['prix']) ?> €</p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun produit trouvé.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script src="js/accueil.js"></script>
</body>
</html>