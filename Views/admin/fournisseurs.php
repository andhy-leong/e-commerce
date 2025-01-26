<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Fournisseurs</title>
    <link rel="stylesheet" type="text/css" href="../public/css/header.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/fournisseurs.css"/>
</head>
<body>
<header>
    <div>
        <a href="admin.php?action=afficherDashboard">
            <img src="../Ressources/vangovibeslogo.png" alt="logo">
        </a>
    </div>
</header>
<h1>Gestion des Fournisseurs</h1>

<?php if (isset($_SESSION['success_message'])): ?>
    <div class="success-message" style="color: green; text-align: center;">
        <?= htmlspecialchars($_SESSION['success_message']) ?>
        <?php unset($_SESSION['success_message']); // Supprimer le message après l'affichage ?>
    </div>
<?php endif; ?>

<a class="ajoutFournisseur" href="admin.php?action=ajouterFournisseurForm">Ajouter un Fournisseur</a>

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
                <td><?= htmlspecialchars($fournisseur['nom']) ?></td>
                <td><?= htmlspecialchars($fournisseur['adresse']) ?></td>
                <td><?= htmlspecialchars($fournisseur['email']) ?></td>
                <td><?= htmlspecialchars($fournisseur['telephone']) ?></td>
                <td><?= htmlspecialchars($fournisseur['produits_vendus']) ?></td>
                <td>
                    <a class="ajoutFournisseur" href="admin.php?action=modifierFournisseurForm&id=<?= $fournisseur['id'] ?>">Modifier</a>
                    <a class="ajoutFournisseur" href="admin.php?action=supprimerFournisseur&id=<?= $fournisseur['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fournisseur ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
