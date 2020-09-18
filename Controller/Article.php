<?php

class Article extends AbstractController
{
    /**
     * Homepage constructor.
     */
        public function show ($slug){
         return $slug;

    }
    public function result ($slug){
        $conn = $this->getConn();

        if (isset($slug)) {
            $articlequery = $conn->query("SELECT * FROM article where slug LIKE '%$slug%'");
            $artrow = $articlequery->fetch();
            $id = $artrow['id'];

            $catquery = $conn->query("SELECT * FROM article_categories where articleid='$id'");
            $row = $catquery->fetch();

            $catid = $row['categoriesid'];
            $showcatquery = $conn->query("SELECT * FROM  categories where id='$catid'");
            $catrow = $showcatquery->fetch();

        } else {
            header('loaction:   /');
        }
        $tagquery = $conn->query("SELECT * FROM tags where articleid='$id'");
        if ($tagquery->rowCount()){
            $tagArray = [];
            foreach ($tagquery as $tag){
                $tagArray[] = $tag;
            }
        }
        $rowArray = [];
        $rowArray[] = $artrow;
        $rowArray[] = $catrow;
        $rowArray[] = $tagArray;

        return $rowArray;
    }
    public function comments ($id){
        $conn = $this->getConn();
        $commentquery = $conn->query("SELECT * FROM comments where confirmed='1' and articleid='$id'");
        if ($commentquery->rowCount()) {
            $commentArray = [];
            foreach ($commentquery as $comments){
                $commentArray[] = $comments;
            }
        }

        return $commentArray;
    }
}