<?php
// app/controllers/ReservationController.php

require_once __DIR__ . '/../models/Reservation.php';
require_once __DIR__ . '/../models/Vehicle.php';
require_once __DIR__ . '/../services/ReservationService.php';
require_once __DIR__ . '/../services/FlashMessage.php';
require_once __DIR__ . '/AuthController.php';

class ReservationController {
    private $reservationModel;
    private $reservationService;
    private $authController;

    public function __construct() {
        $this->reservationModel = new Reservation();
        $this->reservationService = new ReservationService();
        $this->authController = new AuthController();
    }

    public function reserve() {
        if (!$this->authController->isLoggedIn()) {
            header('Location: index.php?action=login');
            exit;
        }

        $vehicleModel = new Vehicle();
        $vehicles = $vehicleModel->getAll();
        $selectedVehicleId = $_GET['vehicle_id'] ?? null;
        $selectedVehicle = $selectedVehicleId ? $vehicleModel->getById($selectedVehicleId) : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vehicleId = (int)($_POST['vehicle_id'] ?? 0);
            $startDate = trim($_POST['start_date'] ?? '');
            $endDate = trim($_POST['end_date'] ?? '');
            $userId = $_SESSION['user_id'];

            if (!$vehicleId || empty($startDate) || empty($endDate)) {
                FlashMessage::set("Merci de renseigner toutes les informations.", "error");
                header("Location: index.php?action=reserve&vehicle_id={$vehicleId}");
                exit;
            }

            if (strtotime($endDate) < strtotime($startDate)) {
                FlashMessage::set("La date de fin doit être postérieure à la date de début.", "error");
                header("Location: index.php?action=reserve&vehicle_id={$vehicleId}");
                exit;
            }

            $created = $this->reservationService->createReservation($userId, $vehicleId, $startDate, $endDate);

            if ($created) {
                FlashMessage::set("Réservation enregistrée avec succès.", "success");
                header('Location: index.php?action=my_reservations');
                exit;
            }

            FlashMessage::set("Ce véhicule est déjà réservé sur cette période.", "error");
            header("Location: index.php?action=reserve&vehicle_id={$vehicleId}");
            exit;
        }

        include __DIR__ . '/../../views/reserve.php';
    }

    public function myReservations() {
        if (!$this->authController->isLoggedIn()) {
            header('Location: index.php?action=dashboard');
            exit;
        }

        $reservations = $this->reservationModel->getByUser($_SESSION['user_id']);
        include __DIR__ . '/../../views/my_reservations.php';
    }

    public function adminReservations() {
        if (!$this->authController->isAdmin()) {
            header('Location: index.php?action=dashboard');
            exit;
        }

        $reservations = $this->reservationModel->getAll();
        include __DIR__ . '/../../views/admin_reservations.php';
    }

    public function delete($id) {
        if (!$this->authController->isLoggedIn()) {
            header('Location: index.php?action=dashboard');
            exit;
        }

        $userId = $this->reservationModel->getUserId($id);

        if ($userId && ($userId == $_SESSION['user_id'] || $this->authController->isAdmin())) {
            $this->reservationModel->delete($id);
            FlashMessage::set("Réservation annulée.", "success");
        } else {
            FlashMessage::set("Action non autorisée.", "error");
        }

        if ($this->authController->isAdmin()) {
            header('Location: index.php?action=admin_reservations');
        } else {
            header('Location: index.php?action=my_reservations');
        }
        exit;
    }
}
?>
