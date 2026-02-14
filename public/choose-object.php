<?php

require __DIR__ . '/../vendor/autoload.php';

$app = Flight::app();
require __DIR__ . '/../app/config/bootstrap.php';

$path = __DIR__ . '/../app/views/choose-object.php';
if (file_exists($path)) {
    include $path;
} else {
    http_response_code(404);
    echo 'Page introuvable';
}
