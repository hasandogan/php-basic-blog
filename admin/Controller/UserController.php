<?php


class UserController extends AbstractController
{
    public function show()
    {

    }

    public function list()
    {

        $query = $this->getEntityManager()->getRepository(\src\entity\User::class);
        $user = $query->userList();
        return [
            'user' => $user,
        ];
    }
}