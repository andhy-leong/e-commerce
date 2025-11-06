<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>VangoVibes</title>
    <link rel="stylesheet" type="text/css" href="css/acceuil.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <nav class="navigation">
        <div class="logo">
            <a href="client.php?action=afficherProduits">
                <img src="Ressources/vangovibeslogo.png" alt="logo">
            </a>
        </div>

        <div class="rechercher">
            <!--
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#151515">
                    <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/>
                </svg>
            </span>
            !-->
            <form method="get" action="client.php" style="display: flex; justify-content: center; align-items: center; margin: 20px 0;">
                <input type="hidden" name="action" value="afficherProduits">
                <input type="search" placeholder="Rechercher un produit" style="flex: 1; margin-right: 10px; padding: 8px;">
                <button type="submit" style="padding: 8px 15px;">Rechercher</button>
            </form>
        </div>
        <div class="utilisateur">    
            <?php if (isset($_SESSION['client_id'])): ?>
            <?= htmlspecialchars($_SESSION['client_prenom'] ) . ' ' . htmlspecialchars($_SESSION['client_nom'] ) ?>
            <a href="client.php?action=espaceClient" class="connexion"><img src="../Ressources/connexionlogo.png" alt="Connexion"></a>
            <?php else: ?>
            <a href="client.php?action=loginForm"><img src="../Ressources/connexionlogo.png" alt="Connexion"></a>
            <?php endif; ?>
            <a href="client.php?action=afficherPanier" class="panier"><img src="../Ressources/panierlogo.png" alt="Panier"><p>Panier</p></a>
        </div>
    </nav>

    <?php if (isset($_SESSION['confirmation_message'])): ?>
        <div class="message success"><?= htmlspecialchars($_SESSION['confirmation_message']) ?></div>
        <?php unset($_SESSION['confirmation_message']); // Supprimer le message après l'affichage ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="message"><?= htmlspecialchars($_SESSION['message']) ?></div>
        <?php unset($_SESSION['message']); // Supprimer le message après l'affichage ?>
    <?php endif; ?>

    <header>
        <div class="carousel">
            <ul class="carousel-track">
                <li class="carousel-slide current-slide">
                    <img src="../Ressources/vangovango_accueil1.jpg" alt="Image 1">
                </li>
                <li class="carousel-slide">
                    <img src="../Ressources/vangovango_accueil2.jpg" alt="Image 2">
                </li>
                <li class="carousel-slide">
                    <img src="../Ressources/vangovango_accueil3.jpg" alt="Image 3">
                </li>
            </ul>
            <div class="carousel-indicators">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
        <div class="titre">
            <h1>VangoVibes</h1>
            <p>Découvrez l'élégance intemporelle du Vangovango, un bracelet traditionnel de Madagascar qui allie artisanat authentique et respect de l'environnement.</p>
            <div class="call-to-action">
                <a href="mailto:andhylng29@gmail.com" class="contacter">Contacter</a>
                <a href="client.php?action=registerForm" class="inscription">S'inscrire</a>
            </div>
        </div>
    </header>

    <main>
    <div class="informations">
            <div class="card">
                <h2>Le Bracelet Vangovango</h2>
                <p>Originaire de Madagascar, ce bracelet traditionnel est célèbre pour sa beauté et son artisanat. Chaque pièce unique est fabriquée avec soin à partir de matériaux nobles, offrant une qualité exceptionnelle et un design intemporel.</p>
            </div>
            
            <div class="card">
                <h2>Un Cadeau Élégant et Significatif</h2>
                <p>Ajoutez une touche d'élégance à votre tenue ou offrez un cadeau chargé de signification. Fabriqué dans le respect de l'environnement et selon des standards stricts, le Vangovango allie qualité et engagement.</p>
            </div>

            <div class="info-image">
                <img src="../Ressources/vangovango_info.png" alt="">
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

        <div class="produit-grid">
            <?php foreach ($produits as $produit): ?>
                <div class="produit">
                    <!--A utiliser quand je veux faire une page pour afficher en details les produits -->
                    <!--<a href="client.php?action=afficherProduit&id=<?= htmlspecialchars($produit['identifiant']) ?>"> -->
                    <img src="<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['titre']) ?>" style="width:350px; height:350px;"><!--</a>-->
                    <h2><?= htmlspecialchars($produit['titre']) ?></h2>
                    <p>Référence: <?= htmlspecialchars($produit['reference']) ?></p>
                    <p><?= htmlspecialchars($produit['descriptif']) ?></p>
                    <p>Provenance: <?= htmlspecialchars($produit['provenance']) ?></p>
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
        </div>
        <div class="apropos">
            <h2>Pourquoi choisir nos bracelets ?</h2>
            <p>
                Nos bracelets sont fabriqués avec des matériaux de haute qualité, 
                sélectionnés pour leur durabilité et leur élégance. Chaque modèle est 
                conçu pour s'adapter parfaitement à votre style, qu'il soit classique, 
                moderne ou unique. Nous mettons un point d'honneur à garantir un confort
                optimal tout en proposant des designs qui attirent l'attention et 
                reflètent votre personnalité. Que vous cherchiez un accessoire pour 
                une occasion spéciale ou un cadeau inoubliable, nos bracelets sont 
                faits pour sublimer chaque moment de votre vie.
            </p>
        </div>
    </main>
    <footer>
            <div class="footer-element">
                <div>
                    <img src="../Ressources/vangovibeslogo.png" alt="">
                </div>
    
                <div>
                    <h3>Téléphone</h3>
                    <p>+33 4 89 15 30 00</p>
    
                    <h3>Email</h3>
                    <a href="mailto:andhylng29@gmail.com" class="contacter">vangovibes@gmail.com</a>
                </div>
    
                <div class="reseaux">
                    <h3>Réseaux sociaux</h3>
    
                    <div>
                        <a href="https://www.linkedin.com/in/leong-foc-sing-andhy-raharison-2404322b7/">
                            <img src="../Ressources/linkedin-icon.png" alt="">
                        </a>
    
                        <a href="https://www.instagram.com/andhy_leong/">
                            <img src="../Ressources/instagram-icon.png" alt="">
                        </a>
                    </div>
    
                    <div>
                        <a href="https://github.com/andhy-leong">
                            <img src="../Ressources/git-icon.png" alt="">
                        </a>
    
                        <a href="https://univ-cotedazur.fr/annuaire/leong-foc-sing-andhy-raharison">
                            <img src="../Ressources/iut-icon.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
    
            <div class="copyrigth">
                <p>Copyright 2025 Vangovibes</p>
            </div>
        </footer>

    <script src="../public/js/accueil.js"></script>
</body>
</html>
