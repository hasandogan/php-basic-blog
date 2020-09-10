<?php
include 'conf/connect.php';
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $md5password =  md5($password);


    if ($username && $password) {

        $query = $conn->query("SELECT * FROM admin WHERE username='$username' and  password='$md5password'");
         $row = $query->fetch();

        if ( $row !== false){
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['admingiris'] = 'admingiris';
            header('location: /admin/');

        } else {
            $_SESSION['adminerror'] = 'adminerror';
            header('location: /admin/login');
        }
    }

}