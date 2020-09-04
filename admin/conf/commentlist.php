<?php
$link = mysqli_connect("localhost", "root", "password", "blog");
$sql = "SELECT * FROM comments";
$result = mysqli_query($link, $sql);


if (isset($_GET['id'])){
    $id = $_GET['id'];
        $ok = 1;
    $sql = "UPDATE comments SET confirmed='$ok' WHERE id='$id'";
    if(mysqli_query($link,$sql)){

        header('location: ../comment.php');
    }else{
        echo 'hatalı sql';
    }

}
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "Delete FROM comments where id='$id'";
    if($query = mysqli_query($link,$sql)){
        header('location: /admin/comment.php');
    }
    else{
        echo "Error: " . $sql . "<br>" . mysqli_error($link);

    }

}

