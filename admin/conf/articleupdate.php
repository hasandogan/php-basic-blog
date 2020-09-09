<?php
$link = mysqli_connect("localhost", "root", "password", "blog");

$path = $_SERVER['PATH_INFO'];
$path = substr($path, 1);
$pathArray = explode('/', $path);
$id = $pathArray[1];


if (isset($_POST['categories'])) {
    $categories = $_POST['categories'];
    $categoriesid = "SELECT * FROM categories where categories='$categories'";
    $catresult = mysqli_query($link, $categoriesid);
    $catrow = mysqli_fetch_array($catresult);
    $cid = $catrow['id'];
    $sql = "UPDATE article_categories SET categoriesid='$cid' where articleid='$id' ";
    if (mysqli_query($link, $sql)) {
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}

$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $image = $_FILES['fileToUpload']['name'];

    } else {
        $_FILES = null;
    }
}

if (isset($_POST['categories'])) {
    $categories = $_POST['categories'];
    $sql = "SELECT * FROM categories where categories='$categories'";
    $cateresult = mysqli_query($link, $sql);
    $catrow = mysqli_fetch_array($cateresult);
    $catid = $catrow['id'];
    $articlecategories = "INSERT INTO article_categories (articleid,categoriesid)VALUES ('$id','$catid')";
    if (mysqli_query($link, $articlecategories)) {
        header('location: /admin/article');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}

if (isset($id)) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $date = date('Y-m-d H:i:s');
    if (isset($_FILES['fileToUpload']['name']) != null) {
        $sql = "UPDATE article SET title='$title', author='$author', content='$content', updateAt='$date',image_path='$image'  WHERE id='$id'";
    } else {
        $sql = "UPDATE article SET title='$title', author='$author', content='$content', updateAt='$date'  WHERE id='$id'";
    }
    if (mysqli_query($link, $sql)) {
        header('location: /admin/article');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}
$path = $_SERVER['PATH_INFO'];
$path = substr($path, 1);
$pathArray = explode('/', $path);
$delete = $pathArray[1];
if (isset($delete)) {
    $id = $pathArray[2];
    $sql = "DELETE FROM article WHERE id='$id'";
    if (mysqli_query($link, $sql)) {
        header('location: /admin/article');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}