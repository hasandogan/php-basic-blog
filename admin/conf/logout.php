<?php
require_once '../class/AdminLoginCheck.php';
$logout = new AdminLoginCheck();
if (isset($_SESSION['user_type'])){
    $logout->logout();
}

