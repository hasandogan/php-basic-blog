<?php
class AdminLoginCheck extends AbstractController
{
    public function login()
    {

    }

    public function loginCheck()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $md5password = md5($password);
        $em = $this->getEntityManager();
        if ($username && $md5password)
        {

            $query = $this->getEntityManager()
                ->getRepository(\src\entity\Admin::class);
            /** @var \src\repository\AdminRepository $result */
            $result = $query->adminLoginCheck($username, $md5password);

            if (count($result) > 0)
            {

                /** @var \src\entity\Admin $row */
                foreach ($result as $row)
                {
                    $_SESSION['user_type'] = $row->getUserType();
                    $_SESSION['username'] = $row->getUsername();
                    $_SESSION['name'] = $row->getName();
                    $_SESSION['lastname'] = $row->getLastName();

                }
                header('location: /admin/');

            }
            else
            {
                $_SESSION['adminerror'] = 'adminerror';
                header('location: /admin/login');
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['user_type']);
        unset($_SESSION['name']);
        unset($_SESSION['lastname']);
        header("Location: /admin/login");
    }

}

