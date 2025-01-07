<?php

class Client {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllClients() {
        $query = $this->db->query("SELECT * FROM clients");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addClient($data) {
        $query = $this->db->prepare("INSERT INTO clients (nom, prenom, email, mot_de_passe, telephone, adresse) VALUES (:nom, :prenom, :email, :mot_de_passe, :telephone, :adresse)");
        return $query->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'mot_de_passe' => $data['mot_de_passe'],
            'telephone' => $data['telephone'],
            'adresse' => $data['adresse']
        ]);
    }

    public function deleteClient($id) {
        $query = $this->db->prepare("DELETE FROM clients WHERE id = :id");
        return $query->execute(['id' => $id]);
    }

    public function getClientOrders($clientId) {
        $query = $this->db->prepare("SELECT * FROM commandes WHERE client_id = :client_id");
        $query->execute(['client_id' => $clientId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientById($id) {
        $query = $this->db->prepare("SELECT * FROM clients WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getClientByEmail($email) {
        $query = $this->db->prepare("SELECT * FROM clients WHERE email = :email");
        $query->execute(['email' => $email]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Autres méthodes...
}
?>