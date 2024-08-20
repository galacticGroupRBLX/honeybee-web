<?php
// submit.php

// Replace with your webhook URL
$webhook_url = 'https://discord.com/api/webhooks/1275603213143249007/rZaCMWwJ0l0gMK7UNoA3Ynpjxbo1zgLOyR3F0R_iJ2ZZHB1FazvGgUb1o5ujf5Ooxe2u';

// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['email'])) {
    $email = $data['email'];

    // Prepare the payload for the webhook
    $payload = json_encode([
        'content' => "New signup: $email"
    ]);

    // Send the request to the webhook
    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    $response = curl_exec($ch);
    curl_close($ch);

    // Respond to the frontend
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid data']);
}
?>
