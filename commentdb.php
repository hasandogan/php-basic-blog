<?php
include 'connect.php';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $date = $_POST['date'];
    $id = $_POST['id'];

    $content = $_POST['commentcontent'];
    $sqlslug = "SELECT * FROM article where id='$id'";
    $slugquery = mysqli_query($link,$sqlslug);
    $slugresult = mysqli_fetch_array($slugquery);
    $slug  = $slugresult['slug'];

    $sql = "INSERT INTO comments (username, content, createdAt, articleid )VALUES ('$username', '$content', '$date',' $id')";
    if (mysqli_query($link, $sql)) {
        header('Location: /articleshow/'. $slug);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
} else {
    header('location:  /');
}