<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
// This is your real test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51LGbvGGvNovx19DmEuAioxleq3yUWch5fBhSN5hPr72mB1p9Cy86Y7e0r9gaq0geBSOb70caQyCzPVbLvReLmwWF00GUYYyqxI');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:5243/public/success.html';
try {
    $checkout_session = \Stripe\Checkout\Session::retrieve($_POST['session_id']);
    $return_url = $YOUR_DOMAIN;

    // Authenticate your user.
    $session = \Stripe\BillingPortal\Session::create([
        'customer' => $checkout_session->customer,
        'return_url' => $return_url,
    ]);
    header("HTTP/1.1 303 See Other");
    header("Location: " . $session->url);
} catch (Error $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
