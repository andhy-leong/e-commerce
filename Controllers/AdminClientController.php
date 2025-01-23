<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../Models/Client.php';
require_once __DIR__ . '/../Models/Commande.php';

class AdminClientController {
    private $clientModel;
    private $commandeModel;
    
    public function __construct() {
        global $db;
        $this->clientModel = new Client($db);
        $this->commandeModel = new Commande($db);
    }
    
    public function afficherClients($searchTerm = '', $sort = 'nom_asc') {
        $clients = $this->clientModel->getAllClients();
        $clientsAssociatifs = [];
        foreach ($clients as $client) {
            $clientsAssociatifs[$client['id']] = $client; // Utilisez l'ID comme clé
        }
        require __DIR__ . '/../Views/admin/clients.php';
    }
    
    public function ajouterClient($data) {
        if (!empty($data['nom']) && !empty($data['prenom']) && !empty($data['email']) && !empty($data['mot_de_passe']) && !empty($data['telephone']) && !empty($data['adresse'])) {
            // Vérifiez si l'email existe déjà
            if ($this->clientModel->emailExists($data['email'])) {
                echo "L'email existe déjà.";
                return;
            }

            // Hachage du mot de passe
            $data['mot_de_passe'] = password_hash($data['mot_de_passe'], PASSWORD_DEFAULT);

            $this->clientModel->addClient($data);
            header('Location: admin.php?action=afficherClients');
            exit();
        } else {
            echo "Tous les champs sont requis.";
        }
    }
    
    public function supprimerClient($id) {
        // Supprimer d'abord les commandes associées
        $this->commandeModel->deleteClientOrders($id);
        
        // Ensuite, supprimer le client
        if ($this->clientModel->deleteClient($id)) {
            header('Location: admin.php?action=afficherClients');
            exit();
        } else {
            echo "Erreur lors de la suppression du client.";
        }
    }
    
    public function supprimerCommande($commandeId) {
        // Logique pour supprimer une commande...
    }
}
?>