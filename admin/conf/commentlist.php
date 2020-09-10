<?php
include 'connect.php';
if (isset($_GET['id'])){
    $id = $_GET['id'];
        $ok = 1;
    $query = $conn->query( "UPDATE comments SET confirmed='$ok' WHERE id='$id'");
    if($query->execute()){
        header('location: /admin/commentlist');
    }else{
        echo 'hatalı sql';
    }

}
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query = $conn->query( "Delete FROM comments where id='$id'");
    if($query->execute()){
        header('location: /admin/commentlist');
    }
    else{
        echo 'hatalı sql';
    }

}

