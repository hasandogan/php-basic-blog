<?php


namespace src\repository;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function loginForUserCheck($username, $password)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder->select('u')
            ->from(\src\entity\User::class, 'u')
            ->where($queryBuilder->expr()->eq('u.username', ':username'))
            ->andWhere($queryBuilder->expr()->eq('u.pass', ':password'))
            ->setParameter(':username', $username)
            ->setParameter(':password', $password);
        return $query->getQuery()->getResult();
    }

    public function profileResult($username)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();
        $query = $queryBuilder->select('u')
            ->from(\src\entity\User::class, 'u')
            ->where($queryBuilder->expr()->eq('u.username', ':username'))
            ->setParameter(':username', $username);
        return $query->getQuery()->getResult();
    }

    public function userList()
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder = $queryBuilder->select('u')->from(\src\entity\User::class, 'u');
      return  $user = $queryBuilder->getQuery()->getResult();

    }
}