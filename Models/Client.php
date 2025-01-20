<?php

class Client {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllClients() {
        $query = $this->db->query("SELECT * FROM clients ORDER BY id ASC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function emailExists($email) {
        $query = $this->db->prepare("SELECT COUNT(*) FROM clients WHERE email = :email");
        $query->execute(['email' => $email]);
        return $query->fetchColumn() > 0;
    }

    public function addClient($data) {
        $query = $this->db->prepare("INSERT INTO clients (nom, prenom, email, mot_de_passe, telephone, adresse) VALUES (:nom, :prenom, :email, :mot_de_passe, :telephone, :adresse)");
        return $query->execute($data);
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

    public function updateClientInfo($clientId, $data) {
        $query = $this->db->prepare("UPDATE clients SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, adresse = :adresse WHERE id = :id");
        return $query->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'adresse' => $data['adresse'],
            'id' => $clientId
        ]);
    }

    public function updateClientPassword($clientId, $ancienMotDePasse, $nouveauMotDePasse) {
        $client = $this->getClientById($clientId);
        if ($client && password_verify($ancienMotDePasse, $client['mot_de_passe'])) {
            $hashedPassword = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);
            $query = $this->db->prepare("UPDATE clients SET mot_de_passe = :mot_de_passe WHERE id = :id");
            return $query->execute(['mot_de_passe' => $hashedPassword, 'id' => $clientId]);
        }
        return false;
    }

    // Autres méthodes...
}
?>