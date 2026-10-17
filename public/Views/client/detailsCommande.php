<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Commande - VangoVibes</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/detailsCommande.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <div>
            <a href="client.php?action=afficherProduits">
                <img src="Ressources/vangovibeslogo.png" alt="logo VangoVibes">
            </a>
        </div>
    </header>

    <div class="details-container">
        <h1>Détails de la Commande #<?= htmlspecialchars($commande['numero_commande']) ?></h1>
        
        <div class="client-info-card">
            <h2>Informations du Client</h2>
            <div class="info-grid">
                <p><strong>Nom :</strong> <?= htmlspecialchars($clientInfo['nom']) ?></p>
                <p><strong>Prénom :</strong> <?= htmlspecialchars($clientInfo['prenom']) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($clientInfo['email']) ?></p>
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($clientInfo['telephone']) ?></p>
                <p class="adresse-full"><strong>Adresse de livraison :</strong> <?= htmlspecialchars($clientInfo['adresse']) ?></p>
            </div>
        </div>

        <h2>Articles Commandés</h2>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Article</th>
                        <th>Qté</th>
                        <th>Prix Unitaire</th>
                        <th>Total HT</th>
                        <th>Total TTC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($details as $article): ?>
                        <tr>
                            <td><?= htmlspecialchars($commande['date']) ?></td>
                            <td><strong><?= htmlspecialchars($article['titre']) ?></strong></td>
                            <td><?= htmlspecialchars($article['quantite']) ?></td>
                            <td><?= htmlspecialchars($article['prix_public']) ?> €</td>
                            <td><?= htmlspecialchars($commande['total_ht']) ?> €</td>
                            <td><strong class="prix-ttc"><?= htmlspecialchars($commande['total_ttc']) ?> €</strong></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="actions-bas">
            <a href="client.php?action=espaceClient" class="btn-retour">&larr; Retour à mes commandes</a>
        </div>
    </div>
</body>
</html>