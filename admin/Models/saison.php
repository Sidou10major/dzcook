<?php
    require_once __DIR__.'/db.php';
    class saisonModel{
        public function getSaisons(){
            $db=new database();
            $sql="SELECT * FROM saison";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            $db->disconnect();
            return $result;
        }
        public function getSaison($id){
            $db=new database();
            $sql="SELECT * FROM saison WHERE saisonID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result=$stmt->fetch();
            $db->disconnect();
            return $result;
        }
        public function addSaison($saison){
            $db=new database();
            $sql="INSERT INTO saison (titre) VALUES (:name)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['name'=>$saison]);
            $saisonID=$db->db->lastInsertId();
            $db->disconnect();
            return $saisonID;
        }
        public function updateSaison($saison){
            $db=new database();
            $sql="UPDATE saison SET titre=:name WHERE saisonID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['name'=>$saison['name'],'id'=>$saison['id']]);
            $db->disconnect();
        }
        public function deleteSaison($id){
            $db=new database();
            $sql="DELETE FROM saison WHERE saisonID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }
        
    }

?>