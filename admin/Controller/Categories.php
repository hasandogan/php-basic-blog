<?php
require_once 'AbstractController.php';


class Categories extends AbstractController
{
    public function add()
    {
        $conn = $this->getConn();
        $cate = $_POST['categoriesname'];
        $pagetitle = $_POST['pagetitle'];
        $content = $_POST['content'];
        $metadescc = $_POST['metadesc'];
        $metakey = $_POST['metakey'];
        $query = $conn->prepare( "INSERT INTO categories set 
        name = ?, 
        page_title = ?, 
        content = ?,
        meta_desc = ?,
        meta_key = ?
        ");
        $insert = $query->execute(array(
            "$cate","$pagetitle","$content","$metadescc","$metakey"
        ));
        if ($insert){
            header('location: /admin/categories');
        }

    }
    public  function update($id){
        $conn = $this->getConn();
        $cate = $_POST['categories'];
        $pagetitle = $_POST['pagetitle'];
        $content = $_POST['content'];
        $metadescc = $_POST['metadesc'];
        $metakey = $_POST['metakey'];
        $query = $conn->prepare( "UPDATE categories SET 
                name = ?, 
                page_title = ?,
                content = ?,
                meta_desc = ?,
                meta_key = ?, 
                WHERE id = ?
                ");
        $insert = $query->execute(array(
            "$cate","$pagetitle","$content","$metadescc","$metakey","$metakey","$id"
        ));

        if ($insert){
            header('location: /admin/');
        }else {
            echo "Error:edit " . PDOException::class . "<br>";
        }
    }
    public  function  delete ($id) {
        $conn = $this->getConn();
        $query = $conn->prepare("DELETE FROM categories where id ='$id'");
        $insert = $query->execute();
        if ($insert) {
            header('location:/admin/categories ');
        } else {
            echo "Error:delete " . PDOException::class . "<br>";
        }

    }

}