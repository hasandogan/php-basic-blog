<?php
require_once '../class/Article.php';
$article = new Article();
if (isset($_GET['add'])) {
    $article->add();
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $article->update($id);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $article->delete($id);
}
