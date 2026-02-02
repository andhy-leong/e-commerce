<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Commande</title>
    <link rel="stylesheet" type="text/css"  href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/detailsCommande.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header>
<div>
            <a href="admin.php?action=afficherDashboard">
                <img src="../Ressources/vangovibeslogo.png" alt="logo" style="border: none;">
            </a>
        </div>
    </header>
    <h1>Détails de la Commande #<?= htmlspecialchars($details[0]['numero_commande']) ?></h1>
    <h2>Informations du Client</h2>
    <p>Nom: <?= htmlspecialchars($clientInfo['nom']) ?></p>
    <p>Prénom: <?= htmlspecialchars($clientInfo['prenom']) ?></p>
    <p>Email: <?= htmlspecialchars($clientInfo['email']) ?></p>
    <p>Téléphone: <?= htmlspecialchars($clientInfo['telephone']) ?></p>
    <p>Adresse : <?= htmlspecialchars($clientInfo['adresse'] ?? 'Non spécifiée') ?></p>

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

    <a href="admin.php?action=afficherCommandes">Retour à la liste des commandes</a>
</body>
</html> 