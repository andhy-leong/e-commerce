<?php


function sendOrderConfirmation($clientEmail, $clientName, $orderDetails) {
    $mail = new PHPMailer(true);
    
    try {
        // Configuration du serveur
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Remplacez par votre serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com'; // Votre adresse e-mail
        $mail->Password = 'your_password'; // Votre mot de passe
        $mail->SMTPSecure = 'tls'; // ou 'ssl'
        $mail->Port = 587; // ou 465 pour SSL

        // Destinataires
        $mail->setFrom('your_email@example.com', 'Votre Entreprise');
        $mail->addAddress($clientEmail, $clientName);

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Confirmation de votre commande';
        $mail->Body    = "Bonjour $clientName,<br><br>Merci pour votre commande ! Voici les détails :<br>$orderDetails<br><br>Cordialement,<br>Votre entreprise";

        $mail->send();
        echo 'E-mail envoyé avec succès.';
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'e-mail. Mailer Error: {$mail->ErrorInfo}";
    }
}
?> 