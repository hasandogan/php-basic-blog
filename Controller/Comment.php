<?php

class Comment extends AbstractController
{

    public function addComment (){
        $conn = $this->getConn();

        $username = $_POST['username'];
        $date = $_POST['date'];
        $id = $_POST['id'];
        $content = $_POST['commentcontent'];

        $query = $conn->query("SELECT * FROM article where id='$id'");
        $row = $query->fetch();
        $title = $row['slug'];
        $query = $conn->prepare("INSERT INTO comments SET 
            username = ?,
             content = ?,
            createdAt = ?,
             articleid = ?,
             articletitle= ?
            ");

        $insert = $query->execute(array(

            "$username", "$content", "$date", "$id", "$title"));
        if ($insert) {
            header('location: article/' . $title);
        }
    }

}