<?php
    class filesModel{
        public function uploadFile($uploadFile){
            $fileName=$uploadFile['name'];
            $fileTempName=$uploadFile['tmp_name'];
            $targetPath='../Asserts/'.uniqid().$fileName;
            move_uploaded_file($fileTempName,$targetPath);
            return $targetPath;      
        }
    }

?>