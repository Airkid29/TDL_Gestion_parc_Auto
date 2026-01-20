<?php
// app/models/Reservation.php

require_once __DIR__ . '/../../config/database.php';

class Reservation {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function create($userId, $vehicleId, $startDate, $endDate) {
        $stmt = $this->pdo->prepare("INSERT INTO reservations (user_id, vehicle_id, start_date, end_date) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$userId, $vehicleId, $startDate, $endDate]);
    }

    public function getByUser($userId) {
        $stmt = $this->pdo->prepare("
            SELECT r.*, v.brand, v.model, v.registration_number
            FROM reservations r
            JOIN vehicles v ON r.vehicle_id = v.id
            WHERE r.user_id = ?
            ORDER BY r.start_date DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT r.*, u.name as user_name, v.brand, v.model, v.registration_number
            FROM reservations r
            JOIN users u ON r.user_id = u.id
            JOIN vehicles v ON r.vehicle_id = v.id
            ORDER BY r.start_date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getConflictingReservations($vehicleId, $startDate, $endDate) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM reservations
            WHERE vehicle_id = ?
            AND start_date < ?
            AND end_date > ?
        ");
        $stmt->execute([$vehicleId, $endDate, $startDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM reservations WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getUserId($id) {
        $stmt = $this->pdo->prepare("SELECT user_id FROM reservations WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['user_id'] : null;
    }

    public function getActive() {
        $stmt = $this->pdo->query("SELECT * FROM reservations WHERE end_date >= NOW()");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>