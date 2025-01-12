<?php
session_start();

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../Controllers/ClientController.php';
require_once __DIR__ . '/../Controllers/ClientProduitController.php';
require_once __DIR__ . '/../Models/Client.php';
require_once __DIR__ . '/../Models/Commande.php';

$clientController = new ClientController();
$produitController = new ClientProduitController();
$clientModel = new Client($db);
$commandeModel = new Commande($db);

$action = $_GET['action'] ?? 'afficherProduits';

switch ($action) {
    case 'afficherProduits':
        $searchTerm = $_GET['search'] ?? '';
        $sort = $_GET['sort'] ?? 'nom_asc';
        $produitController->afficherProduits($searchTerm, $sort);
        break;
    case 'loginForm':
        require __DIR__ . '/../Views/client/login.php';
        break;
    case 'registerForm':
        require __DIR__ . '/../Views/client/register.php';
        break;
    case 'register':
        var_dump($_POST);
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';
        $telephone = $_POST['telephone'] ?? '';
        $numero_rue = $_POST['numero_rue'] ?? '';
        $nom_rue = $_POST['nom_rue'] ?? '';
        $code_postal = $_POST['code_postal'] ?? '';
        $ville = $_POST['ville'] ?? '';
        $mot_de_passe = $_POST['mot_de_passe'] ?? '';

        // Validation des données
        if (empty($nom) || empty($prenom) || empty($email) || empty($telephone) || empty($numero_rue) || empty($nom_rue) || empty($code_postal) || empty($ville) || empty($mot_de_passe)) {
            echo "Tous les champs sont requis.";
            break;
        }

        // Vérifiez si l'e-mail existe déjà
        if ($clientModel->emailExists($email)) {
            echo "L'adresse e-mail est déjà utilisée.";
            break;
        }

        // Logique d'inscription (ajoutez votre code ici pour enregistrer le client)
        $clientModel->addClient([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'telephone' => $telephone,
            'adresse' => "$numero_rue $nom_rue, $code_postal $ville", // Combinez les champs d'adresse
            'mot_de_passe' => $mot_de_passe
        ]);

        header('Location: client.php?action=loginForm'); // Rediriger vers la page de connexion après l'inscription
        exit();
    case 'afficherPanier':
        require __DIR__ . '/../Views/client/panier.php'; // Afficher le panier
        break;
    case 'ajouterAuPanier':
        $produitId = $_POST['id'] ?? null;
        $quantite = $_POST['quantite'] ?? 1; // Par défaut, ajouter 1 produit

        if ($produitId) {
            // Vérifiez si le panier existe, sinon initialisez-le
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = [];
            }

            // Ajoutez ou mettez à jour la quantité du produit dans le panier
            if (isset($_SESSION['panier'][$produitId])) {
                $_SESSION['panier'][$produitId] += $quantite; // Incrémentez la quantité
            } else {
                $_SESSION['panier'][$produitId] = $quantite; // Ajoutez le produit
            }

            // Stockez le message de succès dans la session
            $_SESSION['message'] = "Produit ajouté au panier avec succès !";
        } else {
            echo "Erreur : produit non spécifié.";
        }
        header('Location: client.php?action=afficherProduits'); // Rediriger vers la page des produits
        exit();
    case 'modifierQuantite':
        // Logique de modification de la quantité...
        break;
    case 'retirerDuPanier':
        // Logique de retrait du panier...
        break;
    case 'logout':
        session_unset();
        session_destroy();
        header('Location: client.php?action=loginForm');
        exit();
    case 'espaceClient':
        if (!isset($_SESSION['client_id'])) {
            header('Location: client.php?action=loginForm');
            exit();
        }
        $clientId = $_SESSION['client_id']; // Récupérez l'ID du client depuis la session
        $clientController->afficherEspaceClient($clientId); // Appelez la méthode pour afficher l'espace client
        break;
    case 'validerPanier':
        if (!isset($_SESSION['client_id'])) {
            header('Location: client.php?action=loginForm');
            exit();
        }

        if (!empty($_SESSION['panier'])) {
            $clientId = $_SESSION['client_id'];
            $totalHt = 0; // Initialiser le total HT
            $totalTtc = 0; // Initialiser le total TTC

            foreach ($_SESSION['panier'] as $produitId => $quantite) {
                $produit = $produitController->getProduitById($produitId);
                if ($produit) {
                    $montantTtc = $produit['prix_public'] * $quantite; // Montant TTC
                    $montantHt = $montantTtc / 1.2; // Calculer le montant HT
                    $totalHt += $montantHt; // Ajouter au total HT
                    $totalTtc += $montantTtc; // Ajouter au total TTC
                }
            }

            // Créer la commande principale
            $commandeId = $commandeModel->addCommande($clientId, $totalHt, $totalTtc);

            // Ajouter chaque produit à la commande
            foreach ($_SESSION['panier'] as $produitId => $quantite) {
                $produit = $produitController->getProduitById($produitId);
                if ($produit) {
                    $montant = $produit['prix_public'] * $quantite; // Montant pour ce produit
                    try {
                        $commandeModel->addCommandeProduit($commandeId, $produitId, $quantite, $montant);
                    } catch (Exception $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                }
            }

            echo "Commande validée avec succès !";
            unset($_SESSION['panier']);
        } else {
            echo "Votre panier est vide.";
        }
        break;
    case 'login':
        $email = $_POST['email'] ?? '';
        $motDePasse = $_POST['mot_de_passe'] ?? '';

        $client = $clientModel->getClientByEmail($email);
        if ($client && password_verify($motDePasse, $client['mot_de_passe'])) {
            $_SESSION['client_id'] = $client['id']; // Définir l'ID du client dans la session
            $_SESSION['client_prenom'] = $client['prenom']; // Définir le prénom du client dans la session
            $_SESSION['client_nom'] = $client['nom']; // Définir le nom du client dans la session
            header('Location: client.php?action=espaceClient'); // Rediriger vers l'espace client
            exit();
        } else {
            echo "Identifiants invalides.";
        }
        break;
    case 'afficherClients':
        $clients = $clientModel->getAllClients(); // Supposons que vous avez une méthode pour obtenir tous les clients
        echo '<h1>Liste des Clients</h1>';
        echo '<p>Le code d\'affichage des clients est atteint.</p>'; // Message de débogage
        echo '<table border="1">';
        echo '<tr><th>Nom</th><th>Prénom</th><th>Email</th><th>Téléphone</th><th>Adresse</th></tr>';
        
        foreach ($clients as $client) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($client['nom']) . '</td>';
            echo '<td>' . htmlspecialchars($client['prenom']) . '</td>';
            echo '<td>' . htmlspecialchars($client['email']) . '</td>';
            echo '<td>' . htmlspecialchars($client['telephone']) . '</td>';
            echo '<td>' . htmlspecialchars($client['adresse']) . '</td>';
            echo '</tr>';
        }
        
        echo '</table>';
        break;
    case 'accueil':
        require __DIR__ . '/../Views/client/accueil.php'; // Assurez-vous que ce fichier existe
        break;
    default:
        $produitController->afficherProduits();
        break;
}
?>


