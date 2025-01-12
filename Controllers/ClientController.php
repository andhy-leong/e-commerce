<?php

require_once __DIR__ . '/../config/config.php';
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
        echo '<pre>';
        print_r($data); // Affichez les données reçues
        echo '</pre>';
        
        if ($this->clientModel->updateClientInfo($clientId, $data)) {
            header('Location: client.php?action=espaceClient');
            exit();
        } else {
            echo "Erreur lors de la mise à jour des informations.";
        }
    }

    public function modifierMotDePasse($clientId, $ancienMotDePasse, $nouveauMotDePasse) {
        if ($this->clientModel->updateClientPassword($clientId, $ancienMotDePasse, $nouveauMotDePasse)) {
            echo "Mot de passe mis à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour du mot de passe.";
        }
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

}
?>

