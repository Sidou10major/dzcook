<?php
    require_once __DIR__.'/db.php';
    class ingredientModel{
        public function getIngredients(){
            $db=new database();
            // Get ingredients
            $sql="SELECT ingredient.ingredientID id,ingredient.*,saison.titre saison FROM ingredient join saison on ingredient.originSaison=saison.saisonID";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            // Get infonutritionnelle
            $sql="SELECT * FROM infonutritionnelle where ingredientID=:id";
            $stmt=$db->db->prepare($sql);
            foreach($result as $key=>$value){
                $stmt->execute(['id'=>$value['ingredientID']]);
                $result[$key]['nutrition']=$stmt->fetchAll();
            }
            // get dispoingredient
            $sql="SELECT * FROM dispoingredient join saison on dispoingredient.saisonID=saison.saisonID where ingredientID=:id";
            $stmt=$db->db->prepare($sql);
            foreach($result as $key=>$value){
                $stmt->execute(['id'=>$value['ingredientID']]);
                $result[$key]['dispo']=$stmt->fetchAll();
            }
            $db->disconnect();
            return $result;
        }
        public function getIngredient($id){
            $db=new database();
            // Get ingredients
            $sql="SELECT * FROM ingredient WHERE ingredientID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result=$stmt->fetch();
            // Get infonutritionnelle
            $sql="SELECT * FROM infonutritionnelle where ingredientID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result['nutrition']=$stmt->fetch();
            $db->disconnect();
            return $result;
        }
        public function addIngredient($ingredient){
            $db=new database();
            $sql="SELECT * from ingredient where titre=:name";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['name'=>$ingredient['titre']]);
            $result=$stmt->fetch();
            if($result){
                // return id
                $db->disconnect();
                return $result['ingredientID'];
            }
            $sql="INSERT INTO ingredient (titre,imgPath,originSaison,healthy) VALUES (:titre,:imgPath,:originSaison,:healthy)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['titre'=>$ingredient['titre'],'imgPath'=>$ingredient['imgPath'],'originSaison'=>$ingredient['originSaison'],'healthy'=>$ingredient['healthy']]);
            $ingredientID=$db->db->lastInsertId();
            $db->disconnect();
            return $ingredientID;
        }
        public function updateIngredient($ingredient){
            $db=new database();
            $sql="UPDATE ingredient SET titre=:titre,imgPath=:imgPath,healthy=:healthy,originSaison=:originSaison WHERE ingredientID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['titre'=>$ingredient['titre'],'imgPath'=>$ingredient['imgPath'],'healthy'=>$ingredient['healthy'], 'originSaison'=>$ingredient['originSaison'] ,'id'=>$ingredient['id']]);
            $db->disconnect();
        }
        public function deleteIngredient($id){
            $db=new database();
            $sql="DELETE FROM ingredient WHERE ingredientID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            // delete infonutritionnelle
            $sql="DELETE FROM infonutritionnelle WHERE ingredientID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            // delete dispoingredient
            $sql="DELETE FROM dispoingredient WHERE ingredientID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }
        // add nutrition
        public function addNutrition($nutrition){
            $db=new database();
            $sql="INSERT INTO infonutritionnelle (ingredientID,titre,description) VALUES (:id,:titre,:description)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$nutrition['id'],'titre'=>$nutrition['titre'],'description'=>$nutrition['description']]);
            $db->disconnect();
        }
        public function updateNutrition($nutrition){
            $db=new database();
            $sql="UPDATE infonutritionnelle SET titre=:titre,description=:description WHERE infoID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['titre'=>$nutrition['titre'],'description'=>$nutrition['description'],'id'=>$nutrition['id']]);
            $db->disconnect();
        }
        public function deleteNutrition($id){
            $db=new database();
            $sql="DELETE FROM infonutritionnelle WHERE infoID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }
        // add dispo
        public function addDispo($dispo){
            $db=new database();
            $sql="INSERT INTO dispoingredient (ingredientID,saisonID) VALUES (:id,:saison)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$dispo['id'],'saison'=>$dispo['saison']]);
            $db->disconnect();
        }
        public function deleteDispo($id){
            $db=new database();
            $sql="DELETE FROM dispoingredient WHERE ingredientID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }
    }

?>