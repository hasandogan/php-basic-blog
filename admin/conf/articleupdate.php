<?php
include '../../connect.php';

if (isset($_POST['categories'])) {
    $categories = $_POST['categories'];
    $categoriesid = "SELECT * FROM categories where categories='$categories'";
    $catresult = mysqli_query($link, $categoriesid);
    $catrow = mysqli_fetch_array($catresult);
    $cid = $catrow['id'];
    $id = $_GET['id'];
    $sql = "UPDATE article_categories SET categoriesid='$cid' where articleid='$id' ";
    if (mysqli_query($link, $sql)) {
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $date = $_POST['date'];

    $sql = "UPDATE article SET title='$title', author='$author', content='$content', updateAt='$date'  WHERE id='$id'";

    if (mysqli_query($link, $sql)) {
        header('location: ../article.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM article WHERE id='$id'";
    if (mysqli_query($link, $sql)) {
        header('location: /admin/article.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}