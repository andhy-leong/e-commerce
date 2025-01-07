<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des administrateurs</title>
</head>
<body>
    <a href="admin.php?action=ajouterAdminForm">Ajouter un administrateur</a>
    <table>
        <thead>
            <tr>
                <th>Nom d'utilisateur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin): ?>
                <tr>
                    <td><?= htmlspecialchars($admin['username']) ?></td>
                    <td>
                        <a href="admin.php?action=supprimerAdmin&id=<?= $admin['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>