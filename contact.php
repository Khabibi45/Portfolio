<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect specific inputs
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $message = htmlspecialchars(strip_tags($_POST['message']));

    // Validation (Basic)
    if (empty($name) || empty($email) || empty($message)) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Please fill all fields."]);
        exit;
    }

    // Compose Email (For local XAMPP this might not send without SMTP config, 
    // but we simulate success for the portfolio requirement)
    $to = "camil81400@gmail.com";
    $subject = "Portfolio reponse";
    $body = "Nom: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";

    if (mail($to, $subject, $body, $headers)) {
        http_response_code(200);
        echo json_encode(["status" => "success", "message" => "Message envoyé avec succès."]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Erreur lors de l'envoi du message."]);
    }
} else {
    http_response_code(403);
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
