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
        $this->clientModel->updateClientInfo($clientId, $data);
        header('Location: client.php?action=espaceClient');
        exit();
    }

    public function modifierMotDePasse($clientId, $ancienMotDePasse, $nouveauMotDePasse) {
        if ($this->clientModel->updateClientPassword($clientId, $ancienMotDePasse, $nouveauMotDePasse)) {
            echo "Mot de passe mis à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour du mot de passe.";
        }
    }
}
?>