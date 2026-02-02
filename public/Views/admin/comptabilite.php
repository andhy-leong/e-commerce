<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Comptabilité</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/produitsAdmins.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .profit {
            color: green; /* Couleur pour le bénéfice */
        }
        .loss {
            color: red; /* Couleur pour la perte */
        }
        table {
            width: 100%; /* Largeur de la table */
            border-collapse: collapse; /* Fusionner les bordures */
            margin-top: 20px; /* Marge au-dessus de la table */
        }
        th, td {
            border: 1px solid #ddd; /* Bordure des cellules */
            padding: 8px; /* Espacement interne des cellules */
            text-align: left; /* Alignement du texte à gauche */
        }
        th {
            background-color: #f2f2f2; /* Couleur de fond des en-têtes */
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
<h1>Comptabilité</h1>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Prix Public</th>
            <th>Prix Achat</th>
            <th>Bénéfice</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produits as $produit): ?>
            <?php
                $prixPublic = $produit['prix_public'];
                $prixAchat = $produit['prix_achat'];
                $benefice = $prixPublic - $prixAchat;
            ?>
            <tr>
                <td><?= htmlspecialchars($produit['titre']) ?></td>
                <td><?= htmlspecialchars($prixPublic) ?> €</td>
                <td><?= htmlspecialchars($prixAchat) ?> €</td>
                <td class="<?= $benefice >= 0 ? 'profit' : 'loss' ?>">
                    <?= htmlspecialchars($benefice) ?> €
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html> 