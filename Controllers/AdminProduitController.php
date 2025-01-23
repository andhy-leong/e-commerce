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
    
    public function modifierQuantite() {
        $produitId = $_POST['id'] ?? null;
        $quantite = $_POST['quantite'] ?? 0;
    
        echo '<pre>';
        echo "Produit ID: $produitId\n";
        echo "Quantité à ajouter: $quantite\n";
        echo '</pre>';
    
        if ($produitId && $quantite > 0) {
            if ($this->produitModel->updateStock($produitId, $quantite)) {
                header('Location: admin.php?action=afficherProduits');
                exit();
            } else {
                echo "Erreur lors de la mise à jour du stock.";
            }
        } else {
            echo "Erreur : ID de produit ou quantité invalide.";
        }
    }
    
    public function modifierProduit($produitId, $data) {
        if ($this->produitModel->updateProduit($produitId, $data)) {
            $_SESSION['success_message'] = "Produit mis à jour avec succès.";
        } else {
            $_SESSION['error_message'] = "Erreur lors de la mise à jour du produit.";
        }
        header('Location: admin.php?action=afficherProduits');
        exit();
    }
    
    public function afficherBenefices() {
        $produits = $this->produitModel->getAllProduits();
        require __DIR__ . '/../Views/admin/comptabilite.php';
    }
}
?>