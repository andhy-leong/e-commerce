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

    public function afficherDashboard() {
        // Logique pour afficher le tableau de bord
        require __DIR__ . '/../Views/admin/dashboard.php';
    }

    public function afficherClients() {
        $clients = $this->clientModel->getAllClients(); // Récupérer tous les clients
        foreach ($clients as &$client) {
            $client['commandes'] = $this->commandeModel->getCommandesByClientId($client['id']); // Récupérer toutes les commandes pour chaque client
        }
        var_dump($clients); // Ajoutez ceci pour voir les données
        require __DIR__ . '/../Views/admin/clients.php'; // Afficher la vue
    }

    public function login() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $admin = $this->getAdminByUsername($username);
        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            header('Location: admin.php?action=afficherDashboard');
            exit();
        } else {
            // Ajoutez le message d'erreur dans la session
            $_SESSION['error_message'] = "Nom d'utilisateur ou mot de passe incorrect.";
            header('Location: admin.php?action=loginForm');
            exit();
        }
    }
}
?> 