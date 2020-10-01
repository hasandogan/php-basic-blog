<?php

class CommentController extends AbstractController
{

    public function addComment()
    {
        $userName = $_POST['username'];
        $id = $_POST['id'];
        $content = $_POST['commentcontent'];
        $title = $_POST['slug'];
        $date = new DateTime('now');
        $comment = new \src\entity\Comments();
        $em = $this->getEntityManager();
        $comment->setUsername($userName);
        $comment->setCreatedat($date);
        $comment->setContent($content);
        $comment->setArticleid($id);
        $comment->setArticletitle($title);
        $em->persist($comment);
        $em->flush();
        header('location: /article/'.$title);

    }

}