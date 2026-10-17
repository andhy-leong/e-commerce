<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Commandes - VangoVibes</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/adminClients.css"/>
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
        <h1>Liste des Commandes</h1>

        <div class="actions-bar">
            <a class="clients btn-secondary" href="admin.php?action=afficherDashboard">&larr; Tableau de bord</a>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>N° Commande</th>
                        <th>Date</th>
                        <th>Prix Total HT</th>
                        <th>Prix Total TTC</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commandes as $commande): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($commande['numero_commande']) ?></strong></td>
                            <td><?= htmlspecialchars($commande['date']) ?></td>
                            <td><?= htmlspecialchars($commande['total_ht']) ?> €</td>
                            <td style="color:#963B38; font-weight:700;"><?= htmlspecialchars($commande['total_ttc']) ?> €</td>
                            <td>
                                <a class="clients btn-primary" style="padding: 5px 10px; font-size: 13px; min-height: auto;" href="admin.php?action=afficherDetailsCommande&id=<?= htmlspecialchars($commande['id']) ?>">Voir Détails</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>