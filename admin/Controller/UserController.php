<?php


class UserController extends AbstractController
{


    public function show()
    {

        $query = $this->getEntityManager()->getRepository(\src\entity\User::class);
        $user = $query->userList();
        return [
            'user' => $user,
        ];
    }
}