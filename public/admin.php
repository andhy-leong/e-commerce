<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Durée d'inactivité en secondes (5 minutes)
$inactivityLimit = 300;

// Vérifier l'inactivité
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $inactivityLimit) {
    session_unset();     // Supprimer les variables de session
    session_destroy();   // Détruire la session
    header('Location: admin.php?action=loginForm');
    exit();
}

$_SESSION['last_activity'] = time(); // Mettre à jour l'heure de la dernière activité

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../Controllers/AdminClientController.php';
require_once __DIR__ . '/../Controllers/AdminProduitController.php';
require_once __DIR__ . '/../Controllers/AdminController.php';
require_once __DIR__ . '/../Controllers/AdminCommandeController.php'; // Ajout du contrôleur des commandes

$clientController = new AdminClientController();
$produitController = new AdminProduitController();
$adminController = new AdminController();
$commandeController = new AdminCommandeController(); // Instanciation du contrôleur des commandes

$action = $_GET['action'] ?? '';

if ($action === 'login') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Logique d'authentification mise à jour
    if ($username === 'andhy' && $password === 'admin') {
        $_SESSION['logged_in'] = true;
        header('Location: admin.php');
        exit();
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect. Veuillez réessayer dans 2 secondes.";
        header('Refresh: 2; URL=admin.php?action=loginForm');
        exit();
    }
}

if (!isset($_SESSION['logged_in']) && $action !== 'loginForm' && $action !== 'login') {
    header('Location: admin.php?action=loginForm');
    exit();
}

switch ($action) {
    case 'loginForm':
        require __DIR__ . '/../Views/admin/login.php';
        break;
    case 'afficherClients':
        $searchTerm = $_GET['search'] ?? '';
        $orderBy = $_GET['orderBy'] ?? 'nom';
        $direction = $_GET['direction'] ?? 'ASC';
        $clientController->afficherClients($searchTerm, $orderBy, $direction);
        break;
    case 'ajouterClientForm':
        require __DIR__ . '/../Views/admin/ajouterClient.php';
        break;
    case 'ajouterClient':
        $clientController->ajouterClient($_POST);
        break;
    case 'supprimerClient':
        $clientController->supprimerClient($_GET['id']);
        break;
    case 'afficherProduits':
        $produitController->afficherProduits();
        break;
    case 'ajouterProduitForm':
        require __DIR__ . '/../Views/admin/ajouterProduit.php';
        break;
    case 'ajouterProduit':
        $produitController->ajouterProduit($_POST);
        break;
    case 'supprimerProduit':
        $produitController->supprimerProduit($_GET['id']);
        break;
    case 'modifierMotDePasseForm':
        require __DIR__ . '/../Views/admin/modifierMotDePasse.php';
        break;
    case 'modifierMotDePasse':
        $adminController->modifierMotDePasse($_SESSION['admin_id'], $_POST['ancienMotDePasse'], $_POST['nouveauMotDePasse']);
        break;
    case 'ajouterAdminForm':
        require __DIR__ . '/../Views/admin/ajouterAdmin.php';
        break;
    case 'ajouterAdmin':
        $adminController->ajouterAdmin($_POST['username'], $_POST['password']);
        break;
    case 'logout':
        session_unset();     // Supprimer les variables de session
        session_destroy();   // Détruire la session
        header('Location: admin.php?action=loginForm');
        exit();
    case 'afficherAdmins':
        $adminController->afficherAdmins();
        break;
    case 'supprimerAdmin':
        $adminController->supprimerAdmin($_GET['id']);
        break;
    case 'afficherCommandes': // Nouvelle action pour afficher les commandes
        $commandeController->afficherCommandes();
        break;
    case 'afficherDetailsCommande': // Nouvelle action pour afficher les détails d'une commande
        $commandeId = $_GET['id'] ?? null;
        if ($commandeId) {
            $commandeController->afficherDetailsCommande($commandeId);
        }
        break;
    default:
        require __DIR__ . '/../Views/admin/dashboard.php';
        break;
}
?>