<?php
require 'Layout/header.php';
?>
<link rel="stylesheet" href="../css/login.css">
<link rel="stylesheet" href="../css/register.css">
<div class="👾">
    <div class="copy">

    </div>
</div>
<div class="login-box">

    <h2>Register</h2>
    <?php
    if ($_SESSION['registererror'] == 'registererror'){
        unset($_SESSION['registererror']);
        ?>
        <div class="alert alert-danger" role="alert">
            <strong>Oh Olamaz</strong> Sanırım Birşeyler Ters gitti!
        </div>
    <?php   } ?>

    <form action="check-register" method="POST">
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
            <input type="email" name="email" required="">
            <label>Email</label>
        </div>
        <div class="user-box">
            <input type="password" name="pass" required="">
            <label>Password</label>
        </div>
        <input type="submit" value="submit">
    </form>
</div>

