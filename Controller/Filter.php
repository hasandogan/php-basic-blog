<?php

use Doctrine\DBAL\DriverManager;
use src\entity\Tags;
use src\repository\ArticleRepository;
use src\repository\ArticleCategoriesRepository;
use src\repository\TagsRepository;

class Filter extends AbstractController
{
    public function view()
    {

    }

    public function getArticleFromCategory($id = null)
    {
        if ($id != null) {
            /** @var ArticleCategoriesRepository $pathquery */

            $pathQuery = $this->getEntityManager()->getRepository(\src\entity\ArticleCategories::class);
            $pathResult = $pathQuery->getArticleCategories($id);
            if ($pathResult != null) {
                $articleIdList = [];
                foreach ($pathResult as $catrow) {
                    $articleId = $catrow['articleid'];
                    $articleIdList[] = $articleId;
                }
                $articleIdList = implode(",", $articleIdList);
                /** @var ArticleRepository $result */

                $result = $this->getEntityManager()->getRepository(\src\entity\Article::class);
                $result = $result->getArticleFindById($articleIdList);
                $category = $this->categoryList();
                if ($result != null) {
                    return ['article' => $result,
                        'category' => $category,

                    ];
                }
            }
        } else {
            $_SESSION['catEror'] = 'catError';
            /** @var ArticleRepository $query */

            $query = $this->getEntityManager()->getRepository(\src\entity\Article::class);
            $query = $query->getArticle();
            return [
                'article' => $query,
            ];

        }
    }


    public function tag($tagname)
    {
        /** @var TagsRepository $query */
        $queryRepository = $this->getEntityManager()->getRepository(Tags::class);
        $query = $queryRepository->getTagFindByName($tagname);
        $articleIdList = [];
        foreach ($query as $tagrow) {
            $articleId = $tagrow['articleid'];
            $articleIdList[] = $articleId;
        }
        $articleIdList = implode(",", $articleIdList);
        /** @var ArticleRepository $result */

        $result = $this->getEntityManager()->getRepository(\src\entity\Article::class);
        $articleResult = $result->getArticleFindById($articleIdList);

        $resultCount = count($articleResult);
        return [
            'article' => $result,
            'category' => $query,
            'totalCount' => $resultCount,
            'general' => $this->responseArray()

        ];
    }

    public function search()
    {
        if (isset($_POST['search'])) {
            /** @var ArticleRepository $query */
            $search = $_POST['search'];
            $query = $this->getEntityManager()->getRepository(\src\entity\Article::class);
            $query = $query->getArticleForSearch($search);
            var_dump();
            $count = count($query);
            if ($count > 0) {
                return $this->responseArray(['result' => $query, 'keyword' => $search,]);
            }
        }
        return $this->responseArray(['keyword' => $search,]);
    }

    public function searchView($article)
    {
        /** @var ArticleRepository $article */

        $article = $this->getEntityManager()->getRepository(\src\entity\Article::class);
        $article = $article->getArticleFindById($article);
        $count = count($article);
        return [
            'article' => $article,
            'totalCount' => $count
        ];
    }

    public function categoryList()
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder->select('c')->from(\src\entity\Categories::class, 'c');
        return ['category' => $query->getQuery()->getResult()];
    }

    public function categoryView()
    {
        $pathname = $this->getPathName(1);
        /** @var \src\repository\CategoriesRepository $result */
        $query = $this->getEntityManager()->getRepository(\src\entity\Categories::class);
        $result = $query->getCategoryFindName($pathname);
        $cid = $result[0]->getId();
        $articles = $this->getArticleFromCategory($cid);
        return $this->responseArray(['articles' => $articles, 'pathname'=> $pathname]);
    }


}