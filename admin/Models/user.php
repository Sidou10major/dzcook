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
        public function editUser($user){
            $db=new database();
            $sql="UPDATE utilisateur SET nom=:nom,prenom=:prenom,email=:email,dateNaissance=:dateNaissance,sexe=:sexe WHERE userID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$user['id'],'nom'=>$user['nom'],'prenom'=>$user['prenom'],'email'=>$user['email'],'dateNaissance'=>$user['dateNaissance'],'sexe'=>$user['sexe']]);
            $db->disconnect();
        }
    }

?>