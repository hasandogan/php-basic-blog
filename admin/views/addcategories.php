<?php
require 'adminlayout/header.php';
require 'adminlayout/sidebar.php';
?>
<form action="addcategories" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleFormControlInput1">categories</label>
        <input type="text" class="form-control" name="categoriesname" placeholder="name">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">pagetitle</label>
        <input type="text" class="form-control" name="pagetitle" placeholder="pagetitle">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">content</label>
        <input type="text" class="form-control" name="content" placeholder="content">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">metadesc</label>
        <input type="text" class="form-control" name="metadesc" placeholder="metadesc">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">metakey</label>
        <input type="text" class="form-control" name="metakey" placeholder="metakey">
    </div>
    <div class="form-group">
        <input type="submit">
    </div>

<?php require 'Layout/footer.php' ?>