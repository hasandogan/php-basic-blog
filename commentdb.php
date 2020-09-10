<?php
include 'connect.php';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $date = $_POST['date'];
    $id = $_POST['id'];
    $content = $_POST['commentcontent'];
    $query = $conn->query("SELECT * FROM article where id='$id'");
    if ($query->rowCount()) {
        foreach ($query as $row) {

        }
    }
    $title = $row['slug'];
    $query = $conn->prepare("INSERT INTO comments SET 
    username = ?,
     content = ?,
    createdAt = ?,
     articleid = ?,
     articletitle= ?
    ");

    $insert = $query->execute(array(
        "$username", "$content", "$date", "$id", "$title"));
    if ($insert) {
        header('location: articleshow/' . $title);
    }
}