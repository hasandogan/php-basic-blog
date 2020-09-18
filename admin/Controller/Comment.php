<?php

class Comment extends AbstractController
{
    public function show(){

    }
    public function list (){
        $conn = $this->getConn();
        $query = $conn -> query("SELECT * FROM comments order by id desc ");
        $comment = $query->fetchAll();
        $totalCount = $query->rowCount();
        $mood = $this->commentConfirmedRow($totalCount);
        return['comment' => $comment, 'totalCount' => $totalCount, 'mood' => $mood['mood']];
    }

    public function confirmed ($id){
        $conn = $this->getConn();
        $query = $conn->query( "UPDATE comments SET confirmed='1' WHERE id='$id'");
        if($query->execute()){
            header('location: /admin/view-comment');
        }else{
            echo 'hatalı sql';
        }

    }
    public function delete ($id){
        $conn = $this->getConn();
        $query = $conn->query( "Delete FROM comments where id='$id'");
        if($query->execute()){
            header('location: /admin/view-comment');
        }
        else{
            echo 'hatalı sql';
        }
    }
    public function commentConfirmedRow($totalCount){
        $conn = $this->getConn();
        $query = $conn -> query("SELECT * FROM comments where confirmed='1'");
        $confirmedComments = $query->rowCount();
        $mood = $confirmedComments * 100 / $totalCount;

       return [
           'mood' => $mood,
       ];
    }


}