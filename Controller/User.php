<?php


class User extends AbstractController
{
    public function login(){

    }

    public function logincheck () {

        $conn = $this->getConn();
        $username = $_POST['username'];
        $pass = $_POST['password'];
        if ($username && $pass) {
            $password = md5($pass);
            $query = $conn->query("SELECT * FROM user where username='$username' and  pass='$password'");
            $row =  $query->fetch();
            if (count($row) > 1) {
                $_SESSION['username'] = $username;
                header('location: /');
            } else {
                header('location: /login');
                $_SESSION['loginerror'] = 'loginerror';
                header('location: /login');
            }
        }
    }


    public function logout(){

        unset($_SESSION['username']);
        session_write_close();
        header("Location: /");
    }

    public function register(){

    }

    public function registerCheck(){
        $conn = $this->getConn();
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $password = md5($pass);


        $query = $conn->prepare("INSERT INTO user (firstname,lastname,username,pass,email) VALUES (?,?,?,?,?)");
        $query->bindParam(1, $firstname );
        $query->bindParam(2, $lastname );
        $query->bindParam(3, $username );
        $query->bindParam(4, $password);
        $query->bindParam(5, $email);

        if ($query->execute()) {
            header('location: /');
        } else {
            $_SESSION['registererror'] = 'registererror';
            header('location: /register/');
        }
    }
    public function profile (){


    }
    public function profileResult($username){
        $conn = $this->getConn();
        $username = $_SESSION['username'];

        $query = $conn->query("SELECT * FROM user where username='$username'");
        $user = $query->fetch();

        $query = $conn->query("SELECT * FROM comments where username='$username' and confirmed='1'");
        $row = $query->fetchAll();
        return [
            'row' => $row, 'totalCount' => $query->rowCount()
        ];
    }

}