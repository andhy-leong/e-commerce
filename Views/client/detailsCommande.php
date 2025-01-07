<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Commande</title>
</head>
<body>
    <h1>Détails de la Commande</h1>

    <table>
        <thead>
            <tr>
                <th>Numéro de Commande</th>
                <th>Date</th>
                <th>Prix Total HT</th>
                <th>Prix Total TTC</th>
                <th>Coordonnées du Client</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= htmlspecialchars($commande['numero_commande']) ?></td>
                <td><?= htmlspecialchars($commande['date']) ?></td>
                <td><?= htmlspecialchars($commande['total_ht']) ?> €</td>
                <td><?= htmlspecialchars($commande['total_ttc']) ?> €</td>
                <td><?= htmlspecialchars($client['nom'] . ' ' . $client['prenom'] . ', ' . $client['email']) ?></td>
            </tr>
        </tbody>
    </table>

    <a href="client.php?action=espaceClient">Retour à mes commandes</a>
</body>
</html> 