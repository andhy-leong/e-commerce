<?php

require_once __DIR__ . '/../Models/Produit.php';

class ClientProduitController {
    private $produitModel;

    public function __construct() {
        global $db;
        $this->produitModel = new Produit($db);
    }

    public function afficherProduits($searchTerm = '', $sort = 'nom_asc') {
        $orderBy = 'titre';
        $direction = 'ASC';

        switch ($sort) {
            case 'nom_desc':
                $orderBy = 'titre';
                $direction = 'DESC';
                break;
            case 'prix_asc':
                $orderBy = 'prix_public';
                $direction = 'ASC';
                break;
            case 'prix_desc':
                $orderBy = 'prix_public';
                $direction = 'DESC';
                break;
            case 'mieux_notes':
                $orderBy = 'note';
                $direction = 'DESC';
                break;
        }

        if (!empty($searchTerm)) {
            $produits = $this->produitModel->searchProduits($searchTerm);
        } else {
            $produits = $this->produitModel->getAllProduitsSorted($orderBy, $direction);
        }

        require __DIR__ . '/../Views/client/produits.php';
    }

    public function getProduitById($id) {
        return $this->produitModel->getProduitById($id);
    }
}
?>