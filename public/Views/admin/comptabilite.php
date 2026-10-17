<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Comptabilité - VangoVibes</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/comptabilite.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <div>
            <a href="admin.php?action=afficherDashboard">
                <img src="Ressources/vangovibeslogo.png" alt="logo VangoVibes">
            </a>
        </div>
    </header>

    <div class="admin-page-container">
        <h1>Comptabilité & Marges</h1>

        <div class="actions-bar">
            <a class="btn-retour" href="admin.php?action=afficherDashboard">&larr; Tableau de bord</a>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Prix Public</th>
                        <th>Prix Achat</th>
                        <th>Bénéfice Unitaire</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $totalBenefice = 0;
                    foreach ($produits as $produit): 
                        $prixPublic = $produit['prix_public'];
                        $prixAchat = $produit['prix_achat'];
                        $benefice = $prixPublic - $prixAchat;
                    ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($produit['titre']) ?></strong></td>
                            <td><?= htmlspecialchars($prixPublic) ?> €</td>
                            <td><?= htmlspecialchars($prixAchat) ?> €</td>
                            <td class="<?= $benefice >= 0 ? 'profit' : 'loss' ?>">
                                <strong><?= ($benefice >= 0 ? '+' : '') . htmlspecialchars($benefice) ?> €</strong>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>