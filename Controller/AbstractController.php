<?php
require_once "bootstrap.php";

class AbstractController
{

    public $entityManager;

    /**
     * AbstractController constructor.
     */
    public function __construct()
    {
        $connection = new Connection\Connection();
        $this->entityManager = $connection->entityManager;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function getCategories()
    {
        $querBuilder = $this->entityManager->createQueryBuilder();
        $categoryQuery = $querBuilder->select('c')
            ->from(\src\entity\Categories::class, 'c');
        return $categoryQuery->getQuery()->getResult();
    }


    public function getTags()
    {
        $querBuilder = $this->entityManager->createQueryBuilder();
        $query = $querBuilder->select('DISTINCT t.tagname')
            ->from(\src\entity\Tags::class, 't')
            ->orderBy('t.tagname', 'ASC')
            ->setMaxResults(20);
        return $query->getQuery()->getResult();
    }

    public function responseArray(array $array)
    {
        $array['general'] = [];
        $array['general']['categories'] = $this->getCategories();
        $array['general']['tags'] = $this->getTags();
        return $array;
    }

    public function getPathName($index)
    {

        $path = $_SERVER['REQUEST_URI'];
        $path = substr($path, 1);
        $pathArray = explode('/', $path);
        $pathname = $pathArray[$index];

        return $pathname;
    }




}