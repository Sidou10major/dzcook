<?php
    require_once 'db.php';
    class categoryModel{
        // Get all categories
        public function getCategories(){
            $db=new database();
            $sql="SELECT * FROM categorie";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            // Get recipes
            $sql="SELECT recetteID id,recette.* FROM recette where categorieID=:id limit 10";
            $stmt=$db->db->prepare($sql);
            foreach($result as $key=>$value){
                $stmt->execute(['id'=>$value['categorieID']]);
                $result[$key]['recipes']=$stmt->fetchAll();
            }
            $db->disconnect();
            return $result;
        }
        // Get category by id
        public function getCategory($id){
            $db=new database();
            $sql="SELECT * FROM categorie WHERE categorieID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result=$stmt->fetch();
            // Get recipes
            $sql="SELECT * FROM recette where categorieID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result['recipes']=$stmt->fetchAll();
            $db->disconnect();
            return $result;
        }
        // Add category
        public function addCategory($category){
            $db=new database();
            $sql="INSERT INTO categorie (titre) VALUES (:name)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['name'=>$category]);
            $categoryID=$db->db->lastInsertId();
            $db->disconnect();
            return $categoryID;
        }
        // Update category
        public function updateCategory($category){
            $db=new database();
            $sql="UPDATE categorie SET titre=:name WHERE categorieID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['name'=>$category['name'],'id'=>$category['id']]);
            $db->disconnect();
        }
        // Delete category
        public function deleteCategory($id){
            $db=new database();
            $sql="DELETE FROM categorie WHERE categorieID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            // delete recipes
            $sql="DELETE FROM recette WHERE categorieID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }
    }

?>