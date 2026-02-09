<?php

use app\controllers\ApiExampleController;

$app = Flight::app();
$controller = new ApiExampleController($app);

// ────────────────────────────────────────────────
// Page d'accueil = formulaire de login (forms.html)
// ────────────────────────────────────────────────
Flight::route('GET /', function () {
    $path = __DIR__ . '/../views/forms.html';
    header('Content-Type: text/html; charset=utf-8');
    if (file_exists($path)) {
        echo file_get_contents($path);
    } else {
        echo '<h1>Formulaire de login introuvable (views/forms.html)</h1>';
    }
});

// ────────────────────────────────────────────────
// Dashboard (après connexion réussie)
// ────────────────────────────────────────────────
Flight::route('GET /dashboard', function () {
    $path = __DIR__ . '/../views/index.php';
    header('Content-Type: text/html; charset=utf-8');
    if (file_exists($path)) {
        echo file_get_contents($path);
    } else {
        echo '<h1>Dashboard introuvable (views/index.php)</h1>';
    }
});

// ────────────────────────────────────────────────
// Route dynamique pour les autres pages (messages, login, etc.)
// ────────────────────────────────────────────────
Flight::route('GET /@page', function ($page) {
    $extensions = ['.html', '.php'];
    foreach ($extensions as $ext) {
        $path = __DIR__ . '/../views/' . $page . $ext;
        if (file_exists($path)) {
            header('Content-Type: text/html; charset=utf-8');
            echo file_get_contents($path);
            return;
        }
    }
    Flight::notFound('<h1>Page non trouvée : ' . htmlspecialchars($page) . '</h1>');
});

// ────────────────────────────────────────────────
// Routes API
// ────────────────────────────────────────────────
Flight::route('POST /api/login', [$controller, 'login']);
Flight::route('GET /api/users', [$controller, 'getUsers']);
Flight::route('GET /api/users/@id', [$controller, 'getUser']);
Flight::route('POST /api/users/@id', [$controller, 'updateUser']);

// ────────────────────────────────────────────────
// Routes de test / debug
// ────────────────────────────────────────────────
Flight::route('GET /test-login', function () {
    echo '<pre>Route /api/login existe ? Oui !</pre>';
});

Flight::route('GET /test-db', function() use ($app) {
    try {
        $db = $app->db();
        $version = $db->fetchColumn("SELECT VERSION()");
        $app->json([
            'status' => 'ok',
            'version' => $version,
            'driver' => $db->getAttribute(PDO::ATTR_DRIVER_NAME),
        ]);
    } catch (Exception $ex) {
        $app->json([
            'status' => 'error',
            'message' => $ex->getMessage(),
        ], 500);
    }
});