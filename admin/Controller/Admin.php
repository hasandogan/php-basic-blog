<?php

session_start();

class Admin extends AbstractController
{
    public function login(){

    }
    public function add(){

        $conn = $this->getConn();
        $name = $this->validateTrimmedProperty($_POST['name']);
        $lastName = $this->validateTrimmedProperty($_POST['lastname']);
        $userType = $this->validateTrimmedProperty($_POST['usertype']);
        $userName = $this->validateTrimmedProperty($_POST['username']);
        $password = $_POST['password'];
        $pass = md5($password);

        try {
            $query = $conn->prepare("INSERT INTO admin (username,password,user_type,name,lastname) VALUES (?,?,?,?,?) ");
            $query->bindParam(1, $userName);
            $query->bindParam(2, $pass);
            $query->bindParam(3, $userType);
            $query->bindParam(4, $name);
            $query->bindParam(5, $lastName);
            $query->execute();
            $_SESSION['basarilikayit'] = 'basarili kayit';
            header('location: /admin/admin');
        }catch (Exception $exception){
            var_dump($exception->getMessage());
            exit;
        }
    }

    public function delete($id){
    $conn = $this->getConn();
        try {
            $query = $conn->prepare("DELETE FROM admin where id='$id'");
            $query->execute();
            $_SESSION['basarilisilme'] = 'basarili silme';
            header('location: /admin/admin');
        }catch (Exception $exception){
            var_dump($exception->getMessage());
        }

    }

}