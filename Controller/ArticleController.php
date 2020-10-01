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
        $em = $this->getEntityManager();
        $query = $em->getRepository(\src\entity\Article::class);
        /** @var ArticleRepository $query */
        $article = $query->findCompleteArticleDataArray($slug);
        $cid = $article['article']->getId();
        $comment = $em->getRepository(\src\entity\Comments::class);
        /** @var CommentRepository $comments */
        $comments = $comment->findArticleComments($cid);
        return [
            'article' => $article,
            'comment' => $comments
        ];
    }

    public function result($slug)
    {
        if (!isset($slug)) {
            header('location:   /');
        }
        /** @var ArticleRepository $articleRepository */
        $articleRepository = $this->getEntityManager()->getRepository(\src\entity\Article::class);

        return $articleRepository->findCompleteArticleDataArray($slug);
    }

    public function comments($id)
    {
        /** @var CommentRepository $commentQuery */
        $commentQuery = $this->getEntityManager()->getRepository(\src\entity\Comments::class);
        return $commentQuery->findArticleComments($id);
    }
}