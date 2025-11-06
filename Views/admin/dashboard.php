<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord Admin</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <div>
            <a href="admin.php?action=afficherDashboard">
                <img src="../Ressources/vangovibeslogo.png" alt="logo" style="border: none;">
            </a>
        </div>
    </header>
    <div class="container">
        <h1>Bienvenue sur le tableau de bord</h1>
    </div>
    <nav>
        <a href="admin.php?action=afficherClients">Gérer les clients</a>
        <a href="admin.php?action=afficherProduits">Gérer les produits</a>
        <a href="admin.php?action=afficherAdmins">Gérer les administrateurs</a>
        <a href="admin.php?action=afficherCommandes">Gérer les commandes</a>
        <a href="admin.php?action=afficherBenefices">Comptabilité</a>
        <a href="admin.php?action=afficherFournisseurs">Gérer les fournisseurs</a>
        <a href="client.php?action=afficherProduits">Retour à la pages d'accueil des clients</a>
        <a href="admin.php?action=logout">Déconnexion</a>
    </nav>
</body>
</html>