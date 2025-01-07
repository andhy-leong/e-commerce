<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Client</title>
</head>
<body>
    <h1>Bienvenue dans votre espace client</h1>

    <a href="client.php?action=logout">Déconnexion</a>

    <h2>Vos informations personnelles</h2>
    <form method="post" action="client.php?action=modifierInfos">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($client['nom']) ?>" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($client['prenom']) ?>" required><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($client['email']) ?>" required><br>

        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="telephone" value="<?= htmlspecialchars($client['telephone']) ?>" required><br>

        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" value="<?= htmlspecialchars($client['adresse']) ?>" required><br>

        <button type="submit">Mettre à jour</button>
    </form>

    <h2>Changer votre mot de passe</h2>
    <form method="post" action="client.php?action=modifierMotDePasse">
        <label for="ancienMotDePasse">Ancien mot de passe :</label>
        <input type="password" id="ancienMotDePasse" name="ancienMotDePasse" required><br>

        <label for="nouveauMotDePasse">Nouveau mot de passe :</label>
        <input type="password" id="nouveauMotDePasse" name="nouveauMotDePasse" required><br>

        <button type="submit">Changer le mot de passe</button>
    </form>

    <h2>Vos commandes</h2>
    <ul>
        <?php foreach ($commandes as $commande): ?>
            <li>
                Commande #<?= htmlspecialchars($commande['numero_commande']) ?> - Date: <?= htmlspecialchars($commande['date']) ?> - Montant: <?= htmlspecialchars($commande['montant']) ?> €
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>