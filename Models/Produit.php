<?php

class Produit {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllProduits() {
        $query = $this->db->query("SELECT * FROM produits");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProduitsSorted($orderBy, $direction) {
        $allowedColumns = ['titre', 'prix_public', 'note'];
        $allowedDirections = ['ASC', 'DESC'];

        if (!in_array($orderBy, $allowedColumns) || !in_array($direction, $allowedDirections)) {
            throw new InvalidArgumentException("Invalid sorting parameters.");
        }

        $query = $this->db->query("SELECT * FROM produits ORDER BY $orderBy $direction");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchProduits($searchTerm) {
        $query = $this->db->prepare("SELECT * FROM produits WHERE titre LIKE :term OR descriptif LIKE :term");
        $query->execute(['term' => '%' . $searchTerm . '%']);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProduit($data) {
        $query = $this->db->prepare("INSERT INTO produits (reference, taille, couleur, prix_public, prix_achat, titre, descriptif, quantite_stock, image, icone, provenance) VALUES (:reference, :taille, :couleur, :prix_public, :prix_achat, :titre, :descriptif, :quantite_stock, :image, :icone, :provenance)");
        return $query->execute([
            'reference' => $data['reference'],
            'taille' => $data['taille'],
            'couleur' => $data['couleur'],
            'prix_public' => $data['prix_public'],
            'prix_achat' => $data['prix_achat'],
            'titre' => $data['titre'],
            'descriptif' => $data['descriptif'],
            'quantite_stock' => $data['quantite_stock'],
            'image' => $data['image'],
            'icone' => $data['icone'],
            'provenance' => $data['provenance']
        ]);
    }

    public function deleteProduit($id) {
        $query = $this->db->prepare("DELETE FROM produits WHERE identifiant = :id"); // Remplacez 'produit_id' par le nom correct de la colonne
        return $query->execute(['id' => $id]);
    }

    public function getProduitById($id) {
        // Assurez-vous que la colonne 'quantite_stock' est bien sélectionnée
        $query = $this->db->prepare("SELECT quantite_stock, reference, titre, prix_public FROM produits WHERE identifiant = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    // Autres méthodes existantes...
}
?>