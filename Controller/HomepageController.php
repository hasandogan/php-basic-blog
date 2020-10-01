<?php

use Doctrine\DBAL\DriverManager;

class HomepageController extends AbstractController
{
    /**
     * HomepageController constructor.
     */
    public function index()
    {

        /** @var \src\repository\ArticleRepository $articleRepository */
        $articleRepository = $this->getEntityManager()->getRepository(\src\entity\Article::class);
        $articles = $articleRepository->getArticle(10);
        return $this->responseArray(['articles'=>$articles]);
    }


}