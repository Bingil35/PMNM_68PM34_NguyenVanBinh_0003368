<?php
class auth {

    public $user = [
        "binhnv" => "123456",
        "user" => "654321"
    ];



public function login() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $username = $_POST["username"] ?? '';
        $password = $_POST["password"] ?? '';

        if (
            isset($this->user[$username]) &&
            $this->user[$username] === $password
        ) {
            // Đăng nhập thành công
            $_SESSION["username"] = $username;
            
            header("Location: /home/index");
            exit();
        } else {
            header("Location: /home/login");
            exit();
        }
    }
}
}
?>