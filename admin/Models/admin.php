<?php
require_once __DIR__."/db.php";
    class adminModel{
        public function login($username,$password){
            $db=new database();
            $sql="SELECT adminID,email FROM admin WHERE email=:username AND mdp=:password";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['username'=>$username,'password'=>$password]);
            $result=$stmt->fetch();
            $db->disconnect();
            return $result;
        }

    }
?>