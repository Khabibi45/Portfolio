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
    $to = "camil.belmehdi@etu.iut-tlse3.fr"; // Updated to email from CV
    $subject = "New Contact from Portfolio: $name";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: noreply@portfolio.com";

    // Uncomment to actually send if server is configured
    // mail($to, $subject, $body, $headers);

    // Return success response for the UI
    http_response_code(200);
    echo json_encode(["status" => "success", "message" => "Message sent successfully! (Simulated)"]);
} else {
    http_response_code(403);
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
