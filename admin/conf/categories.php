<?php
$link = mysqli_connect("localhost", "root", "password", "blog");
$path = $_SERVER['PATH_INFO'];
$path = substr($path, 1);
$pathArray = explode('/', $path);
$id = $pathArray[2];
if ($pathArray[1] === 'delete'){
    $delete = $pathArray[1];
}


if (isset($_POST['categoriesname'])){

    $cate = $_POST['categoriesname'];
    $pagetitle = $_POST['pagetitle'];
    $content = $_POST['content'];
    $metadescc = $_POST['metadesc'];
    $metakey = $_POST['metakey'];
$sql = "INSERT INTO categories(categories, page_title, content, meta_desc, meta_key)VALUES('$cate','$pagetitle','$content','$metadescc','$metakey')";
if (mysqli_query($link, $sql)){
    header('location: categories');
}else {
    echo "Error:" . $sql . "<br>" . mysqli_error($link);
}
}
if (isset($edit) != null) {
    $cate = $_POST['categories'];
    $pagetitle = $_POST['pagetitle'];
    $content = $_POST['content'];
    $metadescc = $_POST['metadesc'];
    $metakey = $_POST['metakey'];
    $sql = "UPDATE categories SET categories='$cate',page_title='$pagetitle',content='$content',meta_desc='$metadescc',meta_key='$metakey' WHERE id='$id'";
    if (mysqli_query($link, $sql)){
        header('location: /admin/categories');
    }else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}

if (isset($delete) != null){
    $sql = "DELETE FROM categories where id='$id'";
    if (mysqli_query($link, $sql)) {
        header('location: /admin/categories ');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }}