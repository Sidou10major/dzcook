<?php
    require_once __DIR__.'/db.php';
    class diaporamaModel{
        public function getDiaporama(){
            $db=new database();
            $sql="SELECT recette.recetteID id,recette.imgPath,recette.titre,description,diaporama.url FROM diaporama join recette on diaporama.recetteID=recette.recetteID Union SELECT news.newsID id,news.imgPath,news.titre,description,diaporama.url FROM diaporama join news on diaporama.newsID=news.newsID";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            $db->disconnect();
            return ($result);

        }
        public function getDiaporamaById($id){
            $db=new database();
            $sql="SELECT * FROM diaporama,recette,news WHERE diaporamaID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result=$stmt->fetch();
            $db->disconnect();
            return $result;
        }
        public function addDiaporama($diaporama){
            $db=new database();
            $sql="INSERT INTO diaporama (newsID,recetteID) VALUES (:newsID,:recetteID)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['newsID'=>$diaporama['newsID'],'recetteID'=>$diaporama['recetteID']]);
            $diaporamaID=$db->db->lastInsertId();
            $db->disconnect();
            return $diaporamaID;
        }
        public function updateDiaporama($diaporama){
            $db=new database();
            $sql="UPDATE diaporama SET newsID=:newsID,recetteID=:recetteID WHERE diaporamaID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['newsID'=>$diaporama['newsID'],'recetteID'=>$diaporama['recetteID'],'id'=>$diaporama['id']]);
            $db->disconnect();
        }
        public function deleteDiaporama($id){
            $db=new database();
            $sql="DELETE FROM diaporama WHERE diaporamaID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }
        
    }

?>