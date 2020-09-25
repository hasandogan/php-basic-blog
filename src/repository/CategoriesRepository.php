<?php


namespace src\repository;


use Doctrine\DBAL\Types\VarDateTimeImmutableType;
use Doctrine\ORM\EntityRepository;

class CategoriesRepository extends EntityRepository
{
    public function getCategoryFindName($pathname){
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder->select('c')
            ->from(\src\entity\Categories::class, 'c')
            ->where($queryBuilder->expr()->like('c.name', ':name'))
            ->setParameter(':name', $pathname);
        return $query->getQuery()->getResult();
    }
    public function getCategories(){
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder->select('c')
            ->from(\src\entity\Categories::class, 'c');
        return  $query->getQuery()->getResult();
    }
    public function getCategoriesfindBy($id){
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder = $queryBuilder->select('c')
            ->from(\src\entity\Categories::class, 'c')
            ->where($queryBuilder->expr()->eq('c.id', ':id'))
            ->setParameter(':id', $id);
      return  $categories = $queryBuilder->getQuery()->getSingleResult();
    }


}