<?php
// app/controllers/VehicleController.php

require_once __DIR__ . '/../models/Vehicle.php';
require_once __DIR__ . '/../services/FlashMessage.php';
require_once __DIR__ . '/AuthController.php';

class VehicleController {
    private $vehicleModel;
    private $authController;

    public function __construct() {
        $this->vehicleModel = new Vehicle();
        $this->authController = new AuthController();
    }

    public function index() {
        if (!$this->authController->isLoggedIn()) {
            header('Location: index.php?action=login');
            exit;
        }

        $search = $_GET['search'] ?? '';
        $vehicles = $this->vehicleModel->search($search);
        include __DIR__ . '/../../views/dashboard.php';
    }

    private function handleImageUpload() {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../assets/images/vehicles/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileSize = $_FILES['image']['size'];
            $fileType = $_FILES['image']['type'];
            
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($fileTmpPath);

            if (!in_array($mimeType, $allowedMimeTypes)) {
                return ['error' => 'Type de fichier non autorisé. Images seulement (JPG, PNG, GIF, WEBP).'];
            }

            // Sanitizing filename
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = uniqid('vehicle_', true) . '.' . $extension;
            $destPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                return ['success' => '../assets/images/vehicles/' . $newFileName];
            } else {
                return ['error' => 'Erreur lors du déplacement du fichier.'];
            }
        }
        return null;
    }

    public function add() {
        if (!$this->authController->isAdmin()) {
            header('Location: index.php?action=dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $brand = trim($_POST['brand']);
            $model = trim($_POST['model']);
            $registrationNumber = trim($_POST['registration_number']);
            $imagePath = null;

            // Handle Image Upload
            $uploadResult = $this->handleImageUpload();
            if (isset($uploadResult['error'])) {
                FlashMessage::set($uploadResult['error'], "error");
            } else {
                if (isset($uploadResult['success'])) {
                    $imagePath = $uploadResult['success'];
                }

                if (empty($brand) || empty($model) || empty($registrationNumber)) {
                    FlashMessage::set("Tous les champs sont requis.", "error");
                } elseif ($this->vehicleModel->add($brand, $model, $registrationNumber, $imagePath)) {
                    FlashMessage::set("Véhicule ajouté avec succès.", "success");
                    header('Location: index.php?action=admin');
                    exit;
                } else {
                    FlashMessage::set("Échec de l'ajout du véhicule.", "error");
                }
            }
        }
        include __DIR__ . '/../../views/add_vehicle.php';
    }

    public function edit($id) {
        if (!$this->authController->isAdmin()) {
            header('Location: index.php?action=dashboard');
            exit;
        }

        $vehicle = $this->vehicleModel->getById($id);
        if (!$vehicle) {
            header('Location: index.php?action=admin');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $brand = trim($_POST['brand']);
            $model = trim($_POST['model']);
            $registrationNumber = trim($_POST['registration_number']);
            $imagePath = null;

             // Handle Image Upload
             $uploadResult = $this->handleImageUpload();
             if (isset($uploadResult['error'])) {
                 FlashMessage::set($uploadResult['error'], "error");
                 // Don't exit, let the user retry or keep current logic
             } else {
                 if (isset($uploadResult['success'])) {
                     $imagePath = $uploadResult['success'];
                 }
 
                 if ($this->vehicleModel->update($id, $brand, $model, $registrationNumber, $imagePath)) {
                     header('Location: index.php?action=admin');
                     exit;
                 } else {
                     FlashMessage::set("Échec de la mise à jour du véhicule.", "error");
                 }
             }
        }
        include __DIR__ . '/../../views/edit_vehicle.php';
    }

    public function admin() {
        if (!$this->authController->isAdmin()) {
            header('Location: index.php?action=dashboard');
            exit;
        }

        $vehicles = $this->vehicleModel->getAll();
        
        require_once __DIR__ . '/../models/User.php';
        require_once __DIR__ . '/../models/Reservation.php';
        
        $userModel = new User();
        $reservationModel = new Reservation();
        
        $totalUsers = count($userModel->getAll());
        $totalReservations = count($reservationModel->getAll());
        $activeReservations = count($reservationModel->getActive());
        
        include __DIR__ . '/../../views/admin.php';
    }

    public function delete($id) {
        if (!$this->authController->isAdmin()) {
            header('Location: index.php?action=dashboard');
            exit;
        }

        if ($this->vehicleModel->delete($id)) {
            FlashMessage::set("Véhicule supprimé avec succès.", "success");
        } else {
            FlashMessage::set("Échec de la suppression du véhicule.", "error");
        }
        header('Location: index.php?action=admin');
        exit;
    }

    public function search($model = '') {
        return $this->vehicleModel->search($model);
    }
}
?>
