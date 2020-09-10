<?php
include 'connect.php';
$path = $_SERVER['PATH_INFO'];
$path = substr($path, 1);
$pathArray = explode('/', $path);
$id = $pathArray[2];
if ($pathArray[1] === 'delete'){
    $delete = $pathArray[1];
}else{
    $edit = $pathArray[1];
}


if (isset($_POST['categoriesname'])){

    $cate = $_POST['categoriesname'];
    $pagetitle = $_POST['pagetitle'];
    $content = $_POST['content'];
    $metadescc = $_POST['metadesc'];
    $metakey = $_POST['metakey'];
    $query = $conn->prepare( "INSERT INTO categories SET 
    name = ?, 
    page_title = ?, 
    content = ?,
    meta_desc = ?,
    meta_key = ?
    
    ");
    $insert = $query->execute(array(
        "$cate","$pagetitle","$content","$metadescc","$metakey"
    ));

if ($insert){
    header('location: categories');
}else {
    echo "Error:categories" . PDOException::class . "<br>";
}
}
if (isset($edit) != null) {
    $cate = $_POST['categories'];
    $pagetitle = $_POST['pagetitle'];
    $content = $_POST['content'];
    $metadescc = $_POST['metadesc'];
    $metakey = $_POST['metakey'];
    $query = $conn->prepare( "UPDATE categories SET 
    categories = ?,
    page_title = ?,
    content = ?,
    meta_desc = ?,
    meta_key = ?, 
    WHERE id = ?
    ");
    $insert = $query->execute(array(
       "$cate","$pagetitle","$content","$metadescc","$metakey","$metakey","$id"
    ));
    if ($insert){
        header('location: categories');
    }else {
        echo "Error:edit " . PDOException::class . "<br>";
    }
}

if (isset($delete) != null){
    $query = $conn->prepare("DELETE FROM categories where id ='$id'");
    $insert = $query->execute();
    if ($insert) {
        header('location: categories ');
    } else {
        echo "Error:delete " . PDOException::class . "<br>";
    }}