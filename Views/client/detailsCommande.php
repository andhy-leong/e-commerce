<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Commande</title>
</head>
<body>
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
                <th>Prix Total HT</th>
                <th>Prix Total TTC</th>
                <th>Titre</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Date de Commande</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($details as $article): ?>
                <tr>
                    <td><?= htmlspecialchars($commande['date']) ?></td>
                    <td><?= htmlspecialchars($commande['total_ht']) ?> €</td>
                    <td><?= htmlspecialchars($commande['total_ttc']) ?> €</td>
                    <td><?= htmlspecialchars($article['titre']) ?></td>
                    <td><?= htmlspecialchars($article['prix_public']) ?> €</td>
                    <td><?= htmlspecialchars($article['quantite']) ?></td>
                    <td><?= htmlspecialchars($article['date']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="client.php?action=espaceClient">Retour à mes commandes</a>
</body>
</html> 