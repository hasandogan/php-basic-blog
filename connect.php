<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=blog", "root" ,"password");
}catch (PDOException $e){
    print $e->getMessage();
}
?>