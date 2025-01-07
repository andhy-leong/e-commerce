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
            SELECT c.numero_commande, c.date, cp.quantite, p.titre, p.prix_public
            FROM commandes c
            JOIN commande_produits cp ON c.id = cp.commande_id
            JOIN produits p ON cp.produit_id = p.identifiant
            WHERE c.id = :commande_id
        ");
        $query->execute(['commande_id' => $commandeId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCommande($clientId, $totalHt, $totalTtc) {
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

        return $commandeId;
    }

    public function addCommandeProduit($commandeId, $produitId, $quantite, $montant) {
        $query = $this->db->prepare("INSERT INTO commande_produits (commande_id, produit_id, quantite, montant) VALUES (:commande_id, :produit_id, :quantite, :montant)");
        return $query->execute([
            'commande_id' => $commandeId,
            'produit_id' => $produitId,
            'quantite' => $quantite,
            'montant' => $montant
        ]);
    }

    // Autres méthodes...
}
?>