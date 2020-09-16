<?php
require_once '../class/AbstractController.php';

class Comment extends AbstractController
{
    public function confirmed ($id){
        $conn = $this->getConn();
        $ok = 1;
        $query = $conn->query( "UPDATE comments SET confirmed='$ok' WHERE id='$id'");
        if($query->execute()){
            header('location: /admin/commentlist');
        }else{
            echo 'hatalı sql';
        }

    }
    public function delete ($id){
        $conn = $this->getConn();
        $query = $conn->query( "Delete FROM comments where id='$id'");
        if($query->execute()){
            header('location: /admin/commentlist');
        }
        else{
            echo 'hatalı sql';
        }
    }

}