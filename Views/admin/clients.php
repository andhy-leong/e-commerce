<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Clients</title>
    <link rel="stylesheet" type="text/css" href="../public/css/header.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/adminClients.css"/>
    
</head>
<body>
<header>
        <div>
        <a href="admin.php?action=afficherDashboard">
                <img src="../Ressources/vangovibeslogo.png" alt="logo">
            </a>
        </div>
    </header>
    <h1>Liste des Clients</h1>
    <a class="clients" href="admin.php?action=ajouterClientForm">Inscrire un client</a>
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
                    <td><?= htmlspecialchars($client['nom']) ?></td>
                    <td><?= htmlspecialchars($client['prenom']) ?></td>
                    <td><?= htmlspecialchars($client['email']) ?></td>
                    <td><?= htmlspecialchars($client['telephone']) ?></td>
                    <td><?= htmlspecialchars($client['adresse']) ?></td>
                    <td>
                        <a class="clients"href="admin.php?action=supprimerClient&id=<?= $client['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">Supprimer le client</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>