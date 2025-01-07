<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration des Fournisseurs</title>
</head>
<body>
    <h1>Gestion des Fournisseurs</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fournisseurs as $fournisseur): ?>
                <tr>
                    <td><?= htmlspecialchars($fournisseur['nom']) ?></td>
                    <td><?= htmlspecialchars($fournisseur['contact']) ?></td>
                    <td><?= htmlspecialchars($fournisseur['email']) ?></td>
                    <td><?= htmlspecialchars($fournisseur['telephone']) ?></td>
                    <td>
                        <!-- Actions pour modifier ou supprimer un fournisseur -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
