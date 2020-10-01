<?php

class ArticleController extends AbstractController
{

    public function show($id = null)
    {

        $categoryQuery = $this->getEntityManager()
            ->getRepository(\src\entity\Categories::class);
        $category = $categoryQuery->getCategories();
        $query = $this->getEntityManager()
            ->getRepository(\src\entity\Article::class);
        $article = $query->getArticle(10);

        return ['article' => $article, 'categories' => $category];
    }

    public function edit()
    {
        $path = $_SERVER['REQUEST_URI'];
        $path = substr($path, 1);
        $pathArray = explode('/', $path);
        $pathname = $pathArray[2];
        $query = $this->getEntityManager()
            ->getRepository(\src\entity\Article::class);
        $article = $query->getArticleFindById($pathname);
        $categoryQuery = $this->getEntityManager()
            ->getRepository(\src\entity\Categories::class);
        /** @var \src\repository\CategoriesRepository $categoryQuery */
        $categories = $categoryQuery->getCategories();
        return ['article' => $article, 'categories' => $categories];
    }

    public function add()
    {
        $target_dir = "/../../img";
        $target_file = __DIR__ . $target_dir . DIRECTORY_SEPARATOR . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        try
        {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
            {
                $image = $_FILES['fileToUpload']['name'];
            }
            else
            {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        catch(Exception $e)
        {
        }
        function replace_tr($text)
        {
            $text = trim($text);
            $search = array(
                'Ç',
                'ç',
                'Ğ',
                'ğ',
                'ı',
                'İ',
                'Ö',
                'ö',
                'Ş',
                'ş',
                'Ü',
                'ü',
                ' '
            );
            $replace = array(
                'c',
                'c',
                'g',
                'g',
                'i',
                'i',
                'o',
                'o',
                's',
                's',
                'u',
                'u',
                '-'
            );
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
        if ($article->getId() > 0)
        {
            $_SESSION['basarilikayit'] = 'basarili kayit';
            $_SESSION['id'] = $article->getId();

        }

        //todo
        if (isset($_POST['tags']))
        {
            $id = $_SESSION['id'];
            $tag[] = $_POST['tags'];
            $em = $this->getEntityManager();
            $tags = new \src\entity\Tags();
            $tags->setArticleid($id);
            foreach ($tag[0] as $value)
            {
                $tags->setArticleid($id);
                $tags->setTagName($value);
                $em->persist($tags);
                $em->flush();
                $em->clear();
            }
        }

        if (isset($_POST['categories']))
        {
            $categories = $_POST['categories'];
            $query = $this->getEntityManager()
                ->getRepository(\src\entity\Categories::class);
            /** @var \src\repository\CategoriesRepository $catrow */
            $catRow = $query->getCategoryFindName($categories);
            /** @var \src\entity\Categories $value */
            foreach ($catRow as $value)
            {
                $catid = $value->getId();
                $id = $_SESSION['id'];
            }
            $articleCategories = new \src\entity\ArticleCategories();
            $articleCategories->setArticleid($id);
            $articleCategories->setCategoriesid($catid);
            $em->persist($articleCategories);
            $em->flush();

            if ($articleCategories->getId() > 0)
            {
                header('location:  /admin/article');
            }
            else
            {
                //todo

            }

        }

    }

    public function update()
    {
        $id = $_POST['id'];
        if (isset($_POST['categories']))
        {
            $categories = $_POST['categories'];

            $query = $this->getEntityManager()
                ->getRepository(\src\entity\Categories::class);
            /** @var \src\repository\CategoriesRepository $category */
            $category = $query->getCategoryFindName($categories);
            $em = $this->getEntityManager();
            /** @var \src\entity\ArticleCategories $articleCategory */
            $articleCategory = $em->getRepository(\src\entity\ArticleCategories::class)
                ->findOneBy(['articleid' => $id]);
            if ($articleCategory === null)
            {
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
        try
        {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
            {
                $image = $_FILES['fileToUpload']['name'];
            }
        }
        catch(Exception $e)
        {
        }
        if (isset($id))
        {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $content = $_POST['content'];
            $date = new DateTime('now');
            if ($_FILES['fileToUpload']['name'])
            {
                $em = $this->getEntityManager();
                /** @var \src\entity\Article $articleUpdate */
                $updateArticle = $em->find(\src\entity\Article::class , $id);
                $updateArticle->setTitle($title);
                $updateArticle->setAuthor($author);
                $updateArticle->setContent($content);
                $updateArticle->setUpdatedAt($date);
                $updateArticle->setImagePath($image);
                $em->persist($updateArticle);
                $em->flush();
                $_SESSION['basariliguncelleme'] = 'basarili guncelleme';
            }
            else
            {
                $em = $this->getEntityManager();

                /** @var \src\entity\Article $articleUpdate */

                $updateArticle = $em->find(\src\entity\Article::class , $id);
                $updateArticle->setTitle($title);
                $updateArticle->setAuthor($author);
                $updateArticle->setContent($content);
                $updateArticle->setUpdatedAt($date);
                $em->persist($updateArticle);
                $em->flush();
                $_SESSION['basariliguncelleme'] = 'basarili guncelleme';
            }
        }
        if (isset($_POST['tags']))
        {

            $id = $_POST['id'];
            $tag[] = $_POST['tags'];
            $em = $this->getEntityManager();
            $tags = new \src\entity\Tags();
            $tags->setArticleid($id);
            /** @var \src\repository\TagsRepository $removeTag */
            foreach ($tag[0] as $value)
            {
                $tags->setArticleid($id);
                $tags->setTagName($value);
                $em->persist($tags);
                $em->flush();
                $em->clear();
            }
            header('location: /admin/article');

        }
        else
        {
            header('location: /admin/article');
        }
    }

    public function delete($id)
    {
        $em = $this->getEntityManager();
        $article = $em->find(\src\entity\Article::class , $id);
        $em->remove($article);
        $em->flush();

        $_SESSION['basarilisilme'] = 'basarili silme';
        header('location: /admin/article');
    }
}

