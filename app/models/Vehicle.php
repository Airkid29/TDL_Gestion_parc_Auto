<?php
// app/models/Vehicle.php

require_once __DIR__ . '/../../config/database.php';

class Vehicle {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM vehicles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM vehicles WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($brand, $model, $registrationNumber, $imagePath = null) {
        $stmt = $this->pdo->prepare("INSERT INTO vehicles (brand, model, registration_number, image_path) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$brand, $model, $registrationNumber, $imagePath]);
    }

    public function update($id, $brand, $model, $registrationNumber, $imagePath = null) {
        if ($imagePath) {
            $stmt = $this->pdo->prepare("UPDATE vehicles SET brand = ?, model = ?, registration_number = ?, image_path = ? WHERE id = ?");
            return $stmt->execute([$brand, $model, $registrationNumber, $imagePath, $id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE vehicles SET brand = ?, model = ?, registration_number = ? WHERE id = ?");
            return $stmt->execute([$brand, $model, $registrationNumber, $id]);
        }
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM vehicles WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function search($query = '') {
        if ($query === '') {
            return $this->getAll();
        }
        $stmt = $this->pdo->prepare("SELECT * FROM vehicles WHERE brand LIKE ? OR model LIKE ?");
        $searchTerm = "%" . $query . "%";
        $stmt->execute([$searchTerm, $searchTerm]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
