<?php

$link = mysqli_connect("localhost", "root", "password", "blog");
$target_dir = "img";
$target_file = $target_dir .DIRECTORY_SEPARATOR. basename($_FILES["fileToUpload"]["name"]);
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
function replace_tr($text) {
    $text = trim($text);
    $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
    $replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
    $new_text = str_replace($search,$replace,$text);
    return $new_text;
}
$imagearticle = $image;
$title = $_POST['title'];
$converter  = explode(' ', $title);
$titleConvertSlug = implode ('-',$converter);
$slug = replace_tr($titleConvertSlug);

$author = $_POST['author'];
$content = $_POST['content'];
$createdAt = date('Y-m-d H:i:s');
$sqlarticle = "INSERT INTO article (slug, title, author, content, createdAt , image_path )VALUES('$slug','$title', '$author','$content','$createdAt','$imagearticle')";
if (mysqli_query($link, $sqlarticle)) {
    session_start();
    $_SESSION['id'] = mysqli_insert_id($link);
} else {
    echo "Error: " . $sqlarticle . "<br>" . mysqli_error($link);
}

if (isset($_POST['tags'])) {
    $id = $_SESSION['id'];
    $tag = $_POST['tags'];
    $count = count($tag);
    for ($i = 0; $i < $count; $i++) {
        $sql = "INSERT INTO tags (articleid,tag_name)VALUES ('$id','$tag[$i]')";
        if (mysqli_query($link, $sql)) {
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }

    }
}
if (isset($_POST['categories'])) {
    $categories = $_POST['categories'];
    $sql = "SELECT * FROM categories where categories='$categories'";
    $cateresult = mysqli_query($link, $sql);
    $catrow = mysqli_fetch_array($cateresult);
    $catid = $catrow['id'];
    session_start();
    $id = $_SESSION['id'];
    $articlecategories = "INSERT INTO article_categories (articleid,categoriesid)VALUES ('$id','$catid')";
    if (mysqli_query($link, $articlecategories)) {
        header('location:  article');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}



