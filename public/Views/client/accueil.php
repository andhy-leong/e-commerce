<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - VangoVibes</title>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #fbf9f8;
            margin: 0;
            color: #2c2c2c;
            text-align: center;
        }
        .accueil-container {
            width: 90%;
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            padding: 30px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        }
        h1 {
            color: #963B38;
            font-size: 2rem;
            margin-bottom: 12px;
        }
        p {
            color: #666;
            margin-bottom: 30px;
        }
        .liens {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .liens a {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }
        .btn-primaire {
            background-color: #963B38;
            color: #ffffff;
        }
        .btn-primaire:hover {
            background-color: #7a2a2a;
        }
        .btn-secondaire {
            border: 2px solid #963B38;
            color: #963B38;
        }
        .btn-secondaire:hover {
            background-color: #963B38;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <header>
        <div>
            <a href="client.php?action=afficherProduits">
                <img src="Ressources/vangovibeslogo.png" alt="logo VangoVibes">
            </a>
        </div>
    </header>
    <div class="accueil-container">
        <h1>Bienvenue sur VangoVibes</h1>
        <p>Explorez nos collections de bracelets artisanaux et vos espaces dédiés.</p>
        <div class="liens">
            <a href="client.php?action=afficherProduits" class="btn-primaire">Découvrir la boutique</a>
            <a href="client.php?action=espaceClient" class="btn-secondaire">Accéder à votre espace client</a>
            <a href="client.php?action=loginForm" class="btn-secondaire">Se connecter</a>
        </div>
    </div>
</body>
</html>