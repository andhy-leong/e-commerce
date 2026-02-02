
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
    <h1>Liste des Produits</h1>

    
    <?php if (isset($_SESSION['message'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_SESSION['message']) ?></p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>


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
                <th>Actions</th>
            </tr>
        </thead>
        <div>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><img src="../Ressources/Vangovango/vangovango1_1.png" alt="Image du produit" style="width:50px;height:50px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
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
        </div>
        <div>
        <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><img src="../Ressources/Vangovango/vangovango2_1.png" alt="Image du produit" style="width:50px;height:50px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
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
        </div>
        <div>
        <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><img src="../Ressources/Vangovango/vangovango3_1.png" alt="Image du produit" style="width:50px;height:50px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
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
        </div>
        <div>
        <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><img src="../Ressources/Vangovango/vangovango4_1.png" alt="Image du produit" style="width:50px;height:50px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
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
        </div>
        <div>
        <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><img src="../Ressources/Vangovango/vangovango5_1.png" alt="Image du produit" style="width:50px;height:50px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
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
        </div>
        <div>
        <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><img src="../Ressources/Vangovango/vangovango6_1.png" alt="Image du produit" style="width:50px;height:50px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
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
        </div>
        <div>
        <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><img src="../Ressources/Vangovango/vangovango7_1.png" alt="Image du produit" style="width:50px;height:50px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
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
        </div>
        <div>
        <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><img src="../Ressources/Vangovango/vangovango8_1.png" alt="Image du produit" style="width:50px;height:50px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
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
        </div>
        <div>
        <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><img src="../Ressources/Vangovango/vangovango9_1.png" alt="Image du produit" style="width:50px;height:50px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
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
        </div>
        <div>
        <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><img src="../Ressources/Vangovango/vangovango10_1.png" alt="Image du produit" style="width:50px;height:50px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
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
        </div>
        <div>
        <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><img src="../Ressources/Vangovango/vangovango11_1.png" alt="Image du produit" style="width:50px;height:50px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
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
        </div>
        <div>
        <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><img src="../Ressources/Vangovango/vangovango12_1.png" alt="Image du produit" style="width:50px;height:50px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
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
        </div>
        <div>
        <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['reference'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['titre'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['descriptif'] ?? '') ?></td>
                    <td><img src="../Ressources/Vangovango/vangovango13_1.png" alt="Image du produit" style="width:50px;height:50px;"></td>
                    <td><?= htmlspecialchars($produit['provenance'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['couleur'] ?? '') ?></td>
                    <td><?= htmlspecialchars($produit['prix_public'] ?? '') ?> €</td>
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
        </div>
        <div class="vangovango">
            <div></div>

        </div>
    </table>
</body>