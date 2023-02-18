<?php
    require_once __DIR__.'/db.php';
    class userModel{
        public function getUser(){
            $db=new database();
            $sql="SELECT * FROM utilisateur";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            $db->disconnect();
            return $result;
        }
        public function getUserById($id){
            $db=new database();
            $sql="SELECT * FROM utilisateur WHERE userID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result=$stmt->fetch();
            // get recipe fav
            $sql="SELECT recettefav.recetteID id,recette.* FROM recettefav join recette on recettefav.recetteID=recette.recetteID WHERE recettefav.userID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result['recettefav']=$stmt->fetchAll();
            // get own recipe
            $sql="SELECT recetteID id ,recette.* FROM recette WHERE userID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result['recettes']=$stmt->fetchAll();
            $db->disconnect();
            return $result;
        }
        public function addUser($user){
            $db=new database();
            $sql="INSERT INTO utilisateur (nom,prenom,mdp,email,sexe,dateNaissance) VALUES (:nom,:prenom,:password,:email,:sexe,:dateNaissance)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['nom'=>$user['nom'],'prenom'=>$user['prenom'],'password'=>$user['password'],'email'=>$user['email'],'sexe'=>$user['sexe'],'dateNaissance'=>$user['dateNaissance']]);
            $userID=$db->db->lastInsertId();
            $db->disconnect();
            return $userID;
        }
        public function updateUser($user){
            $db=new database();
            $sql="UPDATE utilisateur SET nom=:nom,prenom=:prenom,email=:email,sexe=:sexe,dateNaissance=:dateNaissance WHERE userID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['nom'=>$user['nom'],'prenom'=>$user['prenom'],'email'=>$user['email'],'sexe'=>$user['sexe'],'dateNaissance'=>$user['dateNaissance'],'id'=>$user['id']]);
            $db->disconnect();
        }
        public function deleteUser($id){
            $db=new database();
            $sql="DELETE FROM utilisateur WHERE userID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }
        public function validateUser($id){
            $db=new database();
            $sql="UPDATE utilisateur SET state=1 WHERE userID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }
        public function banUser($id){
            $db=new database();
            $sql="UPDATE utilisateur SET state=2 WHERE userID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }	
        public function login($email,$password){
            $db=new database();
            $sql="SELECT * FROM utilisateur WHERE email=:email AND mdp=:password";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['email'=>$email,'password'=>$password]);
            $result=$stmt->fetch();
            if($result){
                    $db->disconnect();
                    return $result;
            }
            $db->disconnect();
            return false;
        }
        public function register($user){
            $db=new database();
            $sql="SELECT * FROM utilisateur WHERE email=:email";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['email'=>$user['email']]);
            $result=$stmt->fetch();
            if($result){
                $db->disconnect();
                return false;
            }
            $sql="INSERT INTO utilisateur (nom,prenom,mdp,email,sexe,dateNaissance,state) VALUES (:nom,:prenom,:password,:email,:sexe,:dateNaissance,:state)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['nom'=>$user['nom'],'prenom'=>$user['prenom'],'password'=>$user['password'],'email'=>$user['email'],'sexe'=>$user['sexe'],'dateNaissance'=>$user['dateNaissance'],'state'=>0]);
            $userID=$db->db->lastInsertId();
            $db->disconnect();
            return $userID;
        }
        
        
    }

?>