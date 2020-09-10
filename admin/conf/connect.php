<?php
    try {
        $conn = new PDO("mysql:host=localhost;dbname=blog", "root" ,"password");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e){
        print $e->getMessage();
        exit;
    }


?>