<?php
require_once '../class/AdminLoginCheck.php';
$login = new AdminLoginCheck();

if (isset($_POST['login']))
{
    $login->loginCheck();
}
