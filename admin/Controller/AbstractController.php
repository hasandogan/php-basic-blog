<?php
use Connection\Connection;

require_once "bootstrap.php";

class AbstractController
{
    public $entityManager;

    /**
     * AbstractController constructor.
     */
    public function __construct()
    {
        $connection = new Connection();
        $this->entityManager = $connection->entityManager;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function validateTrimmedProperty($property)
    {
        if (trim($property) === '')
        {
            $_SESSION['hatalikayit'] = 'Kayıt Başarısız.';
            header('location: /admin/admin');
        }

        return $property;
    }

}

