<?php
session_start();

class AbstractController
{
    private $conn;

    /**
     * AbstractController constructor.
     */
    public function __construct()
    {
        $this->connect();

    }

    /**
     * @return mixed
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * @param mixed $conn
     */
    private function setConn($conn)
    {
        $this->conn = $conn;
    }


    public function getDefaultParams()
    {
        $query = $this->getConn()->query("SELECT DISTINCT tag_name FROM tags ORDER BY tag_name DESC LIMIT 15;");
        $tags = $query->fetchAll();
        $categoryQuery = $this->getConn()->query("SELECT * FROM categories");
        $categories = $categoryQuery->fetchAll();

        return ['categories' => $categories, 'tags' => $tags];
    }

    public function connect()
    {
        try {
            $this->setConn(new PDO("mysql:host=localhost;dbname=blog", "root", "password"));
            $this->getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print $e->getMessage();
            exit;
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
}