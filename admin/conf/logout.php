<?php
session_start();
unset($_SESSION['user_type']);
session_write_close();
header("Location: ../login.php");



