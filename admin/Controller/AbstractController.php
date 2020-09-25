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
        if (trim($property) === '') {
            $_SESSION['hatalikayit'] = 'Kayıt Başarısız.';
            header('location: /admin/admin');
        }

        return $property;
    }

    public function timeAgo($time)
    {
        $time_difference = time() - $time;

        if ($time_difference < 1) {
            return '1 saniye önce';
        }
        $condition = array(12 * 30 * 24 * 60 * 60 => 'Yıl',
            30 * 24 * 60 * 60 => 'Ay',
            24 * 60 * 60 => 'Gün',
            60 * 60 => 'Saat',
            60 => 'Dakika',
            1 => 'Saniye'
        );

        foreach ($condition as $secs => $str) {
            $d = $time_difference / $secs;

            if ($d >= 1) {
                $t = round($d);
                return ' ' . $t . ' ' . $str . ' önce';
            }
        }
    }


}