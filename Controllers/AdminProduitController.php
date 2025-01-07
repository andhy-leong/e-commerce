<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../Models/Produit.php';

class AdminProduitController {
    private $produitModel;
    
    public function __construct() {
        global $db;
        $this->produitModel = new Produit($db);
    }
    
    public function afficherProduits() {
        $produits = $this->produitModel->getAllProduits();
        require __DIR__ . '/../Views/admin/produits.php';
    }
    
    public function ajouterProduit($data) {
        if (!empty($data['reference']) && !empty($data['taille']) && !empty($data['couleur']) && !empty($data['prix_public']) && !empty($data['prix_achat']) && !empty($data['titre']) && !empty($data['descriptif']) && !empty($data['quantite_stock']) && !empty($data['provenance'])) {
            $this->produitModel->addProduit($data);
            header('Location: admin.php?action=afficherProduits');
            exit();
        } else {
            echo "Tous les champs sont requis.";
        }
    }
    
    public function supprimerProduit($id) {
        if ($this->produitModel->deleteProduit($id)) {
            header('Location: admin.php?action=afficherProduits');
            exit();
        } else {
            echo "Erreur lors de la suppression du produit.";
        }
    }
}
?>