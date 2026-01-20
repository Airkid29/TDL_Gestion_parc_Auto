<?php
// app/services/ReservationService.php

require_once __DIR__ . '/../models/Reservation.php';

class ReservationService {
    private $reservationModel;

    public function __construct() {
        $this->reservationModel = new Reservation();
    }

    public function isAvailable($vehicleId, $startDate, $endDate) {
        $conflicts = $this->reservationModel->getConflictingReservations($vehicleId, $startDate, $endDate);
        return count($conflicts) === 0;
    }

    public function createReservation($userId, $vehicleId, $startDate, $endDate) {
        if (!$this->isAvailable($vehicleId, $startDate, $endDate)) {
            return false; // Conflict detected
        }
        return $this->reservationModel->create($userId, $vehicleId, $startDate, $endDate);
    }
}
?>