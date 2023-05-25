<?php

session_start();

class Login extends DataBase{
    public $db;
    public $id;
    public function login($username_email, $password){
        $db = $this->connect();
        $duplicate = mysqli_query($db, "SELECT * from users WHERE username = '$username_email' OR email = '$username_email';");
        $result = $duplicate->fetch_assoc();
        if($duplicate->num_rows > 0){
            $pass = $result["pass"];
            $checkPass = password_verify($password, $pass);
            if($checkPass){
                $this->id = $result["id"];
                return 1;
                //uspesno prijavljivanje
            }else{
                return 10;
                //netacna sifra
            }
        }else{
           return 100;
           //nije pronadjen user
        }
    }
    public function logAdmin($username_email, $password){
        $db = $this->connect();
        $admin_duplicate = mysqli_query($db, "SELECT * from admins WHERE admin_name = '$username_email';");
        $admin_result = $admin_duplicate->fetch_assoc();
        if($admin_duplicate->num_rows > 0){
            $admin_pass = $admin_result["pass"];
            $admin_checkPass = password_verify($password, $admin_pass);
            if($admin_checkPass){
                return 2;
                //uspesno admin prijavljivanje
            }else{
                return 20;
                //netacna admin sifra
            }
        }else{
            return 200;
            //nije pronadjen amdin
        }
    }
    public function logMenager($username_email, $password){
        $db = $this->connect();
        $menager_duplicate = mysqli_query($db, "SELECT * from menagers WHERE menager_name = '$username_email';");
        $menager_result = $menager_duplicate->fetch_assoc();
        if($menager_duplicate->num_rows > 0){
            $menager_pass = $menager_result["pass"];
            $menager_checkPass = password_verify($password, $menager_pass);
            if($menager_checkPass){
                return 3;
                //uspesno menager prijavljivanje
            }else{
                return 30;
                //netacna menager sifra
            }
        }else{
            return 300;
            //nije pronadjen menager
        }
    }
    public function getId(){
        return $this->id;
    }
}