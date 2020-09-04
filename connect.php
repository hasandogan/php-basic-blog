<?php

$link = mysqli_connect("localhost", "root", "password", "blog");

if (!$link) {
    echo 'veritabanı hatası';
    exit;

}
?>