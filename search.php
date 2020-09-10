<?php
include 'connect.php';
session_start();
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $query = $conn->query("SELECT * FROM article where title  LIKE '%$search%'");
    if ($query->rowCount()) {
        $articleid = [];
        foreach ($query as $row) {
            $articlesearchid = $row['id'];
            $articleid[] = $articlesearchid;
            $_SESSION['search'] = $articleid;
        }
    }
    if (!isset($searchresult)) {
        $query = $conn->query("SELECT * FROM article where content  LIKE '%$search%'");
        if ($query->rowCount()) {
            $articleid = [];
            foreach ($query as $row) {
                $articlesearchid = $row['id'];
                $articleid[] = $articlesearchid;
                $_SESSION['search'] = $articleid;
            }
        }
    }
    if (!isset($searchresult)) {
        $query = $conn->query("SELECT * FROM article where id  LIKE '%$search%'");
        if ($query->rowCount()) {
            $articleid = [];
            foreach ($query as $row) {
                $articlesearchid = $row['id'];
                $articleid[] = $articlesearchid;
                $_SESSION['search'] = $articleid;
            }
        }
        header('location: /');
    }
}
if ($_SESSION['search'] == null) {
    $_SESSION['searchhatası'] = 'searchhatası';
    header('location: /');
}
