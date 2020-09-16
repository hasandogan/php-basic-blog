<?php
require_once '../class/AbstractController.php';
session_start();
class AdminLoginCheck extends AbstractController
{
    public function login(){

    }
    public function loginCheck (){
        $conn = $this->getConn();
            $username = $_POST['username'];
            $password = $_POST['password'];
            $md5password =  md5($password);

        if ($username && $password) {

                $query = $conn->query("SELECT * FROM admin WHERE username='$username' and  password='$md5password'");
                $row = $query->fetch();

                if ( $row !== false){
                    $_SESSION['user_type'] = $row['user_type'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['admingiris'] = 'admingiris';
                    header('location: /admin/');

                } else {
                    $_SESSION['adminerror'] = 'adminerror';
                    header('location: /admin/login');
                }
            }
        }
        public function logout(){

            unset($_SESSION['user_type']);
            header("Location: /admin/login");
        }

}