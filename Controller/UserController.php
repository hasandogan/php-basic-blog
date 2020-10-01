<?php


class UserController extends AbstractController
{
    public function login()
    {
        return null;
    }

    public function logincheck()
    {
        $userName = $_POST['username'];
        $pass = $_POST['password'];
        if ($userName && $pass) {
            $password = md5($pass);
            /** @var \src\repository\UserRepository $query */
           $query = $this->getEntityManager()->getRepository(\src\entity\User::class);
            $query = $query->loginForUserCheck($userName,$password);
            if (count($query) > 0) {
                $_SESSION['username'] = $userName;
                header('location: /');
            } else {
                header('location: /login');
                $_SESSION['loginerror'] = 'loginerror';
                header('location: /login');
            }
        }
    }


    public function logout()
    {

        unset($_SESSION['username']);
        session_write_close();
        header("Location: /");
    }

    public function register()
    {

    }

    public function registerCheck()
    {
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $userName = $_POST['username'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $password = md5($pass);
        $em = $this->getEntityManager();
        $user = new \src\entity\User();
        $user->setFirstname($firstName);
        $user->setLastname($lastName);
        $user->setUsername($userName);
        $user->setPass($password);
        $user->setEmail($email);
        $em->persist($user);
        $em->flush();
        if ($user->getId() > 0) {
            header('location: /');
        } else {
            $_SESSION['registererror'] = 'registererror';
            header('location: /register/');
        }
    }

    public function profile()
    {

    }

    public function profileResult()
    {
        $userName = $_SESSION['username'];
        /** @var \src\repository\UserRepository $query */
       $query = $this->getEntityManager()->getRepository(\src\entity\User::class);
       $result = $query->profileResult($userName);

        /** @var \src\repository\CommentRepository $commentRepository */
        $commentRepository = $this->getEntityManager()->getRepository(\src\entity\Comments::class);
        /** @var \src\entity\Comments $row */
        $row = $commentRepository->getConfirmedComment($userName);
        return [
            'row' => $row, 'user' => $result
        ];
    }

}