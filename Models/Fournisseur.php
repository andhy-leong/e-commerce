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
    
    // Méthodes pour ajouter, modifier, supprimer des fournisseurs...
}
?>