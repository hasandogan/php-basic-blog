<?php
include 'connect.php';
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$pass = $_POST['pass'];
$email = $_POST['email'];
$password = md5($pass);


$query = $conn->prepare("INSERT INTO user (firstname,lastname,username,pass,email) VALUES (?,?,?,?,?)");
$query->bindParam(1, $firstname );
$query->bindParam(2, $lastname );
$query->bindParam(3, $username );
$query->bindParam(4, $password);
$query->bindParam(5, $email);

if ($query->execute()) {
        header('location: /');
} else {
    session_start();
    $_SESSION['registererror'] = 'registererror';
    header('location: /register/');
}