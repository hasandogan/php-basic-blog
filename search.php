<?php
include 'connect.php';
session_start();
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM article where title  LIKE '%$search%'";
    $searchquery = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($searchquery)) {
        $articlesearchid = $row['id'];
        $articleid[] = $articlesearchid;
        $_SESSION['search'] = $articleid;
    }
    if (!isset($searchresult)) {
        $sql = "SELECT * FROM article where content  LIKE '%$search%'";
        $searchquery = mysqli_query($link, $sql);
        $articleid = [];
        while ($row = mysqli_fetch_array($searchquery)) {
            $articlesearchid = $row['id'];
            $articleid[] = $articlesearchid;
            $_SESSION['search'] = $articleid;
        }
    }
    if (!isset($searchresult)) {
        $sql = "SELECT * FROM article where id  LIKE '%$search%'";
        $searchquery = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_array($searchquery)) {
            $articlesearchid = $row['id'];
            $articleid[] = $articlesearchid;
            $_SESSION['search'] = $articleid;
        }
        header('location: /');
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}
if ($_SESSION['search'] == null ){
    $_SESSION['hata'] = 'hata';
    header('location: /');
}
