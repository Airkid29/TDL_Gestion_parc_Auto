<?php
// public/index.php

session_start();

require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/VehicleController.php';
require_once __DIR__ . '/../app/controllers/ReservationController.php';

$action = $_GET['action'] ?? 'home';

$authController = new AuthController();
$vehicleController = new VehicleController();
$reservationController = new ReservationController();

switch ($action) {
    case 'register':
        $authController->register();
        break;
    case 'login':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'profile':
        $authController->profile();
        break;
    case 'update_profile':
        $authController->updateProfile();
        break;
    case 'dashboard':
        $vehicleController->index();
        break;
    case 'reserve':
        $reservationController->reserve();
        break;
    case 'my_reservations':
        $reservationController->myReservations();
        break;
    case 'add_vehicle':
        $vehicleController->add();
        break;
    case 'edit_vehicle':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $vehicleController->edit($id);
        } else {
            header('Location: index.php?action=admin');
        }
        break;
    case 'delete_vehicle':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $vehicleController->delete($id);
        } else {
            header('Location: index.php?action=admin');
        }
        break;
    case 'admin':
        if ($authController->isAdmin()) {
            $vehicleController->admin();
        } else {
            header('Location: index.php?action=dashboard');
        }
        break;
    case 'admin_reservations':
        $reservationController->adminReservations();
        break;
    case 'delete_reservation':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $reservationController->delete($id);
        } else {
            header('Location: index.php?action=dashboard');
        }
        break;
    default:
        include __DIR__ . '/../views/home.php';
        break;
}
?>