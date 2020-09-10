<?php
include 'conf/connect.php';
$path = $_SERVER['PATH_INFO'];
$path = substr($path, 1);
$pathArray = explode('/', $path);
if ($pathArray[1]== 'delete'){
    $delete = $pathArray[1];
}else{
    $id = $pathArray[1];
}

if ($delete == 'delete') {
    $query = $conn->prepare("DELETE FROM article WHERE id='$id'");
    $insert = $query->execute();
    if ($insert) {
        header('location: /admin/article');
    }
}

if (isset($_POST['categories'])) {
    $categories = $_POST['categories'];
    $catquery = $conn->query("SELECT * FROM categories WHERE name='$categories'");
    $cat = $catquery->fetch();
    $cid = $cat['id'];
    $query = $conn->query("UPDATE article_categories SET categoriesid='$cid' where articleid='$id' ");
    $query->execute();
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
if (isset($id)) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $date = date('Y-m-d H:i:s');
    if (isset($_FILES['fileToUpload']['name'])) {
        $query = $conn->prepare("UPDATE article SET title=?, author=?, content=?, updateAt=?, image_path=?  WHERE id='$id'");
        $query->bindParam(1, $title );
        $query->bindParam(2, $author );
        $query->bindParam(3, $content );
        $query->bindParam(4, $date);
        $query->bindParam(5, $image);
        $query->execute();
    } else {
        $query = $conn->prepare("UPDATE article SET title=?, author=?, content=?, updateAt=? WHERE id='$id'");
        $query->bindParam(1, $title);
        $query->bindParam(2, $author);
        $query->bindParam(3, $content);
        $query->bindParam(4, $date);
        $query->execute();
    }

}

if (isset($_POST['categories'])) {
    $categories = $_POST['categories'];
    $query = $conn->query("SELECT * FROM categories where name='$categories'");
    $cat = $query->fetch();
    $cid = $cat['id'];
    $query = $conn->prepare("INSERT INTO article_categories (articleid,categoriesid) VALUES (?,?)");
    $query->bindParam(1, $id);
    $query->bindParam(2, $cid);
    $query->execute();

}
if (isset($_POST['tags'])) {
    $tag = $_POST['tags'];
    $count = count($tag);
    for ($i = 0; $i < $count; $i++) {
        $query = $conn->prepare("INSERT INTO tags (articleid,tag_name) VALUES (?,?)");
        $query->bindParam(1, $id);
        $query->bindParam(2, $tag[$i]);
        $query->execute();

    }
    header('location: /admin/article');
}
else{
    header('location: /admin/article');
}