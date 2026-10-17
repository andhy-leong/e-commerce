<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Administrateurs - VangoVibes</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/admins.css"/>
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
        <h1>Gestion des Administrateurs</h1>

        <div class="actions-bar">
            <a class="btn-primary" href="admin.php?action=ajouterAdminForm">+ Ajouter un administrateur</a>
            <a class="btn-secondary" href="admin.php?action=afficherDashboard">&larr; Tableau de bord</a>
        </div>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="message"><?= htmlspecialchars($_SESSION['message']) ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="table-responsive">
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
                            <td><strong><?= htmlspecialchars($admin['username']) ?></strong></td>
                            <td class="admin-actions-cell">
                                <form action="admin.php?action=modifierAdmin" method="post" class="form-modifier-admin">
                                    <input type="hidden" name="id" value="<?= $admin['id'] ?>">
                                    <input type="text" name="username" value="<?= htmlspecialchars($admin['username']) ?>" required placeholder="Identifiant">
                                    <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
                                    <button type="submit" class="btn-modifier">Modifier</button>
                                </form>
                                <a class="btn-supprimer" href="admin.php?action=supprimerAdmin&id=<?= $admin['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>