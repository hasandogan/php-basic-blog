<?php


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


    public function connect (){
        try {
            $this->setConn(new PDO("mysql:host=localhost;dbname=blog", "root" ,"password"));
            $this->getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            print $e->getMessage();
            exit;
        }
    }


    public function validateTrimmedProperty($property){
        if(trim($property) === ''){
            $_SESSION['hatalikayit'] = 'Kayıt Başarısız.';
            header('location: /admin/admin');
        }

        return $property;
    }

}