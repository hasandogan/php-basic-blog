<?php
require 'Layout/header.php';
?>

<link rel="stylesheet" href="css/login.css">
<div class="login-box">
    <h2>Login</h2>
    <form action="registerdb.php" method="POST">
        <div class="user-box">
            <input type="text" name="username" required="">
            <label>User Name</label>
        </div>
        <div class="user-box">
            <input type="text" name="firstname" required="">
            <label>First Name</label>
        </div>
        <div class="user-box">
            <input type="text" name="lastname" required="">
            <label>Last Name</label>
        </div>
        <div class="user-box">
            <input type="text" name="email" required="">
            <label>Email</label>
        </div>
        <div class="user-box">
            <input type="password" name="pass" required="">
            <label>Password</label>
        </div>
        <input type="submit" value="submit">
    </form>
</div>
