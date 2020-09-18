<?php


class Article extends AbstractController
{
    public function show()
    {

    }
    public function list($id = null){
        $conn = $this->getConn();
        if ($id == null){
        $query = $conn->query("SELECT * FROM article");
        $article = $query->fetchAll();
        }else{
            $query = $conn->query("SELECT * FROM article WHERE id='$id'");
            $article = $query->fetchAll();
        }
        return ['article' => $article, 'totalCount' => $query->rowCount()];
    }

    public function add()
    {
        $conn = $this->getConn();
        $target_dir = "/../../img";
        $target_file = __DIR__ . $target_dir . DIRECTORY_SEPARATOR . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        try {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $image = $_FILES['fileToUpload']['name'];
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } catch (Exception $e) {
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
        $titleconverted = mb_strtolower($titleConvertSlug);
        $slug = replace_tr($titleconverted);
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
            $_SESSION['basarilikayit'] = 'basarili kayit';
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
            $row = $query->fetch();
            $catid = $row['id'];
            $id = $_SESSION['id'];

            $query = $conn->prepare("INSERT INTO article_categories (articleid,categoriesid) VALUES (?,?)");
            $query->bindParam(1, $id);
            $query->bindParam(2, $catid);
            if ($insert = $query->execute()) {
                header('location:  /admin/article');
            } else {
                //todo
            }

        }

    }
    public function update()
    {
        $id = $_POST['id'];
        $conn = $this->getConn();
        if (isset($_POST['categories'])) {
            $categories = $_POST['categories'];
            $catquery = $conn->query("SELECT * FROM categories WHERE name='$categories'");
            $cat = $catquery->fetch();
            $cid = $cat['id'];
            $query = $conn->query("UPDATE article_categories SET categoriesid='$cid' where articleid='$id' ");
            $query->execute();
        }
        $target_dir = "../../../img";
        $target_file = __DIR__ . $target_dir . DIRECTORY_SEPARATOR . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        try {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $image = $_FILES['fileToUpload']['name'];
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } catch (Exception $e) {
        }
        if (isset($id)) {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $content = $_POST['content'];
            $date = date('Y-m-d H:i:s');
            if ($_FILES['fileToUpload']['name']) {
                $query = $conn->prepare("UPDATE article SET title=?, author=?, content=?, updateAt=?, image_path=?  WHERE id='$id'");
                $query->bindParam(1, $title);
                $query->bindParam(2, $author);
                $query->bindParam(3, $content);
                $query->bindParam(4, $date);
                $query->bindParam(5, $image);
                $query->execute();
                $_SESSION['basariliguncelleme'] = 'basarili guncelleme';
            } else {
                $query = $conn->prepare("UPDATE article SET title=?, author=?, content=?, updateAt=? WHERE id='$id'");
                $query->bindParam(1, $title);
                $query->bindParam(2, $author);
                $query->bindParam(3, $content);
                $query->bindParam(4, $date);
                $query->execute();
                $_SESSION['basariliguncelleme'] = 'basarili guncelleme';
            }
        }
        if (isset($_POST['categories'])) {
            $categories = $_POST['categories'];
            $query = $conn->query("SELECT * FROM categories where name='$categories'");
            $cat = $query->fetch();
            $cid = $cat['id'];
            $query = $conn->prepare("INSERT INTO article_categories (articleid,categoriesid) VALUES (?,?)");
            $query->bindParam(1, $id);
            $query->bindParam(2, $cid);
            $query->execute();

        }
        if (isset($_POST['tags'])) {
            $tag = $_POST['tags'];
            $count = count($tag);
            for ($i = 0; $i < $count; $i++) {
                $query = $conn->prepare("INSERT INTO tags (articleid,tag_name) VALUES (?,?)");
                $query->bindParam(1, $id);
                $query->bindParam(2, $tag[$i]);
                $query->execute();

            }
            header('location: /admin/article');
        } else {

            header('location: /admin/article');
        }
    }

    public function delete($id)
    {
        $conn = $this->getConn();
        $query = $conn->prepare("DELETE FROM article WHERE id='$id'");
        $insert = $query->execute();
        if ($insert) {
            $_SESSION['basarilisilme'] = 'basarili silme';
            header('location: /admin/article');
        }
    }
}