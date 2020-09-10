<?php
include 'connect.php';
$target_dir = "img";
$target_file = $target_dir . DIRECTORY_SEPARATOR . basename($_FILES["fileToUpload"]["name"]);
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

        echo "Sorry, there was an error uploading your file.";
    }
}
function replace_tr($text)
{
    $text = trim($text);
    $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü', ' ');
    $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u', '-');
    $new_text = str_replace($search, $replace, $text);
    return $new_text;
}


$title = $_POST['title'];
$converter = explode(' ', $title);
$titleConvertSlug = implode('-', $converter);
$slug = replace_tr($titleConvertSlug);
$author = $_POST['author'];
$content = $_POST['content'];
$createdAt = date('Y-m-d H:i:s');

$query = $conn->prepare("INSERT INTO article (slug,title,author,content,createdAt,image_path) VALUES (?,?,?,?,?,?) ");

$query->bindParam(1, $slug);
$query->bindParam(2, $title);
$query->bindParam(3, $author);
$query->bindParam(4, $content);
$query->bindParam(5, $createdAt);
$query->bindParam(6, $image);
if ($insert = $query->execute()) {
    session_start();
    $_SESSION['id'] = $conn->lastInsertId();
}


if (isset($_POST['tags'])) {
    $id = $_SESSION['id'];
    $tag = $_POST['tags'];
    $count = count($tag);
    for ($i = 0; $i < $count; $i++) {
        $query = $conn->prepare("INSERT INTO  tags (articleid,tag_name) VALUES (?,?)");
        $query->bindParam(1, $id);
        $query->bindParam(2, $tag[$i]);

        if ($insert = $query->execute()) {

        } else {
            echo 'eror tags';
        }
    }
}
if (isset($_POST['categories'])) {
    $categories = $_POST['categories'];
    $query = $conn->query("SELECT * FROM categories where name='$categories'");
    $row =  $query->fetch();
    $catid = $row['id'];
    session_start();
    $id = $_SESSION['id'];
    $query = $conn->prepare("INSERT INTO article_categories (articleid,categoriesid) VALUES (?,?)");
    $query->bindParam(1,$id);
    $query->bindParam(2,$catid);
    if ( $insert = $query->execute()) {
        header('location:  article');
    } else {
        //todo
    }
}



