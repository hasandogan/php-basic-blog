<?php
include 'connect.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];

    if ($username && $pass) {
        $password = md5($pass);
        $query = $conn->query("SELECT * FROM user where username='$username' and  pass='$password'");
       $row =  $query->fetch();
        if (count($row) > 1) {
            session_start();
            $_SESSION['username'] = $username;
            header('location: /');

        } else {
            header('location: /login');
            session_start();
            $_SESSION['loginerror'] = 'loginerror';
            header('location: /login');
        }
    }


}