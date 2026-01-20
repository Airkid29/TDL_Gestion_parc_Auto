<?php
// app/controllers/AuthController.php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../services/FlashMessage.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm-password'];

            if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
                FlashMessage::set("Tous les champs sont requis.", "error");
                header('Location: index.php?action=register');
                exit;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                FlashMessage::set("Adresse email invalide.", "error");
                header('Location: index.php?action=register');
                exit;
            } elseif (strlen($password) < 6) {
                FlashMessage::set("Le mot de passe doit contenir au moins 6 caractères.", "error");
                header('Location: index.php?action=register');
                exit;
            } elseif ($password !== $confirmPassword) {
                FlashMessage::set("Les mots de passe ne correspondent pas.", "error");
                header('Location: index.php?action=register');
                exit;
            } elseif ($this->userModel->register($name, $email, $password)) {
                FlashMessage::set("Inscription réussie ! Vous pouvez maintenant vous connecter.", "success");
                header('Location: index.php?action=login');
                exit;
            } else {
                FlashMessage::set("Erreur lors de l'inscription. L'email existe peut-être déjà.", "error");
                header('Location: index.php?action=register');
                exit;
            }
        }
        include __DIR__ . '/../../views/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                FlashMessage::set("Tous les champs sont requis.", "error");
                header('Location: index.php?action=login');
                exit;
            } else {
                $user = $this->userModel->login($email, $password);
                if ($user) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['is_admin'] = $user['is_admin'];
                    header('Location: index.php?action=dashboard');
                    exit;
                } else {
                    FlashMessage::set("Identifiants invalides.", "error");
                    header('Location: index.php?action=login');
                    exit;
                }
            }
        }
        include __DIR__ . '/../../views/login.php';
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        session_destroy();
        session_start();
        FlashMessage::set("Vous avez été déconnecté.", "success");
        header('Location: index.php');
        exit;
    }

    public function isLoggedIn() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    public function isAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
    }

    public function profile() {
        if (!$this->isLoggedIn()) {
            header('Location: index.php?action=login');
            exit;
        }

        $user = $this->userModel->getById($_SESSION['user_id']);
        include __DIR__ . '/../../views/profile.php';
    }

    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->isLoggedIn()) {
                header('Location: index.php?action=login');
                exit;
            }

            $userId = $_SESSION['user_id'];
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'] ?? null;

            if (empty($name) || empty($email)) {
                FlashMessage::set("Le nom et l'email sont obligatoires.", "error");
                header('Location: index.php?action=profile');
                exit;
            }

            $updated = $this->userModel->updateProfile($userId, $name, $email, $password ?: null);

            if ($updated) {
                FlashMessage::set("Profil mis à jour avec succès.", "success");
                $_SESSION['user_name'] = $name;
            } else {
                FlashMessage::set("Une erreur est survenue. Veuillez réessayer.", "error");
            }

            header('Location: index.php?action=profile');
            exit;
        }

        header('Location: index.php?action=profile');
        exit;
    }
}
?>