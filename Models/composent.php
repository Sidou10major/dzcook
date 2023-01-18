<?php
    class composentModel{
        public function getModeCuissons(){
            $db=new database();
            $sql="SELECT * FROM modecuisson";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            $db->disconnect();
            return $result;
        }
        public function getModeCuisson($id){
            $db=new database();
            $sql="SELECT * FROM modecuisson WHERE modeID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result=$stmt->fetch();
            $db->disconnect();
            return $result;
        }
        public function addModeCuisson($mode){
            $db=new database();
            $sql='SELECT * from modecuisson where titre=:mode';
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['mode'=>$mode]);
            $result=$stmt->fetch();
            if($result){
                $db->disconnect();
                return $result['modeID'];
            }
            $sql="INSERT INTO modecuisson (titre) VALUES (:mode)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['mode'=>$mode]);
            $db->disconnect();
        }
        public function deleteModeCuisson($id){
            $db=new database();
            $sql="DELETE FROM modecuisson WHERE modeID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }
        public function updateModeCuisson($id,$mode){
            $db=new database();
            $sql="UPDATE modecuisson SET titre=:mode WHERE modeID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id,'mode'=>$mode]);
            $db->disconnect();
        }
        // add composent
        public function addComposent($composent){
            $db=new database();
            $sql="INSERT INTO composent (ingredientID,recetteID,quantite,modeID) VALUES (:ingredientID,:recetteID,:quantite,:modeID)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['ingredientID'=>$composent['ingredientID'],'recetteID'=>$composent['recetteID'],'quantite'=>$composent['quantite'],'modeID'=>$composent['modeID']]);
            $db->disconnect();
        }
        // get composent
        public function getComposents(){
            $db=new database();
            $sql="SELECT * FROM composent,ingredient,modecuisson";
            $stmt=$db->db->prepare($sql);
            $stmt->execute([]);
            $result=$stmt->fetch();
            $db->disconnect();
            return $result;
        }
        // delete composent
        public function deleteComposent($recetteID,$ingredientID){
            $db=new database();
            $sql="DELETE FROM composent WHERE recetteID=:recetteID and ingredientID=:ingredientID";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['recetteID'=>$recetteID,'ingredientID'=>$ingredientID]);
            $db->disconnect();
        }
        // update composent
        public function updateComposent($composent){
            $db=new database();
            $sql="UPDATE composent SET quantite=:quantite,modeID=:modeID WHERE recetteID=:recetteID and ingredientID=:ingredientID";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['recetteID'=>$composent['recetteID'],'ingredientID'=>$composent['ingredientID'],'quantite'=>$composent['quantite'],'modeID'=>$composent['modeID']]);
            $db->disconnect();
        }
        

    }
?>