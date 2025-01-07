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
        foreach ($clients as &$client) {
            $client['commandes'] = $this->clientModel->getClientOrders($client['id']);
        }
        require __DIR__ . '/../Views/admin/clients.php';
    }
    
    public function ajouterClient($data) {
        // Logique pour ajouter un client...
    }
    
    public function supprimerClient($id) {
        // Logique pour supprimer un client...
    }
    
    public function supprimerCommande($commandeId) {
        // Logique pour supprimer une commande...
    }
}
?>