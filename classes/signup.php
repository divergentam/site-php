<?php

session_start();

class Register extends DataBase{
    public $db;
    public function registration($name, $surname, $gender, $username, $password, $email){
        $db = $this->connect();
        $duplicate = mysqli_query($db, "SELECT * from users WHERE username = '$username' OR email = '$email';");
        if($duplicate->num_rows > 0){
            return 10;
            // username/email je vec upotrebljen
        }else{
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $q = "INSERT INTO `users`(`username`, `email`, `pass`) VALUES ('$username','$email','$hashedPass')";
            if($db->query($q)){
                //unos u tabelu profiles
                $idUser = "SELECT `id` FROM `users` WHERE `username` LIKE '$username';";
                $res = $db->query($idUser);
                $id = $res->fetch_assoc()['id'];
                $q = "INSERT INTO `profiles`(`namee`, `surname`, `gender`, `userId`)
                    VALUES ('$name', '$surname', '$gender', '$id');";
                if($db->query($q)){
                    header("location:login.php");
                }else{
                    echo $db->error;
                }
            }else{
                echo $db->error;
            }
        }
    }
    public function registrationWithImage($name, $surname, $gender, $username, $password, $email, $image){
        $db = $this->connect();
        $duplicate = mysqli_query($db, "SELECT * from users WHERE username = '$username' OR email = '$email';");
        if($duplicate->num_rows > 0){
            return 10;
            // username/email je vec upotrebljen
        }else{
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $q = "INSERT INTO `users`(`username`, `email`, `pass`) VALUES ('$username','$email','$hashedPass')";
            if($db->query($q)){
                //unos u tabelu profiles
                $idUser = "SELECT `id` FROM `users` WHERE `username` LIKE '$username';";
                $res = $db->query($idUser);
                $id = $res->fetch_assoc()['id'];
                $q = "INSERT INTO `profiles`(`namee`, `surname`, `gender`, `picture`, `userId`)
                    VALUES ('$name', '$surname', '$gender', '$image', '$id');";
                if($db->query($q)){
                    header("location:login.php");
                }else{
                    echo $db->error;
                }
            }else{
                echo $db->error;
            }
        }
    }

}