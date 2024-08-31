<?php

define('DB_HOST', 'localhost');
// define('DB_NAME', 'web1211371_db');
define('DB_NAME', 'web1211371_clothingStore');
define('DB_USER', 'web1211371_dbuser');
define('DB_PASSWORD', '^kKKyZ2fFr');
//web1211371_clothingStore

function db_connect() {
    try {
        $connString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $pdo = new PDO($connString, DB_USER, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($pdo){
            echo "the connection good";
        }
        return $pdo;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}

$pdo = db_connect();
?>

