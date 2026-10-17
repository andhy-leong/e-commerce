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
                <img src="Ressources/vangovibeslogo.png" alt="logo VangoVibes">
            </a>
        </div>

        <div class="rechercher">
            <form method="get" action="client.php">
                <input type="hidden" name="action" value="afficherProduits">
                <input type="search" name="search" placeholder="Rechercher un produit..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                <button type="submit">Rechercher</button>
            </form>
        </div>

        <div class="utilisateur">    
            <?php if (isset($_SESSION['client_id'])): ?>
                <span class="user-greeting"><?= htmlspecialchars($_SESSION['client_prenom'] ) . ' ' . htmlspecialchars($_SESSION['client_nom'] ) ?></span>
                <a href="client.php?action=espaceClient" class="connexion" title="Espace client">
                    <img src="Ressources/connexionlogo.png" alt="Connexion">
                </a>
            <?php else: ?>
                <a href="client.php?action=loginForm" class="connexion" title="Se connecter">
                    <img src="Ressources/connexionlogo.png" alt="Connexion">
                </a>
            <?php endif; ?>
            <a href="client.php?action=afficherPanier" class="panier" title="Panier">
                <img src="Ressources/panierlogo.png" alt="Panier">
                <p>Panier</p>
                <?php if (!empty($_SESSION['panier_count'])): ?>
                    <span class="panier-count"><?= (int)$_SESSION['panier_count'] ?></span>
                <?php endif; ?>
            </a>
        </div>
    </nav>

    <?php if (isset($_SESSION['confirmation_message'])): ?>
        <div class="message success"><?= htmlspecialchars($_SESSION['confirmation_message']) ?></div>
        <?php unset($_SESSION['confirmation_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="message"><?= htmlspecialchars($_SESSION['message']) ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <header>
        <div class="carousel">
            <ul class="carousel-track">
                <li class="carousel-slide current-slide">
                    <img src="Ressources/vangovango_accueil1.jpg" alt="Vangovango artisanal">
                </li>
                <li class="carousel-slide">
                    <img src="Ressources/vangovango_accueil2.jpg" alt="Collection de bracelets">
                </li>
                <li class="carousel-slide">
                    <img src="Ressources/vangovango_accueil3.jpg" alt="Artisanat malgache">
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
                <img src="Ressources/vangovango_info.png" alt="Illustration Vangovango">
            </div>
        </div>

        <div class="section-titre">
            <h2>Nos Créations</h2>
        </div>

        <form method="get" action="client.php" class="form-tri">
            <input type="hidden" name="action" value="afficherProduits">
            <?php if (!empty($_GET['search'])): ?>
                <input type="hidden" name="search" value="<?= htmlspecialchars($_GET['search']) ?>">
            <?php endif; ?>
            <label for="sort">Trier par :</label>
            <select name="sort" id="sort">
                <option value="nom_asc" <?= (isset($_GET['sort']) && $_GET['sort'] === 'nom_asc') ? 'selected' : '' ?>>Nom (A-Z)</option>
                <option value="nom_desc" <?= (isset($_GET['sort']) && $_GET['sort'] === 'nom_desc') ? 'selected' : '' ?>>Nom (Z-A)</option>
                <option value="prix_asc" <?= (isset($_GET['sort']) && $_GET['sort'] === 'prix_asc') ? 'selected' : '' ?>>Prix (croissant)</option>
                <option value="prix_desc" <?= (isset($_GET['sort']) && $_GET['sort'] === 'prix_desc') ? 'selected' : '' ?>>Prix (décroissant)</option>
            </select>
            <button type="submit">Trier</button>
        </form>

        <div class="produit-grid">
            <?php foreach ($produits as $produit): 
                $imagePath = str_replace('../Ressources/', 'Ressources/', $produit['image']);
            ?>
                <div class="produit">
                    <div class="produit-image-container">
                        <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($produit['titre']) ?>" class="produit-img" loading="lazy">
                    </div>
                    <h2><?= htmlspecialchars($produit['titre']) ?></h2>
                    <p class="reference">Réf : <?= htmlspecialchars($produit['reference']) ?></p>
                    <p class="description"><?= htmlspecialchars($produit['descriptif']) ?></p>
                    <div class="caracteristiques">
                        <span><strong>Provenance:</strong> <?= htmlspecialchars($produit['provenance']) ?></span>
                        <span><strong>Taille:</strong> <?= htmlspecialchars($produit['taille']) ?></span>
                        <span><strong>Matière:</strong> <?= htmlspecialchars($produit['couleur']) ?></span>
                    </div>
                    <p class="prix"><?= htmlspecialchars($produit['prix_public']) ?> €</p>
                    <form method="post" action="client.php?action=ajouterAuPanier" class="form-panier">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($produit['identifiant'] ?? '') ?>">
                        <div class="panier-action">
                            <label for="quantite-<?= htmlspecialchars($produit['identifiant']) ?>" class="sr-only">Quantité</label>
                            <input id="quantite-<?= htmlspecialchars($produit['identifiant']) ?>" type="number" name="quantite" value="1" min="1" max="<?= htmlspecialchars($produit['quantite_stock'] ?? 1) ?>" <?= ($produit['quantite_stock'] <= 0) ? 'disabled' : '' ?>>
                            <button type="submit" <?= ($produit['quantite_stock'] <= 0) ? 'disabled' : '' ?>>
                                <?= ($produit['quantite_stock'] <= 0) ? 'Rupture' : 'Ajouter au panier' ?>
                            </button>
                        </div>
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
            <div class="footer-brand">
                <img src="Ressources/vangovibeslogo.png" alt="logo VangoVibes">
                <p>L'authenticité et l'artisanat malgache à votre poignet.</p>
            </div>

            <div class="footer-contact">
                <h3>Contact</h3>
                <p><strong>Tél :</strong> +33 4 89 15 30 00</p>
                <p><strong>Email :</strong> <a href="mailto:andhylng29@gmail.com" class="contacter">vangovibes@gmail.com</a></p>
            </div>

            <div class="reseaux">
                <h3>Réseaux sociaux</h3>
                <div class="reseaux-icons">
                    <a href="https://www.linkedin.com/in/leong-foc-sing-andhy-raharison-2404322b7/" target="_blank" rel="noopener" aria-label="LinkedIn">
                        <img src="Ressources/linkedin-icon.png" alt="LinkedIn">
                    </a>
                    <a href="https://www.instagram.com/andhy_leong/" target="_blank" rel="noopener" aria-label="Instagram">
                        <img src="Ressources/instagram-icon.png" alt="Instagram">
                    </a>
                    <a href="https://github.com/andhy-leong" target="_blank" rel="noopener" aria-label="GitHub">
                        <img src="Ressources/git-icon.png" alt="GitHub">
                    </a>
                    <a href="https://www.youtube.com/@andhy_leong" target="_blank" rel="noopener" aria-label="YouTube">
                        <img src="Ressources/youtube-icon.png" alt="YouTube">
                    </a>
                </div>
            </div>
        </div>

        <div class="copyrigth">
            <p>&copy; 2025 Vangovibes - Tous droits réservés</p>
        </div>
    </footer>

    <script src="js/accueil.js"></script>
</body>
</html>
