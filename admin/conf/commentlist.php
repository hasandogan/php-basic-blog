<?php
$id = $_GET['id'];

if (isset($id)){
    require_once '../class/Comment.php';
    $confirmed = new Comment();
    $confirmed->confirmed($id);
}
if (isset($_GET['delete'])){
    require_once '../class/Comment.php';
    $id = $_GET['delete'];
    $delete = new Comment();
    $delete->delete($id);

}

