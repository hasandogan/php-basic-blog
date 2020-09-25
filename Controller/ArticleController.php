<?php

use src\repository\ArticleRepository;
use src\repository\CommentRepository;

class ArticleController extends AbstractController
{
    /**
     * HomepageController constructor.
     */
    public function show($slug)
    {
        return $slug;
    }

    public function result($slug)
    {
        if (!isset($slug)) {
            header('location:   /');
        }
        /** @var ArticleRepository  $articleRepository */
        $articleRepository = $this->getEntityManager()->getRepository(\src\entity\Article::class);

        return $articleRepository->findCompleteArticleDataArray($slug);
    }

    public function comments($id)
    {
        /** @var CommentRepository  $commentQuery */
        $commentQuery = $this->getEntityManager()->getRepository(\src\entity\Comments::class);
        return $commentQuery->findArticleComments($id);
    }
}