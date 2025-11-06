<?php


class Commande {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCommandes() {
        $query = $this->db->query("SELECT * FROM commandes");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommandeDetails($commandeId) {
        $query = $this->db->prepare("
            SELECT c.numero_commande, c.date, c.client_id, cp.quantite, p.titre, p.prix_public
            FROM commandes c
            JOIN commande_produits cp ON c.id = cp.commande_id
            JOIN produits p ON cp.produit_id = p.identifiant
            WHERE c.id = :commande_id
        ");
        $query->execute(['commande_id' => $commandeId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCommande($clientId, $totalHt, $totalTtc) {
        // Vérifiez si le client existe
        $clientQuery = $this->db->prepare("SELECT COUNT(*) FROM clients WHERE id = :client_id");
        $clientQuery->execute(['client_id' => $clientId]);
        $clientExists = $clientQuery->fetchColumn();

        if (!$clientExists) {
            throw new Exception("Le client avec l'ID $clientId n'existe pas.");
        }

        // Ajoutez la commande
        $query = $this->db->prepare("INSERT INTO commandes (client_id, date, montant, total_ht, total_ttc, statut) VALUES (:client_id, NOW(), :montant, :total_ht, :total_ttc, 'En attente')");
        $query->execute([
            'client_id' => $clientId,
            'montant' => $totalTtc,
            'total_ht' => $totalHt,
            'total_ttc' => $totalTtc
        ]);
        $commandeId = $this->db->lastInsertId();

        // Générer un numéro de commande basé sur l'ID
        $numeroCommande = 'CMD-' . str_pad($commandeId, 6, '0', STR_PAD_LEFT);

        // Mettre à jour la commande avec le numéro de commande
        $updateQuery = $this->db->prepare("UPDATE commandes SET numero_commande = :numero_commande WHERE id = :id");
        $updateQuery->execute([
            'numero_commande' => $numeroCommande,
            'id' => $commandeId
        ]);

        // Récupérer les informations du client pour l'e-mail
        $clientInfo = $this->getClientInfo($clientId);
        $orderDetails = "Numéro de commande: $numeroCommande<br>Montant total: $totalTtc €"; // Ajoutez d'autres détails si nécessaire

        return $commandeId;
    }

    public function addCommandeProduit($commandeId, $produitId, $quantite, $montant) {
        // Ajoutez la commande produit
        $query = $this->db->prepare("INSERT INTO commande_produits (commande_id, produit_id, quantite, montant) VALUES (:commande_id, :produit_id, :quantite, :montant)");
        $query->execute([
            'commande_id' => $commandeId,
            'produit_id' => $produitId,
            'quantite' => $quantite,
            'montant' => $montant
        ]);

        // Mettre à jour le stock du produit
        $produitModel = new Produit($this->db); // Assurez-vous d'importer le modèle Produit
        $produitModel->updateStock($produitId, $quantite); // Soustraire la quantité du stock

        return $query->rowCount(); // Retourner le nombre de lignes affectées
    }

    public function getClientInfo($clientId) {
        $query = $this->db->prepare("SELECT nom, prenom, email, telephone, adresse FROM clients WHERE id = :client_id");
        $query->execute(['client_id' => $clientId]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteClientOrders($clientId) {
        // Récupérer toutes les commandes du client
        $query = $this->db->prepare("SELECT id FROM commandes WHERE client_id = :client_id");
        $query->execute(['client_id' => $clientId]);
        $commandes = $query->fetchAll(PDO::FETCH_ASSOC);

        // Supprimer les produits associés à chaque commande
        foreach ($commandes as $commande) {
            $this->deleteCommandeProduits($commande['id']);
        }

        // Supprimer les commandes
        $query = $this->db->prepare("DELETE FROM commandes WHERE client_id = :client_id");
        return $query->execute(['client_id' => $clientId]);
    }

    public function deleteCommandeProduits($commandeId) {
        $query = $this->db->prepare("DELETE FROM commande_produits WHERE commande_id = :commande_id");
        return $query->execute(['commande_id' => $commandeId]);
    }

    public function getCommandeById($commandeId) {
        $query = $this->db->prepare("SELECT * FROM commandes WHERE id = :commande_id");
        $query->execute(['commande_id' => $commandeId]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getClientOrders($clientId) {
        $query = $this->db->prepare("SELECT * FROM commandes WHERE client_id = :client_id");
        $query->execute(['client_id' => $clientId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommandesByClientId($clientId) {
        $query = "SELECT * FROM commandes WHERE client_id = :client_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':client_id', $clientId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>