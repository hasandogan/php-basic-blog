<?php


namespace src\repository;


use Doctrine\ORM\EntityRepository;

class AdminRepository extends EntityRepository
{
    public function adminList(){
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder = $queryBuilder->select('a')->from(\src\entity\Admin::class,'a');
        return  $result = $queryBuilder->getQuery()->getResult();
    }
    public function adminLoginCheck($username,$md5password){
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder->select('a')
            ->from(\src\entity\Admin::class, 'a')
            ->where($queryBuilder->expr()->eq('a.username', ':username'))
            ->andWhere($queryBuilder->expr()->eq('a.password', ':password'))
            ->setParameter(':username', $username)
            ->setParameter(':password', $md5password);
           return $query->getQuery()->getResult();
    }

}