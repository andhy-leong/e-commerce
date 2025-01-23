<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../Models/Fournisseur.php';

class AdminFournisseurController {
    private $fournisseurModel;
    
    public function __construct() {
        global $db; // Utiliser la connexion globale
        $this->fournisseurModel = new Fournisseur($db);
    }
    
    public function afficherFournisseurs() {
        $fournisseurs = $this->fournisseurModel->getAllFournisseurs();
        require __DIR__ . '/../Views/admin/fournisseurs.php';
    }
    
    public function ajouterFournisseur($data) {
        if (!empty($data['nom']) && !empty($data['adresse']) && !empty($data['email']) && !empty($data['telephone'])) {
            $this->fournisseurModel->addFournisseur($data);
            header('Location: admin.php?action=afficherFournisseurs');
            exit();
        } else {
            echo "Tous les champs sont requis.";
        }
    }
    
    public function supprimerFournisseur($id) {
        $fournisseur = $this->fournisseurModel->getFournisseurById($id);
        if ($this->fournisseurModel->deleteFournisseur($id)) {
            $_SESSION['success_message'] = "Le fournisseur " . htmlspecialchars($fournisseur['nom']) . " a été supprimé avec succès.";
            header('Location: admin.php?action=afficherFournisseurs');
            exit();
        } else {
            echo "Erreur lors de la suppression du fournisseur.";
        }
    }
    
    public function modifierFournisseurForm($id) {
        $fournisseur = $this->fournisseurModel->getFournisseurById($id);
        require __DIR__ . '/../Views/admin/modifierFournisseur.php';
    }
    
    public function modifierFournisseur($id, $data) {
        if (!empty($data['nom']) && !empty($data['adresse']) && !empty($data['email']) && !empty($data['telephone']) && !empty($data['produits_vendus'])) {
            $this->fournisseurModel->updateFournisseur($id, $data);
            $_SESSION['success_message'] = "Les informations de " . htmlspecialchars($data['nom']) . " ont bien été mises à jour.";
            header('Location: admin.php?action=afficherFournisseurs');
            exit();
        } else {
            echo "Tous les champs sont requis.";
        }
    }
    
    // Autres méthodes pour gérer les fournisseurs...
}
?>