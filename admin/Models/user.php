<?php
    require_once __DIR__.'/db.php';
    class userModel{
        public function getUsers(){
            $db=new database();
            $sql="SELECT userID id,nom,prenom,email,dateNaissance,sexe,state FROM utilisateur";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            $db->disconnect();
            return $result;
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
       
    }
?>