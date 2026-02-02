<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Fournisseur</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/modifierFournisseur.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header>
    <div>
        <a href="admin.php?action=afficherDashboard">
            <img src="../Ressources/vangovibeslogo.png" alt="logo">
        </a>
    </div>
</header>
<h1>Modifier un Fournisseur</h1>
<form action="admin.php?action=modifierFournisseur&id=<?= htmlspecialchars($fournisseur['id']) ?>" method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($fournisseur['nom']) ?>" required>
    <br>
    <label for="adresse">Adresse :</label>
    <input type="text" id="adresse" name="adresse" value="<?= htmlspecialchars($fournisseur['adresse']) ?>" required>
    <br>
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($fournisseur['email']) ?>" required>
    <br>
    <label for="telephone">Téléphone :</label>
    <input type="text" id="telephone" name="telephone" value="<?= htmlspecialchars($fournisseur['telephone']) ?>" required>
    <br>
    <label for="produits_vendus">Produits Vendus :</label>
    <select id="produits_vendus" name="produits_vendus" required>
        <option value="">Sélectionnez un produit</option>
        <option value="Collier" <?= $fournisseur['produits_vendus'] == 'Collier' ? 'selected' : '' ?>>Collier</option>
        <option value="Bracelet" <?= $fournisseur['produits_vendus'] == 'Bracelet' ? 'selected' : '' ?>>Bracelet</option>
        <option value="Pendantif" <?= $fournisseur['produits_vendus'] == 'Pendantif' ? 'selected' : '' ?>>Pendantif</option>
        <option value="Boucle d'oreille" <?= $fournisseur['produits_vendus'] == 'Boucle d\'oreille' ? 'selected' : '' ?>>Boucle d'oreille</option>
    </select>
    <br>
    <button type="submit">MMettre à jour les informations du fournisseur</button>
</form>
</body>
</html> 