<?php

require_once __DIR__ . '/../Models/Client.php';

class ClientController {
    private $clientModel;

    public function __construct() {
        global $db;
        $this->clientModel = new Client($db);
    }

    public function afficherEspaceClient($clientId) {
        $client = $this->clientModel->getClientById($clientId);
        $commandes = $this->clientModel->getClientOrders($clientId);
        
        require __DIR__ . '/../Views/client/espaceClient.php';
    }

    public function modifierInfos($clientId, $data) {
        if ($this->clientModel->updateClientInfo($clientId, $data)) {
            $_SESSION['success_message'] = "Vos informations personnelles ont été mises à jour avec succès.";
        } else {
            $_SESSION['error_message'] = "Erreur lors de la mise à jour des informations.";
        }
        header('Location: client.php?action=espaceClient');
        exit();
    }

    public function modifierMotDePasse($clientId, $ancienMotDePasse, $nouveauMotDePasse) {
        if ($this->clientModel->updateClientPassword($clientId, $ancienMotDePasse, $nouveauMotDePasse)) {
            $_SESSION['success_message'] = "Mot de passe mis à jour avec succès.";
        } else {
            $_SESSION['error_message'] = "Erreur lors de la mise à jour du mot de passe.";
        }
        header('Location: client.php?action=espaceClient');
        exit();
    }

    public function login($email, $motDePasse) {
        $client = $this->clientModel->getClientByEmail($email);
        
        if ($client && password_verify($motDePasse, $client['mot_de_passe'])) {
            // Connexion réussie, définissez les variables de session
            $_SESSION['client_id'] = $client['id'];
            $_SESSION['client_nom'] = $client['nom'];
            $_SESSION['client_prenom'] = $client['prenom'];
            
            // Débogage pour vérifier les variables de session
            echo '<pre>';
            print_r($_SESSION);
            echo '</pre>';
            
            // Redirigez vers l'espace client
            header('Location: client.php?action=afficherProduits');
            exit();
        } else {
            echo "L'adresse mail ou le mot de passe est incorrect";
        }
    }

    public function afficherProduit() {
        if (isset($_GET['id'])) {
            $produitId = $_GET['id'];
            $produit = $this->produitModel->getProduitById($produitId); // Assurez-vous d'avoir cette méthode dans votre modèle
            require __DIR__ . '/../Views/client/produits.pdp.php'; // Afficher la vue des détails du produit
        } else {
            // Gérer le cas où l'ID du produit n'est pas fourni
            header('Location: client.php?action=afficherProduits'); // Rediriger vers la liste des produits
            exit();
        }
    }

}
?>

