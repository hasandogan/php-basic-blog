<?php


use src\repository\AdminRepository;

class AdminController extends AbstractController
{
    public function show(){

    }
    public function list(){
        $em = $this->getEntityManager();
        $query = $em->getRepository(\src\entity\Admin::class);
        /** @var AdminRepository $admin */
        $admin = $query->adminList();
         return ['admin' => $admin,];
    }
    public function add(){
        $name = $_POST['name'];
        $lastName = $_POST['lastname'];
        $userType = $_POST['usertype'];
        $userName = $_POST['username'];
        $password = $_POST['password'];
        $pass = md5($password);

        try {
            $em = $this->getEntityManager();
            $admin =  new \src\entity\Admin();
            $admin->setUsername($userName);
            $admin->setPassword($pass);
            $admin->setUserType($userType);
            $admin->setName($name);
            $admin->setLastname($lastName);
            $em->persist($admin);
            $em->flush();
            $_SESSION['basarilikayit'] = 'basarili kayit';
            header('location: /admin/view-AdminController');
        }catch (Exception $exception){
            var_dump($exception->getMessage());
            exit;
        }
    }

    public function delete($id){
        try {
            $em = $this->getEntityManager();
            $admin = $em->find(\src\entity\Admin::class, $id);
            $em->remove($admin);
            $em->flush();
            $_SESSION['basarilisilme'] = 'basarili silme';
            header('location: /admin/view-AdminController');
        }catch (Exception $exception){
            var_dump($exception->getMessage());
        }

    }

}