<?php


namespace src\repository;


use AbstractController;
use Doctrine\ORM\EntityRepository;

class ArticleCategoriesRepository extends EntityRepository
{
    public function getArticleCategories($id)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $pathQuery = $queryBuilder->select('ac')
            ->from(\src\entity\ArticleCategories::class, 'ac')
            ->where($queryBuilder->expr()->like('ac.categoriesid', ':categoriesid'))
            ->setParameter(':categoriesid', '%' . $id . '%')
            ->orderBy('ac.categoriesid', 'DESC')
            ->setMaxResults(10);
        return $pathQuery->getQuery()->getArrayResult();

    }


}