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
        $connection =  new Connection\Connection();
        $this->entityManager = $connection->entityManager;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function getDefaultParams()
    {
        $querBuilder = $this->entityManager->createQueryBuilder();
        $query = $querBuilder->select('DISTINCT t.tagname')
            ->from(\src\entity\Tags::class, 't')
            ->orderBy('t.tagname', 'DESC')
            ->setMaxResults(15);
        $tags = $query->getQuery()->getArrayResult();

        $querBuilder = $this->entityManager->createQueryBuilder();
        $categoryQuery = $querBuilder->select('c')
            ->from(\src\entity\Categories::class, 'c');
        $categories = $categoryQuery->getQuery()->getArrayResult();
        $tagCount = count($tags);
        if ($tagCount>0){
            return ['categories' => $categories, 'tags' => $tags, 'tagCount'=> $tagCount];

        }

    }


    public function responseArray(array $array)
    {
        $array['general'] = $this->getDefaultParams();
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

    public function timeAgo($time)
    {
        $time_difference = time() - $time;

        if ($time_difference < 1) {
            return 'less than 1 second ago';
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