<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../Models/Commande.php';

class AdminCommandeController {
    private $commandeModel;

    public function __construct() {
        global $db;
        $this->commandeModel = new Commande($db);
    }

    public function afficherCommandes() {
        $commandes = $this->commandeModel->getAllCommandes();
        require __DIR__ . '/../Views/admin/commandes.php';
    }

    public function afficherDetailsCommande($commandeId) {
        $details = $this->commandeModel->getCommandeDetails($commandeId);
        $clientInfo = $this->commandeModel->getClientInfo($details[0]['client_id']);
        require __DIR__ . '/../Views/admin/detailsCommande.php';
    }
}
?>