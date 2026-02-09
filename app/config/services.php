<?php

use flight\Engine;
use flight\database\PdoWrapper;
use flight\debug\database\PdoQueryCapture;
use flight\debug\tracy\TracyExtensionLoader;
use Tracy\Debugger;

/*********************************************
 *         FlightPHP Service Setup           *
 *********************************************
 * This file registers services and integrations
 * for your FlightPHP application.
 *
 * @var array  $config  From config.php
 * @var Engine $app     FlightPHP app instance
 **********************************************/

// ────────────────────────────────────────────────
// Tracy Debugger (tu l'as déjà bien configuré)
Debugger::enable(); // Auto-detects environment
Debugger::$logDirectory = __DIR__ . '/../log';
Debugger::$strictMode = true;

if (Debugger::$showBar === true && php_sapi_name() !== 'cli') {
    (new TracyExtensionLoader($app));
}

// ────────────────────────────────────────────────
// Database Service Setup (version finale - dynamique via config)
if (!empty($config['database']['file_path'])) {
    // SQLite (non utilisé ici)
    $dsn  = 'sqlite:' . $config['database']['file_path'];
    $user = null;
    $pass = null;
} else {
    // MySQL
    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=%s',
        $config['database']['host'] ?? 'localhost',
        $config['database']['dbname'] ?? '',
        $config['database']['charset'] ?? 'utf8mb4'
    );
    $user = $config['database']['user'] ?? null;
    $pass = $config['database']['password'] ?? null;
}

$pdoClass = (Debugger::$showBar === true && php_sapi_name() !== 'cli')
    ? PdoQueryCapture::class
    : PdoWrapper::class;

$app->register('db', $pdoClass, [
    $dsn,
    $user,
    $pass,
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]
]);

// ────────────────────────────────────────────────
// Ajoute ici d'autres services si besoin plus tard
// (session, redis, mail, etc.)