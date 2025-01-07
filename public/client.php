<?php
session_start();

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../Controllers/ClientProduitController.php';
require_once __DIR__ . '/../Models/Client.php';
require_once __DIR__ . '/../Models/Commande.php';

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
        // Logique d'inscription...
        break;
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
        $client = $clientModel->getClientById($_SESSION['client_id']);
        if (!$client) {
            echo "Client non trouvé.";
            exit();
        }
        $commandes = $clientModel->getClientOrders($_SESSION['client_id']);
        if (!$commandes) {
            echo "Aucune commande trouvée.";
            exit();
        }
        
        // Récupérer les détails de chaque commande
        foreach ($commandes as &$commande) {
            $commande['details'] = $commandeModel->getCommandeDetails($commande['id']);
            // Vérifiez que les détails sont bien un tableau
            if (!is_array($commande['details'])) {
                echo "Détails de la commande non trouvés.";
                exit();
            }
            // Calculer le total HT et TTC
            $totalHt = 0;
            foreach ($commande['details'] as $detail) {
                $totalHt += $detail['prix_public'] * $detail['quantite'];
            }
            $commande['total_ht'] = $totalHt;
            $commande['total_ttc'] = $totalHt * 1.2; // Exemple avec TVA de 20%
        }
        
        require __DIR__ . '/../Views/client/espaceClient.php';
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
                    $commandeModel->addCommandeProduit($commandeId, $produitId, $quantite, $montant); // Appel à la méthode
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
            header('Location: client.php?action=espaceClient'); // Rediriger vers l'espace client
            exit();
        } else {
            echo "Identifiants invalides.";
        }
        break;
    default:
        $produitController->afficherProduits();
        break;
}
?>


