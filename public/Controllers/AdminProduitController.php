<?php

require_once __DIR__ . '/../Models/Produit.php';

class AdminProduitController {
    private $produitModel;
    
    public function __construct() {
        global $db;
        $this->produitModel = new Produit($db);
    }
    
    public function afficherProduits() {
        $produits = $this->produitModel->getAllProduits();
        require __DIR__ . '/../Views/admin/produits.php';
    }

    public function afficherFormulaireModification($id) {
        $produit = $this->produitModel->getProduitById($id);
        if (!$produit) {
            echo "Produit non trouvé.";
            exit;
        }
        require __DIR__ . '/../Views/admin/modifierProduit.php';
    }
    
    public function ajouterProduit($data) {
        // Logique pour l'ajout (peut aussi être mis à jour pour l'upload)
        if (!empty($data['reference']) && !empty($data['titre'])) {
            $this->produitModel->addProduit($data);
            $_SESSION['success_message'] = "Produit ajouté avec succès.";
            header('Location: admin.php?action=afficherProduits');
            exit();
        } else {
            echo "Tous les champs sont requis.";
        }
    }
    
    public function supprimerProduit($id) {
        $produit = $this->produitModel->getProduitById($id);
        if ($this->produitModel->deleteProduit($id)) {
            $_SESSION['success_message'] = "Le produit '" . htmlspecialchars($produit['titre']) . "' a été supprimé.";
            header('Location: admin.php?action=afficherProduits');
            exit();
        } else {
            echo "Erreur lors de la suppression du produit.";
        }
    }
    
    /**
     * Gère la mise à jour d'un produit, y compris l'upload d'image.
     * La fonction lit $_POST et $_FILES directement.
     */
    public function modifierProduit($produitId) {
        // 1. Récupérer les données texte depuis $_POST
        $data = [
            'reference' => $_POST['reference'] ?? '',
            'taille' => $_POST['taille'] ?? '',
            'couleur' => $_POST['couleur'] ?? '',
            'prix_public' => $_POST['prix_public'] ?? '',
            'prix_achat' => $_POST['prix_achat'] ?? '',
            'titre' => $_POST['titre'] ?? '',
            'descriptif' => $_POST['descriptif'] ?? '',
            'quantite_stock' => $_POST['quantite_stock'] ?? '',
            'provenance' => $_POST['provenance'] ?? ''
        ];

        // 2. Gérer l'upload de l'image
        // On garde l'ancienne image par défaut
        $newImagePath = $_POST['current_image'] ?? ''; 
        
        // Vérifier si un *nouveau* fichier a été envoyé
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            
            // Chemin de destination sur le serveur
            // __DIR__ est e-commerce/Controllers, donc ../public/Ressources/...
            $targetDir = __DIR__ . '/../public/Ressources/Vangovango/';

            // Validation simple du type de fichier
            $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array($imageFileType, $allowedTypes)) {
                // Créer un nom de fichier unique
                $uniqueName = uniqid() . '.' . $imageFileType;
                $targetFile = $targetDir . $uniqueName;

                // Tenter de déplacer le fichier
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    // Si réussi, on définit le *nouveau* chemin pour la BDD
                    // C'est le chemin CORRECT, relatif à public/
                    $newImagePath = 'Ressources/Vangovango/' . $uniqueName;
                    
                    // Optionnel : supprimer l'ancienne image du serveur si ce n'est pas l'image par défaut
                    // $oldImageServerPath = str_replace('../', __DIR__ . '/../public/', $_POST['current_image']);
                    // if (file_exists($oldImageServerPath) && $_POST['current_image'] != $newImagePath) {
                    //     unlink($oldImageServerPath);
                    // }

                } else {
                    $_SESSION['error_message'] = "Erreur lors de l'upload de l'image.";
                    header('Location: admin.php?action=afficherProduits');
                    exit();
                }
            } else {
                $_SESSION['error_message'] = "Type de fichier non autorisé (autorisés: jpg, jpeg, png, gif).";
                header('Location: admin.php?action=afficherProduits');
                exit();
            }
        }
        
        // 3. Ajouter le chemin final de l'image (nouveau ou ancien) aux données
        $data['image'] = $newImagePath;

        // 4. Mettre à jour le produit dans la BDD
        if ($this->produitModel->updateProduit($produitId, $data)) {
            $_SESSION['success_message'] = "Produit mis à jour avec succès.";
        } else {
            $_SESSION['error_message'] = "Erreur lors de la mise à jour du produit.";
        }
        header('Location: admin.php?action=afficherProduits');
        exit();
    }
    
    public function afficherBenefices() {
        $produits = $this->produitModel->getAllProduits();
        require __DIR__ . '/../Views/admin/comptabilite.php';
    }
}
?>