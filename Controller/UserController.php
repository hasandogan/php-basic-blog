<?php


class UserController extends AbstractController
{
    public function login()
    {

    }

    public function logincheck()
    {
        $username = $_POST['username'];
        $pass = $_POST['password'];
        if ($username && $pass) {
            $password = md5($pass);
            /** @var \src\repository\UserRepository $query */
           $query = $this->getEntityManager()->getRepository(\src\entity\User::class);
            $query = $query->loginForUserCheck($username,$password);
            if (count($query) > 0) {
                $_SESSION['username'] = $username;
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
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $password = md5($pass);
        $em = $this->getEntityManager();
        $user = new \src\entity\User();
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setUsername($username);
        $user->setPass($password);
        $user->setEmail($email);
        $em->persist($user);
        $em->flush();
        /**
         * $ndewusere = $em->find(\src\entity\UserController::class,);
         * $user->setFirstname($firstname);
         * $user->setLastname($lastname);
         * $user->setUsername($username);
         * $user->setPass($password);
         * $user->setEmail($email);
         * $em->persist($user);
         * $em->flush();
         **/
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

    public function profileResult($username)
    {
        $username = $_SESSION['username'];
        /** @var \src\repository\UserRepository $query */
       $query = $this->getEntityManager()->getRepository(\src\entity\User::class);
       $query = $query->profileResult($username);

        /** @var \src\repository\CommentRepository $commentRepository */
        $commentRepository = $this->getEntityManager()->getRepository(\src\entity\Comments::class);
        /** @var \src\entity\Comments $row */
        $row = $commentRepository->getConfirmedComment($username);
        return [
            'row' => $row, 'user' => $query
        ];
    }

}