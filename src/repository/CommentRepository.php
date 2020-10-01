<?php


namespace src\repository;

use AbstractController;
use Doctrine\ORM\EntityRepository;
use src\entity\Comments;
use function Doctrine\ORM\QueryBuilder;

class CommentRepository extends EntityRepository
{
    public function findArticleComments($id)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $commentQuery = $queryBuilder->select('c')
            ->from(\src\entity\Comments::class, 'c')
            ->where($queryBuilder->expr()->eq('c.confirmed', '1'))
            ->andWhere($queryBuilder->expr()->eq('c.articleid', ':id'))
            ->setParameter(':id', $id)
            ->orderBy('c.id', 'DESC');

        return $commentQuery->getQuery()->getResult();
    }

    public function getConfirmedComment($username)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $row = $queryBuilder->select('c')
            ->from(\src\entity\Comments::class, 'c')
            ->where($queryBuilder->expr()->eq('c.username', ':username'))
            ->andWhere($queryBuilder->expr()->eq('c.confirmed', '1'))
            ->setParameter(':username', $username);
        return $row->getQuery()->getResult();
    }

    public function getCommentList()
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder = $queryBuilder->select('c')
            ->from(\src\entity\Comments::class, 'c')
            ->orderBy('c.id', 'DESC');
        return $comment = $queryBuilder->getQuery()->getResult();
    }

    public function commentLike($id)
    {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder();;
        $query = $query->select('c')
            ->from(Comments::class, 'c')
            ->where($query->expr()->eq('c.id', ':id'))
            ->setParameter(':id' ,$id);
        $query->getQuery()->getResult();
        /** @var Comments $query */
        $cid = $query->getId();
        return ['catid' =>  $cid];
    }

}