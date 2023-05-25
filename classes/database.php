<?php

class DataBase{
    public function connect(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "FlowerShop";
    
        $conn = new mysqli($servername, $username, $password, $db);
        $conn->set_charset("utf_8");
    
        if($conn->connect_error){
            echo "<srcipt>alert('Nije moguca konekcija sa bazom podataka')</script>";
        }else{
            return $conn;
        }
    }
}