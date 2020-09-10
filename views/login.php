<?php
require 'Layout/header.php';
?>
<link rel="stylesheet" href="../css/login.css">
<link rel="stylesheet" href="../css/account.css">
<div class="login-box">
    <h2>Login</h2>
    <?php
    if ($_SESSION['loginerror'] == 'loginerror') {
        unset($_SESSION['loginerror']);
        ?>
        <div class="alert alert-danger" role="alert">
            <strong>Oh Olamaz</strong> Sanırım Birşeyler Ters gitti!
        </div>
    <?php } ?>
    <form action="logincheck" method="POST">
        <div class="user-box">
            <input type="text" name="username" required="">
            <label>Username</label>
        </div>
        <div class="user-box">
            <input type="password" name="password" required="">
            <label>Password</label>
        </div>
        <button type="submit" name="login" class="btn btn-success">Success</button>

    </form>
</div>

