<?php

namespace Connection;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

class Connection
{
    public $entityManager;

    public function __construct()
    {
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/entity"), true, $proxyDir, $cache, $useSimpleAnnotationReader);

        $conn = array(
            'url' => 'mysql://root:password@localhost/blog',
        );

        $this->entityManager = EntityManager::create($conn, $config);
    }

    /**
     * @return mixed
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

}