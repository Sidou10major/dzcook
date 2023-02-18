<?php
    require_once __DIR__.'/db.php';
    class newsModel{
        // get news
        public function getNews(){
            $db=new database();
            $sql="SELECT newsID id,titre,imgPath,videoPath FROM news";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            $db->disconnect();
            return $result;
        }
        // get news by id
        public function getNewsById($id){
            $db=new database();
            $sql="SELECT * FROM news WHERE newsID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result=$stmt->fetch();
            $db->disconnect();
            return $result;
        }
        // add news
        public function addNews($news){
            $db=new database();
            $sql="INSERT INTO news (titre,description,imgPath,videoPath) VALUES (:titre,:description,:imgPath,:videoPath)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['titre'=>$news['titre'],'description'=>$news['description'],'imgPath'=>$news['imgPath'],'videoPath'=>$news['videoPath']]);
            $newsID=$db->db->lastInsertId();
            $db->disconnect();
            return $newsID;
        }
        // update news
        public function updateNews($news){
            $db=new database();
            $sql="UPDATE news SET titre=:titre,description=:description,imgPath=:imgPath,videoPath=:videoPath WHERE newsID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['titre'=>$news['titre'],'description'=>$news['description'],'imgPath'=>$news['imgPath'],'videoPath'=>$news['videoPath'],'id'=>$news['id']]);
            $db->disconnect();
        }
        // delete news
        public function deleteNews($id){
            $db=new database();
            $sql="DELETE FROM news WHERE newsID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            // delete news from newsPage
            $sql="DELETE FROM newsPage WHERE newsID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            // delete news from diaporama
            $sql="DELETE FROM diaporama WHERE newsID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }
    }
?>