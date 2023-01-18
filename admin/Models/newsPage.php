<?php
    require_once __DIR__.'/db.php';
    class newsPageModel{
        public function getNewsPage(){
            $db=new database();
            $sql="SELECT * FROM newspage ORDER BY id DESC";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            $db->disconnect();
            return $result;
        }
        public function addNewsPage($newsPage){
            $db=new database();
            $sql="INSERT INTO newspage (newsID,recetteID,url) VALUES (:newsID,:recetteID,:url)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['newsID'=>$newsPage['newsID'],'recetteID'=>$newsPage['recetteID'],'url'=>$newsPage['url']]);
            $newsPageID=$db->db->lastInsertId();
            $db->disconnect();
            return $newsPageID;
        }
        public function updateNewsPage($newsPage){
            $db=new database();
            $sql="UPDATE newspage SET newsID=:newsID,recetteID=:recetteID,url=:url WHERE id=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['newsID'=>$newsPage['newsID'],'recetteID'=>$newsPage['recetteID'],'url'=>$newsPage['url'],'id'=>$newsPage['id']]);
            $db->disconnect();
        }
        public function deleteNewsPage($id){
            $db=new database();
            $sql="DELETE FROM newspage WHERE id=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }

    }

?>