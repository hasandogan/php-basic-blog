<?php
require_once '../class/Categories.php';
$id = $_POST['id'];
$edit = $_POST['id'];
$categories = new Categories();
if (isset($_POST['categoriesname'])) {
    $categories->add();
}
if ($edit != null) {
    $categories->update($id);
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $categories->delete($id);
}
