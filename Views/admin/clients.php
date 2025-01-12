<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Clients</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Liste des Clients</h1>
    <a href="admin.php?action=ajouterClientForm">Inscrire un client</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
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
                    <td><?= htmlspecialchars($client['id']) ?></td>
                    <td><?= htmlspecialchars($client['nom']) ?></td>
                    <td><?= htmlspecialchars($client['prenom']) ?></td>
                    <td><?= htmlspecialchars($client['email']) ?></td>
                    <td><?= htmlspecialchars($client['telephone']) ?></td>
                    <td><?= htmlspecialchars($client['adresse']) ?></td>
                    <td>
                        <?php if (!empty($client['commandes'])): ?>
                            <ul>
                                <?php 
                                $commandesAffichees = []; // Tableau pour suivre les commandes affichées
                                foreach ($client['commandes'] as $commande): 
                                    if (!in_array($commande['numero_commande'], $commandesAffichees)): // Vérifiez si la commande a déjà été affichée
                                        $commandesAffichees[] = $commande['numero_commande']; // Ajoutez à la liste des affichées
                                ?>
                                    <li>
                                        Commande #<?= htmlspecialchars($commande['numero_commande']) ?> - Date: <?= htmlspecialchars($commande['date']) ?> - Montant: <?= htmlspecialchars($commande['montant']) ?> €
                                    </li>
                                <?php 
                                    endif; 
                                endforeach; 
                                ?>
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