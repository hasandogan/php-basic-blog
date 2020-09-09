<?php
session_start();
include 'connect.php';
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$pass = $_POST['pass'];
$email = $_POST['email'];
$password = md5($pass);
$sql = "INSERT INTO user (firstname, lastname, username, pass , email)VALUES ('$firstname', '$lastname', '$username','$password',' $email')";
if (mysqli_query($link, $sql)) {
    if (isset($_SESSION['user_type']) == 'admin') {

        header('location: admin/user.php');
    } else {
        header('Location: index.php');
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}