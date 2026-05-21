<?php

class middleware {

    public function checklogin() {

    $currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $publicPages = [
        '/home/login',
        '/auth/login'
    ]  ;

    if (!isset($_SESSION["username"]) && !in_array($currentUrl, $publicPages)) {
        header("Location: /home/login");
        exit();
        }
    }
}
?>