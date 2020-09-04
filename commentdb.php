<?php
include 'connect.php';
if (isset($_POST['username'])){
    $username = $_POST['username'];
    $date = $_POST['date'];
    $id = $_POST['id'];
    $content = $_POST['commentcontent'];

    $sql = "INSERT INTO comments (username, content, createdAt, articleid )VALUES ('$username', '$content', '$date',' $id')";
    if (mysqli_query($link, $sql)) {
        header('Location: articleshow.php?id='.$id);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }



}else{
    header('location: index.php');
}