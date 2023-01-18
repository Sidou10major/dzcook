<?php
    require_once __DIR__.'/../config/config.php';
    class database{
        public $db;
        public function __construct(){
            try{
                $this->db=new PDO(DB_DSN,DB_USER,DB_PASS,DB_OPTIONS);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function disconnect(){
            $this->db=null;
        }
    }

?>