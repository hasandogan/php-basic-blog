<?php

namespace src\repository;

use Doctrine\ORM\EntityRepository;
use src\entity\Tags;

class TagsRepository extends EntityRepository
{
    public function getTagFindByName($tagname)
    {
        $quryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $quryBuilder
            ->select('t')
            ->from(Tags::class, 't')
            ->where($quryBuilder->expr()->like('t.tagname', ':tagname'))
            ->setParameter(':tagname', '%' . $tagname . '%');
        return $query = $query->getQuery()->getArrayResult();
    }
    public function getFindArticleId($id){
        $quryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $quryBuilder
            ->select('t')
            ->from(Tags::class, 't')
            ->where($quryBuilder->expr()->like('t.articleid', ':articleid'))
            ->setParameter(':articleid', '%' . $id . '%');
        return $query = $query->getQuery()->getArrayResult();
    }
}