<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Commande</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/detailsCommande.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <div>
            <a href="client.php?action=afficherProduits">
                <img src="../Ressources/vangovibeslogo.png" alt="logo">
            </a>
        </div>
    </header>
    <h1>Détails de la Commande #<?= htmlspecialchars($commande['numero_commande']) ?></h1>
    
    <h2>Informations du Client</h2>
    <p>Nom: <?= htmlspecialchars($clientInfo['nom']) ?></p>
    <p>Prénom: <?= htmlspecialchars($clientInfo['prenom']) ?></p>
    <p>Email: <?= htmlspecialchars($clientInfo['email']) ?></p>
    <p>Téléphone: <?= htmlspecialchars($clientInfo['telephone']) ?></p>
    <p>Adresse: <?= htmlspecialchars($clientInfo['adresse']) ?></p>

    <h2>Articles Commandés</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Titre</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Prix Total HT</th>
                <th>Prix Total TTC</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($details as $article): ?>
                <tr>
                    <td><?= htmlspecialchars($commande['date']) ?></td>
                    <td><?= htmlspecialchars($article['titre']) ?></td>
                    <td><?= htmlspecialchars($article['quantite']) ?></td>
                    <td><?= htmlspecialchars($article['prix_public']) ?> €</td>
                    <td><?= htmlspecialchars($commande['total_ht']) ?> €</td>
                    <td><?= htmlspecialchars($commande['total_ttc']) ?> €</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="client.php?action=espaceClient">Retour à mes commandes</a>
</body>
</html> 