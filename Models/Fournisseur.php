<?php

class Fournisseur {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getAllFournisseurs() {
        $query = $this->db->query("SELECT * FROM fournisseurs");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function addFournisseur($data) {
        $query = $this->db->prepare("INSERT INTO fournisseurs (nom, adresse, email, telephone, produits_vendus) VALUES (:nom, :adresse, :email, :telephone, :produits_vendus)");
        return $query->execute($data);
    }
    
    public function deleteFournisseur($id) {
        $query = $this->db->prepare("DELETE FROM fournisseurs WHERE id = :id");
        return $query->execute(['id' => $id]);
    }
    
    public function getFournisseurById($id) {
        $query = $this->db->prepare("SELECT * FROM fournisseurs WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updateFournisseur($id, $data) {
        $query = $this->db->prepare("UPDATE fournisseurs SET nom = :nom, adresse = :adresse, email = :email, telephone = :telephone, produits_vendus = :produits_vendus WHERE id = :id");
        $data['id'] = $id; // Ajoutez l'ID au tableau de données
        return $query->execute($data);
    }
    
    // Méthodes pour ajouter, modifier, supprimer des fournisseurs...
}
?>