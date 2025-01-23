<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Commandes</title>
    <link rel="stylesheet" type="text/css"  href="../public/css/header.css"/>
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
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
<header>
        <div>
        <a href="admin.php?action=afficherDashboard">
                <img src="../Ressources/vangovibeslogo.png" alt="logo">
            </a>
        </div>
    </header>
    <h1>Liste des Commandes</h1>
    <table>
        <thead>
            <tr>
                <th>Numéro de Commande</th>
                <th>Date</th>
                <th>Prix Total HT</th>
                <th>Prix Total TTC</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes as $commande): ?>
                <tr>
                    <td><?= htmlspecialchars($commande['numero_commande']) ?></td>
                    <td><?= htmlspecialchars($commande['date']) ?></td>
                    <td><?= htmlspecialchars($commande['total_ht']) ?> €</td>
                    <td><?= htmlspecialchars($commande['total_ttc']) ?> €</td>
                    <td>
                        <a href="admin.php?action=afficherDetailsCommande&id=<?= htmlspecialchars($commande['id']) ?>">Voir Détails</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>