<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


require_once "../app/middleware.php";
$middleware = new middleware();
$middleware->checklogin(); 


require_once "../app/core/App.php";
$app = new App();
?>