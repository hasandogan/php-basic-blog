<?php
include '../../connect.php';
$target_dir = "../img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$image = $_FILES['fileToUpload']['name'];
$title = $_POST['title'];
$author = $_POST['author'];
$content = $_POST['content'];
$createdAt = $_POST['createdAt'];
$sql = "INSERT INTO article (title, author, content, createdAt , image_path )VALUES ('$title', '$author', '$content',' $createdAt','$image')";
if (mysqli_query($link, $sql)) {
    session_start();
   $_SESSION['id'] = mysqli_insert_id($link);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}


if (isset($_POST['tags'])){
    $id = $_SESSION['id'];
    $tag =  $_POST['tags'];
    $count = count($tag);
    for ($i = 0; $i< $count;$i++){
    $sql = "INSERT INTO tags (articleid,tag_name)VALUES ('$id','$tag[$i]')";
    if (mysqli_query($link,$sql)){
    }else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }

    }
}
if (isset($_POST['categories'])){
    $categories = $_POST['categories'];
    $sql = "SELECT * FROM categories where categories='$categories'";
   $cateresult = mysqli_query($link,$sql);
   $catrow = mysqli_fetch_array($cateresult);
   $catid = $catrow['id'];
    $id = $_SESSION['id'];
    $articlecategories = "INSERT INTO article_categories (articleid,categoriesid)VALUES ('$id','$catid')";
    if (mysqli_query($link,$articlecategories)){
        header('location:/admin/article.php');
    }else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}



