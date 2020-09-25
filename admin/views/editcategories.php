<?php
require 'adminlayout/sidebar.php';
$path = $_SERVER['REQUEST_URI'];
$path = substr($path, 1);
$pathArray = explode('/', $path);
$id = $pathArray[2];

if (isset($id)) {
    $category = new CategoriesController();
    $value = $category->list($id);
    $row = $value['category'];
} else {
    header('location: /admin');
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SB Admin 2 - Dashboard</title>
        <title></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="../css/sb-admin-2.css" rel="stylesheet">
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    </head>
<form action="/admin/updatecategories/" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $row->getId() ?>">
    <div class="form-group">
        <label for="exampleFormControlInput1">categories</label>
        <input type="text" class="form-control" name="categories" value="<?php echo $row->getName() ?>"
               placeholder="name">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">pagetitle</label>
        <input type="text" class="form-control" name="pagetitle" value="<?php echo $row->getPageTitle() ?>"
               placeholder="pagetitle">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">content</label>
        <input type="text" class="form-control" name="content" value="<?php echo $row->getContent() ?>"
               placeholder="content">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">metadesc</label>
        <input type="text" class="form-control" name="metadesc" value="<?php echo $row->getMetaDesc() ?>"
               placeholder="metadesc">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">metakey</label>
        <input type="text" class="form-control" name="metakey" value="<?php echo $row->getMetaKey() ?>"
               placeholder="metakey">
    </div>
    <div class="form-group">
        <input type="submit">
    </div>


<?php require 'Layout/footer.php' ?>