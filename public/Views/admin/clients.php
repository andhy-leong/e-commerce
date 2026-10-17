<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Clients - VangoVibes</title>
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
        <h1>Liste des Clients</h1>
        
        <div class="actions-bar">
            <a class="clients btn-primary" href="admin.php?action=ajouterClientForm">+ Inscrire un client</a>
            <a class="clients btn-secondary" href="admin.php?action=afficherDashboard">&larr; Tableau de bord</a>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?= htmlspecialchars($client['id']) ?></td>
                            <td><strong><?= htmlspecialchars($client['nom']) ?></strong></td>
                            <td><?= htmlspecialchars($client['prenom']) ?></td>
                            <td><?= htmlspecialchars($client['email']) ?></td>
                            <td><?= htmlspecialchars($client['telephone']) ?></td>
                            <td><?= htmlspecialchars($client['adresse']) ?></td>
                            <td>
                                <a class="btn-supprimer" href="admin.php?action=supprimerClient&id=<?= $client['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>