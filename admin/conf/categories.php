<?php
include '../../connect.php';
if (isset($_POST['categoriesname'])){
    $cate = $_POST['categoriesname'];
    $pagetitle = $_POST['pagetitle'];
    $content = $_POST['content'];
    $metadescc = $_POST['metadesc'];
    $metakey = $_POST['metakey'];
$sql = "INSERT INTO categories(categories, page_title, content, meta_desc, meta_key)VALUES('$cate','$pagetitle','$content','$metadescc','$metakey')";
if (mysqli_query($link, $sql)){
    header('location: ../categorieslist.php');
}else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}
}


if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $cate = $_POST['categories'];
    $pagetitle = $_POST['pagetitle'];
    $content = $_POST['content'];
    $metadescc = $_POST['metadesc'];
    $metakey = $_POST['metakey'];
    $sql = "UPDATE categories SET categories='$cate',page_title='$pagetitle',content='$content',meta_desc='$metadescc',meta_key='$metakey' WHERE id='$id'";
    if (mysqli_query($link, $sql)){
        header('location: ../categorieslist.php');
    }else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }

}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "DELETE FROM categories where id='$id'";
    if (mysqli_query($link, $sql)) {
        header('location: /admin/categorieslist.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }}