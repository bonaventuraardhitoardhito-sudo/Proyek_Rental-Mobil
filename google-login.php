<?php

session_start();

require_once __DIR__ . '/google-config.php';

$from = isset($_GET['from']) ? $_GET['from'] : 'login';

if ($from !== 'login' && $from !== 'register') {
    $from = 'login';
}

$_SESSION['google_from'] = $from;

$state = bin2hex(random_bytes(16));

$_SESSION['google_oauth_state'] = $state;

$client->setState($state);

$authUrl = $client->createAuthUrl();

header('Location: ' . $authUrl);
exit;