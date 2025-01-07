<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Commande</title>
</head>
<body>
    <h1>Détails de la Commande #<?= htmlspecialchars($details[0]['id']) ?></h1>
    <h2>Informations du Client</h2>
    <p>Nom: <?= htmlspecialchars($clientInfo['nom']) ?></p>
    <p>Prénom: <?= htmlspecialchars($clientInfo['prenom']) ?></p>
    <p>Email: <?= htmlspecialchars($clientInfo['email']) ?></p>
    <p>Téléphone: <?= htmlspecialchars($clientInfo['telephone']) ?></p>

    <h2>Articles Commandés</h2>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Prix</th>
                <th>Quantité</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($details as $article): ?>
                <tr>
                    <td><?= htmlspecialchars($article['titre']) ?></td>
                    <td><?= htmlspecialchars($article['prix_public']) ?> €</td>
                    <td><?= htmlspecialchars($article['quantite']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>