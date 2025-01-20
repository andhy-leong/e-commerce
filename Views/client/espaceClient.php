<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Client</title>
    <style>
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="message success"><?= htmlspecialchars($_SESSION['success_message']) ?></div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="message error"><?= htmlspecialchars($_SESSION['error_message']) ?></div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <h1>Bienvenue, <?= htmlspecialchars($client['prenom']) ?> <?= htmlspecialchars($client['nom']) ?></h1>
    


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

    <h2>Vos Commandes</h2>
    <?php if (!empty($commandes)): ?>
        <table>
            <thead>
                <tr>
                    <th>Numéro de Commande</th>
                    <th>Date</th>
                    <th>Montant Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande): ?>
                    <tr>
                        <td><?= htmlspecialchars($commande['numero_commande']) ?></td>
                        <td><?= htmlspecialchars($commande['date']) ?></td>
                        <td><?= htmlspecialchars($commande['total_ttc']) ?> €</td>
                        <td>
                            <a href="client.php?action=afficherDetailsCommande&id=<?= htmlspecialchars($commande['id']) ?>">Voir Détails</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Vous n'avez pas encore passé de commande.</p>
    <?php endif; ?>

    <a href="client.php?action=logout">Déconnexion</a>
</body>
</html>