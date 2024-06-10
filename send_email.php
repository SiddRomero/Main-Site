<?php
// Replace 'YOUR_KLAVIYO_API_KEY' with your Klaviyo API key
$api_key = 'YOUR_KLAVIYO_API_KEY';
$list_id = 'YOUR_KLAVIYO_LIST_ID'; // Replace with your Klaviyo list ID

// Email address to send the email to
$recipient_email = 'recipient@example.com';

// Prepare data to send to Klaviyo API
$data = array(
    'api_key' => $api_key,
    'email' => $recipient_email,
    'list_id' => $list_id
);

// Convert data to JSON format
$json_data = json_encode($data);

// Send request to Klaviyo API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://a.klaviyo.com/api/v2/list/'.$list_id.'/subscribe');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($json_data)
));
$response = curl_exec($ch);
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_status == 200) {
    echo "Email sent successfully!";
} else {
    echo "Email sending failed. HTTP status code: " . $http_status;
}
?>
