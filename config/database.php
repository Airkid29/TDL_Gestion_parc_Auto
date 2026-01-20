<?php
// config/database.php

class Database {
    private static $pdo;
    private static $host = 'localhost';
    private static $username = 'root';
    private static $password = '';
    private static $database = 'vehicle_reservation';

    public static function connect() {
        if (!self::$pdo) {
            $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$database . ';charset=utf8mb4';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            try {
                self::$pdo = new PDO($dsn, self::$username, self::$password, $options);
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}

// Initialise une connexion globale pour les modèles existants
$pdo = Database::connect();
?>