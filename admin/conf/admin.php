<?php
require_once '../class/Admin.php';
$admin = new Admin();
if (isset($_POST['submit'])){
    $admin= $admin->add();
}
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $admin = $admin->delete($id);
}