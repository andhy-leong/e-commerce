<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Commandes</title>
</head>
<body>
    <h1>Liste des Commandes</h1>
    <table>
        <thead>
            <tr>
                <th>Numéro de Commande</th>
                <th>Date</th>
                <th>Prix Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes as $commande): ?>
                <tr>
                    <td><?= htmlspecialchars($commande['id']) ?></td>
                    <td><?= htmlspecialchars($commande['date']) ?></td>
                    <td><?= htmlspecialchars($commande['prix_total']) ?> €</td>
                    <td>
                        <a href="admin.php?action=afficherDetailsCommande&id=<?= htmlspecialchars($commande['id']) ?>">Voir Détails</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>