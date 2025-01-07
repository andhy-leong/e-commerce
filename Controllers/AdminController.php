<?php

require_once __DIR__ . '/../Models/Admin.php';

class AdminController {
    private $adminModel;

    public function __construct() {
        global $db;
        $this->adminModel = new Admin($db);
    }

    public function afficherAdmins() {
        $admins = $this->adminModel->getAllAdmins();
        require __DIR__ . '/../Views/admin/admins.php';
    }

    public function ajouterAdmin($username, $password) {
        if ($this->adminModel->addAdmin($username, $password)) {
            header('Location: admin.php?action=afficherAdmins');
            exit();
        } else {
            echo "Erreur lors de l'ajout de l'administrateur.";
        }
    }

    public function supprimerAdmin($id) {
        if ($this->adminModel->deleteAdmin($id)) {
            header('Location: admin.php?action=afficherAdmins');
            exit();
        } else {
            echo "Erreur lors de la suppression de l'administrateur.";
        }
    }
}
?> 