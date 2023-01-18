<?php
    require_once __DIR__.'/db.php';
    class diaporamaModel{
        public function getDiaporama(){
            $db=new database();
            $sql="SELECT * FROM diaporama ORDER BY id DESC";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            $db->disconnect();
            return ($result);

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
            $sql="UPDATE diaporama SET newsID=:newsID,recetteID=:recetteID WHERE id=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['newsID'=>$diaporama['newsID'],'recetteID'=>$diaporama['recetteID'],'id'=>$diaporama['id']]);
            $db->disconnect();
        }
        public function deleteDiaporama($id){
            $db=new database();
            $sql="DELETE FROM diaporama WHERE id=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }
        
    }

?>