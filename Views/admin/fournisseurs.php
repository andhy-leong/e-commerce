<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Fournisseurs - VangoVibes</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/fournisseurs.css"/>
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
        <h1>Gestion des Fournisseurs</h1>

        <div class="actions-bar">
            <a class="ajoutFournisseur btn-primary" href="admin.php?action=ajouterFournisseurForm">+ Ajouter un Fournisseur</a>
            <a class="ajoutFournisseur btn-secondary" href="admin.php?action=afficherDashboard">&larr; Tableau de bord</a>
        </div>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="success-message">
                <?= htmlspecialchars($_SESSION['success_message']) ?>
                <?php unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Produits Vendus</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fournisseurs as $fournisseur): ?>
                        <tr>
                            <td><?= htmlspecialchars($fournisseur['id']) ?></td>
                            <td><strong><?= htmlspecialchars($fournisseur['nom']) ?></strong></td>
                            <td><?= htmlspecialchars($fournisseur['adresse']) ?></td>
                            <td><?= htmlspecialchars($fournisseur['email']) ?></td>
                            <td><?= htmlspecialchars($fournisseur['telephone']) ?></td>
                            <td><?= htmlspecialchars($fournisseur['produits_vendus']) ?></td>
                            <td class="actions-cell">
                                <a class="btn-action-modifier" href="admin.php?action=modifierFournisseurForm&id=<?= $fournisseur['id'] ?>">Modifier</a>
                                <a class="btn-action-supprimer" href="admin.php?action=supprimerFournisseur&id=<?= $fournisseur['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fournisseur ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
