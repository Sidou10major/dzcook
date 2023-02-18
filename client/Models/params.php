<?php
    require_once __DIR__.'/db.php';
    class paramsModel{
        public function getParams(){
            $db=new database();
            $sql="SELECT * FROM params";
            $stmt=$db->db->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            $db->disconnect();
            return $result;
        }
        public function getParamsById($id){
            $db=new database();
            $sql="SELECT * FROM params WHERE paramsID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result=$stmt->fetch();
            $db->disconnect();
            return $result;
        }
        public function addParams($params){
            $db=new database();
            $sql="INSERT INTO params (cle,valeur) VALUES (:cle,:valeur)";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['cle'=>$params['cle'],'valeur'=>$params['valeur']]);
            $paramsID=$db->db->lastInsertId();
            $db->disconnect();
            return $paramsID;
        }
        public function updateParams($params){
            $db=new database();
            $sql="UPDATE params SET cle=:cle,valeur=:valeur WHERE paramsID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['cle'=>$params['cle'],'valeur'=>$params['valeur'],'id'=>$params['id']]);
            $db->disconnect();
        }
        public function deleteParams($id){
            $db=new database();
            $sql="DELETE FROM params WHERE paramsID=:id";
            $stmt=$db->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $db->disconnect();
        }
        
    }
?>