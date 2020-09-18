<?php


class Categories extends AbstractController
{

    public function show(){
    }
    public function list($id = null){
        $conn = $this->getConn();
        if ($id == null){
        $query = $conn->query("SELECT * FROM categories");
        $categories = $query->fetchAll();
        }else{
            $query = $conn->query("SELECT * FROM categories where id='$id' ");
            $categories = $query->fetchAll();
        }
        return  ['category' => $categories, 'totalCount' => $query->rowCount()];
    }

    public function add()
    {
        $conn = $this->getConn();

        $cate = $_POST['categoriesname'];
        $pagetitle = $_POST['pagetitle'];
        $content = $_POST['content'];
        $metadescc = $_POST['metadesc'];
        $metakey = $_POST['metakey'];
        $query = $conn->prepare("INSERT INTO categories set 
        name = ?, 
        page_title = ?, 
        content = ?,
        meta_desc = ?,
        meta_key = ?
        ");
        $insert = $query->execute(array(
            "$cate", "$pagetitle", "$content", "$metadescc", "$metakey"
        ));
        if ($insert) {
            $_SESSION['basarilikayit'] = 'basarili kayit';
            header('location: /admin/categories');
        }

    }

    public function update()
    {
        $conn = $this->getConn();
        $id = $_POST['id'];

        $cate = $_POST['categories'];
        $pageTitle = $_POST['pagetitle'];
        $content = $_POST['content'];
        $metaDesc = $_POST['metadesc'];
        $metaKey = $_POST['metakey'];
        $query = $conn->prepare ("UPDATE categories SET  name = ?,page_title = ?,content = ?,meta_desc = ?,meta_key = ? WHERE id='$id' ");
        $insert = $query->execute(array(
            "$cate", "$pageTitle", "$content", "$metaDesc", "$metaKey"
        ));
        if ($insert) {
            $_SESSION['basariliguncelleme'] = 'basarili guncelleme';
            header('location: /admin/categories');
        }
    }

    public function delete($id)
    {
        $conn = $this->getConn();
        $query = $conn->prepare("DELETE FROM categories where id ='$id'");
        $insert = $query->execute();
        if ($insert) {
            $_SESSION['basarilisilme'] = 'basarili silme';
            header('location:/admin/categories ');
        } else {
            echo "Error:delete " . PDOException::class . "<br>";
        }

    }

}