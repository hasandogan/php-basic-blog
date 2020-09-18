<?php

class Filter extends AbstractController
{
    public function view()
    {

    }

    public function getArticleFromCategory($id = null)
    {
        $conn = $this->getConn();

        $pathquery = $conn->query("SELECT * FROM article_categories where categoriesid='$id' ORDER BY id DESC LIMIT 10");
        $pathquery = $pathquery->fetchAll();
        if ($pathquery != null) {
            $articleIdList = [];
            foreach ($pathquery as $catrow) {
                $articleId = $catrow['articleid'];
                $articleIdList[] = $articleId;
            }

            $articleIdList = implode(",", $articleIdList);
            $query = $conn->query("SELECT * FROM article where id in (" . $articleIdList . ")");
            $category = $this->categoryList();
            if ($query != null) {
                return ['article' => $query->fetchAll(), 'totalCount' => $query->rowCount(), 'category' => $category];
            }
        } else {
            $_SESSION['catEror'] = 'catError';
            $query = $conn->query("SELECT * FROM article order by id desc LIMIT 10");
            return ['article' => $query, 'totalCount' => $query->rowCount()];
        }
    }


    public function tag($tagname)
    {
        $conn = $this->getConn();
        $query = $conn->query("SELECT * FROM tags where tag_name LIKE '%$tagname%'");
        if ($query->rowCount()) {
            $articleIdList = [];
            foreach ($query as $tagrow) {
                $articleId = $tagrow['articleid'];
                $articleIdList[] = $articleId;
            }
        }
        $articleIdList = implode(",", $articleIdList);
        $query = $conn->query("SELECT * FROM article where id in (" . $articleIdList . ")");
        return $this->responseArray(['article' => $query, 'totalCount' => $query->rowCount()]);
    }

    public function search()
    {
        $conn = $this->getConn();
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $query = $conn->query("SELECT * FROM article WHERE id LIKE '%".$search."%' OR title LIKE '%".$search."%' OR content LIKE '%".$search."%'");
            if ($query->rowCount() > 0) {
                return [
                    'results' => $query->fetchAll(),
                    'keyword'=> $search,
                    'general' => $this->getDefaultParams()
                ];
            }
        }
        return [
            'results' => [],
            'keyword'=> $search,
            'general' => $this->getDefaultParams()
        ];
    }

    public function searchView($article)
    {
        $conn = $this->getConn();
        $query = $conn->query("SELECT * FROM article where id in (" . $article . ")");
        return $this->responseArray(['article' => $query, 'totalCount' => $query->rowCount()]);
    }
    public function categoryList(){
        $conn = $this->getConn();
        $query = $conn->query("SELECT * FROM categories");
        $category = $query->fetchAll();
        return $category;
    }
    public function categoryView($pathname){
        $conn = $this->getConn();
        $query = $conn->query("select * FROM categories where name LIKE '%$pathname%'");
        $catrow = $query->fetch();
        return [
            'category' => $catrow
        ];
    }

}