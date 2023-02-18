<?php
    require_once __DIR__.'/db.php';
    class categoryModel{
        // Get all categories
        public function getCategories(){
            $db=new database();
            $sql="SELECT categorieID id,titre FROM categorie";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
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
            $stmt->execute(['name'=>$category['titre'],'id'=>$category['id']]);
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