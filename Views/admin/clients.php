<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Clients</title>
</head>
<body>
    <h1>Liste des Clients</h1>
    <a href="admin.php?action=ajouterClientForm">Ajouter un client</a>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Commandes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?= htmlspecialchars($client['nom']) ?></td>
                    <td><?= htmlspecialchars($client['prenom']) ?></td>
                    <td><?= htmlspecialchars($client['email']) ?></td>
                    <td><?= htmlspecialchars($client['telephone']) ?></td>
                    <td><?= htmlspecialchars($client['adresse']) ?></td>
                    <td>
                        <?php if (!empty($client['commandes'])): ?>
                            <ul>
                                <?php foreach ($client['commandes'] as $commande): ?>
                                    <li>
                                        Commande #<?= htmlspecialchars($commande['numero_commande']) ?> - Date: <?= htmlspecialchars($commande['date']) ?> - Montant: <?= htmlspecialchars($commande['montant']) ?> €
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            Aucune commande passée.
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="admin.php?action=supprimerClient&id=<?= $client['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>