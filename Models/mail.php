<?php

function sendOrderConfirmation($clientEmail, $clientName, $orderDetails) {
    $url = 'https://api.sendgrid.com/v3/mail/send';
    $apiKey = 'mlsn.35a86079712a338fb0048899cd76a752ae305390b8c0fb6e7ca19ed98261326f'; // Remplacez par votre clé API SendGrid

    $data = [
        'personalizations' => [
            [
                'to' => [
                    ['email' => $clientEmail, 'name' => $clientName]
                ],
                'subject' => 'Confirmation de votre commande'
            ]
        ],
        'from' => ['email' => 'vangovibes@gmail.com', 'name' => 'VangoVibes'],
        'content' => [
            [
                'type' => 'text/html',
                'value' => "Bonjour $clientName,<br><br>Merci pour votre commande ! Voici les détails :<br>$orderDetails<br><br>Cordialement,<br>Votre entreprise"
            ]
        ]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Erreur lors de l\'envoi de l\'e-mail : ' . curl_error($ch);
    } else {
        echo 'E-mail envoyé avec succès.';
    }
    curl_close($ch);
}
?>