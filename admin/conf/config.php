<?php
include '../../connect.php';
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if ($username && $password) {

        $sql = ("SELECT * FROM admin WHERE username='$username' and  password='$password'");
        $query = mysqli_query($link, $sql);
        $result = mysqli_num_rows($query);



        if ($result > 0) {
            $sonuc = mysqli_fetch_array($query);
            $_SESSION['user_type'] = $sonuc['user_type'];
            header('location: ../index.php');

        } else {
            header('location: admin/login.php?error');
        }
    }

}