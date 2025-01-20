<?php

class Admin {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAdminByUsername($username) {
        $query = $this->db->prepare("SELECT * FROM admins WHERE username = :username");
        $query->execute(['username' => $username]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($id, $newPassword) {
        $query = $this->db->prepare("UPDATE admins SET password = :password WHERE id = :id");
        return $query->execute(['password' => password_hash($newPassword, PASSWORD_DEFAULT), 'id' => $id]);
    }

    public function addAdmin($username, $hashedPassword) {
        $query = $this->db->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");
        return $query->execute(['username' => $username, 'password' => $hashedPassword]);
    }

    public function getAllAdmins() {
        $query = $this->db->query("SELECT * FROM admins");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteAdmin($id) {
        $query = $this->db->prepare("DELETE FROM admins WHERE id = :id");
        return $query->execute(['id' => $id]);
    }

    public function updateAdmin($id, $username, $hashedPassword) {
        $query = $this->db->prepare("UPDATE admins SET username = :username, password = :password WHERE id = :id");
        return $query->execute(['username' => $username, 'password' => $hashedPassword, 'id' => $id]);
    }
}
?> 