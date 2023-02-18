<?php
    require_once __DIR__.'/db.php';
    class recipeModel{
        //get recipes according to filter
        public function getRecipesFiltered(){
            $db=new database();
            $sql="SELECT recetteID id,recette.*,categorie.categorieID categorieID, categorie.titre categorie FROM recette join categorie on recette.categorieID=categorie.categorieID where state=1 ORDER BY recetteID DESC";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            //get fete of each recette
            $sql= "SELECT * FROM feterecette join fete on feterecette.feteID=fete.feteID  WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            foreach($result as $key=>$value){
                $stmt->execute(['id'=>$value['recetteID']]);
                $result[$key]['fete']=$stmt->fetchAll();
            }
            // Get saison of each recette
            $sql= "SELECT * FROM recettesaison join saison on recettesaison.saisonID=saison.saisonID WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            foreach($result as $key=>$value){
                $stmt->execute(['id'=>$value['recetteID']]);
                $result[$key]['saison']=$stmt->fetchAll();
            }
            // Get ingredients of each recette
            $sql= "SELECT * FROM composent join ingredient on composent.ingredientID=ingredient.ingredientID WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            foreach($result as $key=>$value){
                $stmt->execute(['id'=>$value['recetteID']]);
                $result[$key]['ingredients']=$stmt->fetchAll();
            }
            // Get steps of each recette
            $sql= "SELECT * FROM etape WHERE recetteID=:id order by etape";
            $stmt=$db->db->prepare($sql);
            foreach($result as $key=>$value){
                $stmt->execute(['id'=>$value['recetteID']]);
                $result[$key]['steps']=$stmt->fetchAll();
            }
            // Get rate
            $sql= "SELECT AVG(rate) rate FROM recettefav WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            foreach($result as $key=>$value){
                $stmt->execute(['id'=>$value['recetteID']]);
                $result[$key]['rate']=$stmt->fetch()['rate'];
            }
            $db->disconnect();
            return $result;
        }

        public function getRecipe($id,$userID){
            $db=new database();
            // Get recipe info
            $sql="SELECT * FROM recette WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result=$stmt->fetch();
            // Get ingredients
            $sql="SELECT * FROM composent join ingredient on composent.ingredientID=ingredient.ingredientID WHERE composent.recetteID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result['ingredients']=$stmt->fetchAll();
            // Get steps
            $sql="SELECT * FROM etape WHERE recetteID=:id order by etape";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result['steps']=$stmt->fetchAll();
            // Get rate
            $sql= "SELECT AVG(rate) rate FROM recettefav WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result['rate']=$stmt->fetch()['rate'];
            // get user rating
            $sql= "SELECT rate FROM recettefav WHERE recetteID=:id AND userID=:userID";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id,'userID'=>$userID]);
            $result['userRate']=$stmt->fetch()['rate'];
            $db->disconnect();
            return $result;
        }
       
        public function addRecipe($titre, $categorieID, $difficulte, $timePreparation, $timeRepo, $timeCuisson, $imgPath, $videoPath, $calories, $description, $userID){
            $db=new database();
            $sql="INSERT INTO recette (titre,categorieID,difficulte,tempsPreparation,tempsRepo,tempsCuisson,imgPath,videoPath,calories,description,userID) VALUES (:titre, :categorieID, :difficulte, :timePreparation, :timeRepo, :timeCuisson, :imgPath, :videoPath, :calories, :description, :userID)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['titre'=>$titre,'categorieID'=>$categorieID,'difficulte'=>$difficulte,'timePreparation'=>$timePreparation,'timeRepo'=>$timeRepo,'timeCuisson'=>$timeCuisson,'imgPath'=>$imgPath ,'videoPath'=>$videoPath,'calories'=>$calories,'description'=>$description,'userID'=>$userID]);
            $id=$db->db->lastInsertId();
            $db->disconnect();
            return $id;
        }
        public function deleteRecipe($id){
            $db=new database();
            $sql="DELETE FROM recette WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            // Delete ingredients
            $sql="DELETE FROM composent WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            // Delete steps
            $sql="DELETE FROM etape WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            // Delete FeteRecipe
            $sql="DELETE FROM feterecette WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            // Delete NewsPage
            $sql="DELETE FROM newspage WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            // Delete diaporama
            $sql="DELETE FROM diaporama WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            // Delete recetteSaison
            $sql="DELETE FROM recettesaison WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            // Delete recetteFav
            $sql="DELETE FROM recettefav WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }
        public function updateRecipe($id, $titre, $categorieID, $difficulte, $timePreparation, $timeRepo, $timeCuisson, $imgPath, $videoPath, $calories, $description){
            $db=new database();
            $sql="UPDATE recette SET titre=:titre, categorieID=:categorieID, difficulte=:difficulte, timePreparation=:timePreparation, timeRepo=:timeRepo, timeCuisson=:timeCuisson, imgPath=:imgPath, videoPath=:videoPath, calories=:calories, description=:description WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id,'titre'=>$titre,'categorieID'=>$categorieID,'difficulte'=>$difficulte,'timePreparation'=>$timePreparation,'timeRepo'=>$timeRepo,'timeCuisson'=>$timeCuisson,'imgPath'=>$imgPath ,'videoPath'=>$videoPath,'calories'=>$calories,'description'=>$description]);
            $db->disconnect();
        }
        //add step
        public function addStep($recetteID, $etape, $instruction){
            $db=new database();
            $sql="INSERT INTO etape (recetteID,etape,instruction) VALUES (:recetteID, :etape, :instruction)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['recetteID'=>$recetteID,'etape'=>$etape,'instruction'=>$instruction]);
            $db->disconnect();
        }
        //delete step
        public function deleteStep($recetteID,$etape){
            $db=new database();
            $sql="DELETE FROM etape WHERE etape=:etape AND recetteID=:recetteID";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['etape'=>$etape,'recetteID'=>$recetteID]);
            $db->disconnect();
        }
        //update step
        public function updateStep($recetteID, $etape, $instruction){
            $db=new database();
            $sql="UPDATE etape SET instruction=:instruction WHERE etape=:etape AND recetteID=:recetteID";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['recetteID'=>$recetteID,'etape'=>$etape,'instruction'=>$instruction]);
            $db->disconnect();
        }
        // get Fete
        public function getFete(){
            $db=new database();
            $sql="SELECT * FROM fete";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            $db->disconnect();
            return $result;
        }
        // add Fete
        public function addFete($titre){
            $db=new database();
            $sql='SELECT * FROM fete WHERE titre=:titre';
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['titre'=>$titre]);
            $result=$stmt->fetch();
            if($result){
                $db->disconnect();
                return $result['feteID'];
            }
            $sql="INSERT INTO fete (titre) VALUES (:titre)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['titre'=>$titre]);
            $db->disconnect();
            $id= $db->db->lastInsertId();
            return $id;
        }
        // delete Fete
        public function deleteFete($id){
            $db=new database();
            $sql="DELETE FROM fete WHERE feteID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }
        // update Fete
        public function updateFete($id, $titre){
            $db=new database();
            $sql="UPDATE fete SET titre=:titre WHERE feteID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id,'titre'=>$titre]);
            $db->disconnect();
        }
        // add FeteRecipe
        public function addFeteRecipe($feteID, $recetteID){
            $db=new database();
            $sql="INSERT INTO feterecette (feteID,recetteID) VALUES (:feteID, :recetteID)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['feteID'=>$feteID,'recetteID'=>$recetteID]);
            $db->disconnect();
        }
        // delete FeteRecipe
        public function deleteFeteRecipe($feteID, $recetteID){
            $db=new database();
            $sql="DELETE FROM feterecette WHERE feteID=:feteID AND recetteID=:recetteID";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['feteID'=>$feteID,'recetteID'=>$recetteID]);
            $db->disconnect();
        }
        // add recetteSaison
        public function addRecetteSaison($saisonID, $recetteID){
            $db=new database();
            $sql="INSERT INTO recettesaison (saisonID,recetteID) VALUES (:saisonID, :recetteID)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['saisonID'=>$saisonID,'recetteID'=>$recetteID]);
            $db->disconnect();
        }
        // delete recetteSaison
        public function deleteRecetteSaison($saisonID, $recetteID){
            $db=new database();
            $sql="DELETE FROM recettesaison WHERE saisonID=:saisonID AND recetteID=:recetteID";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['saisonID'=>$saisonID,'recetteID'=>$recetteID]);
            $db->disconnect();
        }
        
        // rate recipe
        public function rateRecipe($id,$note,$userID){
            $db=new database();
            // search if it's already rated!
            $sql="SELECT * FROM recettefav WHERE recetteID=:id AND userID=:userID";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id,'userID'=>$userID]);
            $result=$stmt->fetchAll();
            if(count($result)>0){
                // update
                $sql="UPDATE recettefav SET rate=:note WHERE recetteID=:id AND userID=:userID";
                $stmt=$db->db->prepare($sql);
                $stmt->execute(['id'=>$id,'note'=>$note,'userID'=>$userID]);
                $db->disconnect();
                return;
            }
            // insert
            $sql="INSERT INTO recettefav (recetteID,rate,userID) VALUES (:id, :note, :userID)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id,'note'=>$note,'userID'=>$userID]);
            $db->disconnect();
        }

        //get fete recipes
        public function getFeteRecipes(){
            $db=new database();
            $sql="SELECT * from recette where recetteID in (SELECT recetteID from feterecette)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            //get fete of each recette
            $sql= "SELECT * FROM feterecette join fete on feterecette.feteID=fete.feteID  WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            foreach($result as $key=>$value){
                $stmt->execute(['id'=>$value['recetteID']]);
                $result[$key]['fete']=$stmt->fetchAll();
            }
            // Get saison of each recette
            $sql= "SELECT * FROM recettesaison join saison on recettesaison.saisonID=saison.saisonID WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            foreach($result as $key=>$value){
                $stmt->execute(['id'=>$value['recetteID']]);
                $result[$key]['saison']=$stmt->fetchAll();
            }
            // Get ingredients of each recette
            $sql= "SELECT * FROM composent join ingredient on composent.ingredientID=ingredient.ingredientID WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            foreach($result as $key=>$value){
                $stmt->execute(['id'=>$value['recetteID']]);
                $result[$key]['ingredients']=$stmt->fetchAll();
            }
            // Get steps of each recette
            $sql= "SELECT * FROM etape WHERE recetteID=:id order by etape";
            $stmt=$db->db->prepare($sql);
            foreach($result as $key=>$value){
                $stmt->execute(['id'=>$value['recetteID']]);
                $result[$key]['steps']=$stmt->fetchAll();
            }
            // Get rate
            $sql= "SELECT AVG(rate) rate FROM recettefav WHERE recetteID=:id";
            $stmt=$db->db->prepare($sql);
            foreach($result as $key=>$value){
                $stmt->execute(['id'=>$value['recetteID']]);
                $result[$key]['rate']=$stmt->fetch()['rate'];
            }
            $db->disconnect();
            return $result;
        }
        
    }
    
?>