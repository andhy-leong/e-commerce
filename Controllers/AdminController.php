<?php

require_once __DIR__ . '/../Models/Admin.php';

class AdminController {
    private $adminModel;

    public function __construct() {
        global $db;
        $this->adminModel = new Admin($db);
    }

    public function getAdminByUsername($username) {
        return $this->adminModel->getAdminByUsername($username);
    }

    public function afficherAdmins() {
        $admins = $this->adminModel->getAllAdmins();
        require __DIR__ . '/../Views/admin/admins.php';
    }

    public function ajouterAdmin($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($this->adminModel->addAdmin($username, $hashedPassword)) {
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

    public function modifierAdmin($adminId, $username, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        if ($this->adminModel->updateAdmin($adminId, $username, $hashedPassword)) {
            $_SESSION['success_message'] = "Informations de l'administrateur mises à jour avec succès.";
        } else {
            $_SESSION['error_message'] = "Erreur lors de la mise à jour des informations de l'administrateur.";
        }
        header('Location: admin.php?action=afficherAdmins');
        exit();
    }
}
?> 