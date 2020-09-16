<?php
require_once 'class/User.php';
$login = new User();
if (isset($_POST['login'])){
$login->login();
}