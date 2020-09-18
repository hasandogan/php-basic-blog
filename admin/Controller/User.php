<?php


class User extends AbstractController
{
    public function show()
    {

    }
    public function list(){
        $conn = $this->getConn();
        $query = $conn->query("SELECT * FROM  user");
        $user = $query->fetchAll();

        return[
            'user' => $user, 'totalCount' => $query->rowCount()
        ];
    }
}