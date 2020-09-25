<?php


class ArticleController extends AbstractController
{
    public function show()
    {

    }

    public function list($id = null)
    {
        if ($id == null) {
            $query = $this->getEntityManager()->getRepository(\src\entity\Article::class);
            /** @var \src\repository\ArticleRepository $article */
            $article = $query->getArticle();
        } else {
            $query = $this->getEntityManager()->getRepository(\src\entity\Article::class);
            /** @var \src\repository\ArticleRepository $article */
            $article = $query->getArticleFindById($id);
        }
        return ['article' => $article];
    }

    public function add()
    {
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

        $em = $this->getEntityManager();
        $article = new \src\entity\Article();
        $date = new DateTime('now');
        $article->setSlug($slug);
        $article->setTitle($title);
        $article->setAuthor($author);
        $article->setContent($content);
        $article->setCreatedAt($date);
        $article->setImagePath($image);
        $em->persist($article);
        $em->flush();
        if ($article->getId() > 0) {
            $_SESSION['basarilikayit'] = 'basarili kayit';
            $_SESSION['id'] = $article->getId();

        }

        //todo
        /**
         * if (isset($_POST['tags'])) {
         * $id = $_SESSION['id'];
         * $tag[] = $_POST['tags'];
         * $em = $this->getEntityManager();
         * $tags = new \src\entity\Tags();
         * $tags->setArticleid($id);
         * foreach ($tag as $item) {
         * foreach ($item as $value){
         * $tags->setTagName($value);
         * }
         * $em->persist($tags);
         * }
         * $em->flush();
         * if ($tags->getId() > 0) {
         * } else {
         * echo 'eror tags';
         * }
         * }
         **/
        //todo
        if (isset($_POST['categories'])) {
            $categories = $_POST['categories'];

            $query = $this->getEntityManager()->getRepository(\src\entity\Categories::class);
            /** @var \src\repository\CategoriesRepository $catrow */
            $catRow = $query->getCategoryFindName($categories);
            /** @var \src\entity\Categories $value */
            foreach ($catRow as $value) {
                $catid = $value['id'];
                $id = $_SESSION['id'];
            }
            $articleCategories = new \src\entity\ArticleCategories();
            $articleCategories->setArticleid($id);
            $articleCategories->setCategoriesid($catid);
            $em->persist($articleCategories);
            $em->flush();

            if ($articleCategories->getId() > 0) {
                header('location:  /admin/article');
            } else {
                //todo
            }

        }

    }

    public function update()
    {
        $id = $_POST['id'];
        if (isset($_POST['categories'])) {
            $categories = $_POST['categories'];

            $query = $this->getEntityManager()->getRepository(\src\entity\Categories::class);
            /** @var \src\repository\CategoriesRepository $category */
            $category = $query->getCategoryFindName($categories);
            $em = $this->getEntityManager();
            /** @var \src\entity\ArticleCategories $articleCategory */
            $articleCategory = $em->getRepository(\src\entity\ArticleCategories::class)
                ->findOneBy(['articleid' => $id]);
            if ($articleCategory === null) {
                $articleCategory = new \src\entity\ArticleCategories();
                $articleCategory->setArticleid($id);
            }
            $catid = $category[0]->getId();
            /** @var \src\entity\Categories */
            $articleCategory->setCategoriesid($category[0]->getId());
            $em->persist($articleCategory);
            $em->flush();
        }
        $target_dir = "../../../img";
        $target_file = __DIR__ . $target_dir . DIRECTORY_SEPARATOR . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        try {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $image = $_FILES['fileToUpload']['name'];
            }
        } catch (Exception $e) {
        }
        if (isset($id)) {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $content = $_POST['content'];
            $date = new DateTime('now');
            if ($_FILES['fileToUpload']['name']) {
                var_dump("dddddd");
                $article = new \src\entity\Article();
                $em = $this->getEntityManager();
                /** @var \src\entity\Article $articleUpdate */
                $updateArticle = $em->find(\src\entity\Article::class, $id);
                $updateArticle->setTitle($title);
                $updateArticle->setAuthor($author);
                $updateArticle->setContent($content);
                $updateArticle->setUpdatedAt($date);
                $updateArticle->setImagePath($image);
                $em->persist($updateArticle);
                $em->flush();
                $_SESSION['basariliguncelleme'] = 'basarili guncelleme';
            } else {
                $em = $this->getEntityManager();

                /** @var \src\entity\Article $articleUpdate */


                $updateArticle = $em->find(\src\entity\Article::class, $id);
                $updateArticle->setTitle($title);
                $updateArticle->setAuthor($author);
                $updateArticle->setContent($content);
                $updateArticle->setUpdatedAt($date);
                $em->persist($updateArticle);
                $em->flush();
                $_SESSION['basariliguncelleme'] = 'basarili guncelleme';
                header('location: /admin/article');
            }
        }
        /**
         * if (isset($_POST['tags'])) {
         * $tag = $_POST['tags'];
         * $count = count($tag);
         * for ($i = 0; $i < $count; $i++) {
         * $query = $conn->prepare("INSERT INTO tags (articleid,tag_name) VALUES (?,?)");
         * $query->bindParam(1, $id);
         * $query->bindParam(2, $tag[$i]);
         * $query->execute();
         *
         * }
         * header('location: /admin/article');
         * } else {
         *
         * header('location: /admin/article');
         * }
         **/
    }

    public function delete($id)
    {
        $em = $this->getEntityManager();
        $article = $em->find(\src\entity\Article::class, $id);
        $em->remove($article);
        $em->flush();

        $_SESSION['basarilisilme'] = 'basarili silme';
        header('location: /admin/article');
    }
}