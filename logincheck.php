<?php
session_start();
include 'connect.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];


    if ($username && $pass) {
        $password = md5($pass);
        $sql = ("SELECT * FROM user where username='$username' and  pass='$password'");
        $query = mysqli_query($link, $sql);
        $result = mysqli_num_rows($query);


        if ($result > 0) {
            $_SESSION['username'] = $username;
            header('location: index.php');

        } else {
            header('location: /login.php');
        }
    }

}