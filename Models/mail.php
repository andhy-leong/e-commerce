<?php
function sendOrderConfirmation($clientEmail, $clientName, $orderDetails) {
    $subject = "Confirmation de votre commande";
    $message = "Bonjour $clientName,\n\nMerci pour votre commande ! Voici les détails :\n$orderDetails\n\nCordialement,\nVotre entreprise";
    $headers = "From: vangovibes@gmail.com\r\n" .
               "Reply-To: vangovibes@gmail.com\r\n" .
               "X-Mailer: PHP/" . phpversion();

    if (mail($clientEmail, $subject, $message, $headers)) {
        echo "E-mail envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi de l'e-mail.";
    }
}
?> 