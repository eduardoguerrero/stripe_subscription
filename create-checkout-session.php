<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51LGbvGGvNovx19DmEuAioxleq3yUWch5fBhSN5hPr72mB1p9Cy86Y7e0r9gaq0geBSOb70caQyCzPVbLvReLmwWF00GUYYyqxI');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:5243/public';

try {
    $prices = \Stripe\Price::all([
        // retrieve lookup_key from form data POST body
        'lookup_keys' => [$_POST['lookup_key']],
        'expand' => ['data.product']
    ]);


    $checkout_session = \Stripe\Checkout\Session::create([
        'line_items' => [[
            'price' => $prices->data[0]->id,
            'quantity' => 1,
        ]],
        'mode' => 'subscription',
        'success_url' => $YOUR_DOMAIN . '/success.html?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
    ]);

    header("HTTP/1.1 303 See Other");
    header("Location: " . $checkout_session->url);
} catch (Error $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
