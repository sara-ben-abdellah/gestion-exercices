<?php

$config = parse_ini_file(__DIR__ . '/.env');

$host = $config['DB_HOST'];
$dbname = $config['DB_NAME'];
$username = $config['DB_USER'];
$password = $config['DB_PASSWORD'];
$port = $config['DB_PORT'];

try {
    $conn = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}