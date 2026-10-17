<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Client - VangoVibes</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/espaceClient.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <div>
            <a href="client.php?action=afficherProduits">
                <img src="Ressources/vangovibeslogo.png" alt="logo VangoVibes">
            </a>
        </div>
    </header>

    <div class="espace-container">
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="message success"><?= htmlspecialchars($_SESSION['success_message']) ?></div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="message error"><?= htmlspecialchars($_SESSION['error_message']) ?></div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <div class="client-header">
            <h1>Bienvenue, <?= htmlspecialchars($client['prenom']) ?> <?= htmlspecialchars($client['nom']) ?></h1>
            <div class="actions-haut">
                <a href="client.php?action=afficherProduits" class="btn-boutique">&larr; Continuer mes achats</a>
                <a href="client.php?action=logout" class="btn-deconnexion">Déconnexion</a>
            </div>
        </div>

        <div class="formulaires-grid">
            <div class="form-section">
                <h2>Vos informations personnelles</h2>
                <form method="post" action="client.php?action=modifierInfos">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($client['nom']) ?>" required>

                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($client['prenom']) ?>" required>

                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($client['email']) ?>" required>

                    <label for="telephone">Téléphone :</label>
                    <input type="text" id="telephone" name="telephone" value="<?= htmlspecialchars($client['telephone']) ?>" required>

                    <label for="adresse">Adresse :</label>
                    <input type="text" id="adresse" name="adresse" value="<?= htmlspecialchars($client['adresse']) ?>" required>

                    <button type="submit">Mettre à jour mes informations</button>
                </form>
            </div>

            <div class="form-section">
                <h2>Changer votre mot de passe</h2>
                <form method="post" action="client.php?action=modifierMotDePasse">
                    <label for="ancienMotDePasse">Ancien mot de passe :</label>
                    <input type="password" id="ancienMotDePasse" name="ancienMotDePasse" required>

                    <label for="nouveauMotDePasse">Nouveau mot de passe :</label>
                    <input type="password" id="nouveauMotDePasse" name="nouveauMotDePasse" required>

                    <button type="submit">Changer le mot de passe</button>
                </form>
            </div>
        </div>

        <div class="commandes-section">
            <h2>Vos Commandes</h2>
            <?php if (!empty($commandes)): ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>N° Commande</th>
                                <th>Date</th>
                                <th>Total TTC</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($commandes as $commande): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($commande['numero_commande']) ?></strong></td>
                                    <td><?= htmlspecialchars($commande['date']) ?></td>
                                    <td class="montant"><?= htmlspecialchars($commande['total_ttc']) ?> €</td>
                                    <td>
                                        <a href="client.php?action=afficherDetailsCommande&id=<?= htmlspecialchars($commande['id']) ?>" class="btn-details">Voir détails</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="vide-message">Vous n'avez pas encore passé de commande.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>