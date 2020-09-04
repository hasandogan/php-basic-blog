<?php
include '../connect.php';
require 'layout/header.php';
require 'layout/sidebar.php';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM categories where id='$id'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);


} else {

    header('loaction: admin/index.php');
}

?>

<form action="conf/categories.php?edit=<?php echo $row['id']?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleFormControlInput1">categories</label>
        <input type="text" class="form-control" name="categories" value="<?php echo $row['categories'] ?>" placeholder="name">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">pagetitle</label>
        <input type="text" class="form-control" name="pagetitle" value="<?php echo $row['page_title'] ?>" placeholder="pagetitle">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">content</label>
        <input type="text" class="form-control" name="content" value="<?php echo $row['content'] ?>" placeholder="content">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">metadesc</label>
        <input type="text" class="form-control" name="metadesc" value="<?php echo  $row['meta_desc']?>" placeholder="metadesc">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">metakey</label>
        <input type="text" class="form-control" name="metakey" value="<?php echo $row['meta_key'] ?>" placeholder="metakey">
    </div>
    <div class="form-group">
        <input type="submit">
    </div>

<?php require 'layout/footer.php' ?>