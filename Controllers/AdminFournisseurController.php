<?php

require __DIR__ . '/../config/config.php';

class AdminFournisseurController {
    private $fournisseurModel;
    
    public function __construct() {
        global $db; // Utiliser la connexion globale
        $this->fournisseurModel = new Fournisseur($db);
    }
    
    public function afficherFournisseurs() {
        $fournisseurs = $this->fournisseurModel->getAllFournisseurs();
        require 'Views/admin/fournisseurs.php';
    }
    
    // Autres méthodes pour gérer les fournisseurs...
}
?>