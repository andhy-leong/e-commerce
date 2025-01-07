<?php

$host = 'linserv-info-01';
$dbname = 'rl303414_MAGASINvirtuelle';
$username = 'rl303414';
$password = 'rl303414'; 

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}