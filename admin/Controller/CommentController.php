<?php

class CommentController extends AbstractController
{


    public function show()
    {

    }

    public function list()
    {
        $query = $this->getEntityManager()->getRepository(\src\entity\Comments::class);
        $comment = $query->getCommentList();

        return ['comment' => $comment];
    }

    public function confirmed($id)
    {
        $em = $this->getEntityManager();
        $confirmed = $em->find(\src\entity\Comments::class, $id);
        $confirmed->setConfirmed(1);
        $em->persist($confirmed);
        $em->flush();
        header('location: /admin/view-comment');
    }

    public function delete($id)
    {
        $em = $this->getEntityManager();
        $delete = $em->find(\src\entity\Comments::class, $id);
        $em->remove($delete);
        $em->flush();
        header('location: /admin/view-comment');
    }


}