<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des administrateurs</title>
    <link rel="stylesheet" type="text/css" href="../public/css/header.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/admins.css"/>
</head>
<body>
<header>
    <div>
        <a href="admin.php?action=afficherDashboard">
            <img src="../Ressources/vangovibeslogo.png" alt="logo">
        </a>
    </div>
</header>
    <h1>Gestion des Administrateurs</h1>
    <a href="admin.php?action=ajouterAdminForm">Ajouter un administrateur</a>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="message"><?= htmlspecialchars($_SESSION['message']) ?></div>
        <?php unset($_SESSION['message']); // Supprimer le message après l'affichage ?>
    <?php endif; ?>

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
                        <form action="admin.php?action=modifierAdmin" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $admin['id'] ?>">
                            <input type="text" name="username" value="<?= htmlspecialchars($admin['username']) ?>" required>
                            <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
                            <button type="submit">Modifier</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>