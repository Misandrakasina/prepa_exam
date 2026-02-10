<?php

function dbconnect()
{
    $host = 'localhost';
    $dbname = 'message';
    $user = 'root';
    $pass = '';

    try {
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        return $DBH;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>