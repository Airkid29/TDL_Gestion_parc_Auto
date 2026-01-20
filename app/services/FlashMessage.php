<?php
// app/services/FlashMessage.php

class FlashMessage {
    public static function set($message, $type = 'success') {
        self::ensureSession();
        if (!isset($_SESSION['flash_messages'])) {
            $_SESSION['flash_messages'] = [];
        }
        $_SESSION['flash_messages'][] = ['message' => $message, 'type' => $type];
    }

    public static function get() {
        self::ensureSession();
        if (isset($_SESSION['flash_messages'])) {
            $messages = $_SESSION['flash_messages'];
            unset($_SESSION['flash_messages']);
            return $messages;
        }
        return [];
    }

    public static function display() {
        $messages = self::get();
        foreach ($messages as $msg) {
            $alertClass = $msg['type'] === 'error' ? 'alert-danger' : 'alert-success';
            echo "<div class='alert {$alertClass} alert-dismissible fade show' role='alert'>
                    {$msg['message']}
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                  </div>";
        }
    }

    private static function ensureSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}
?>