<?php
    require_once "database.php";
    $DataBase = new DataBase();
    $db = $DataBase->connect();
    $q = "CREATE TABLE IF NOT EXISTS users(
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(50) UNIQUE NOT NULL,
        pass VARCHAR(255) NOT NULL
        )ENGINE=INNODB;";

    $q .= "CREATE TABLE IF NOT EXISTS profiles(
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        namee VARCHAR(50) NOT NULL,
        surname VARCHAR(50) NOT NULL,
        gender CHAR NOT NULL,
        picture VARCHAR(200),
        userId INT UNSIGNED UNIQUE,
        CONSTRAINT user_id FOREIGN KEY(userId) REFERENCES users(id)
        )ENGINE=INNODB;";

    $q .= "CREATE TABLE IF NOT EXISTS admins(
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        admin_name VARCHAR(50) UNIQUE NOT NULL,
        pass VARCHAR(255) NOT NULL
        )ENGINE=INNODB;";

    $result = $db->multi_query($q);
    if(!$result){
        echo $db->connect_error;
    }

    $passwordAdmin = password_hash("tamara11", PASSWORD_DEFAULT);
    $insert = "INSERT INTO admins(`admin_name`, `pass`) VALUES('AdminTamara', '$passwordAdmin');";
    $result2 = $db->query($insert);
    if(!$result2){
        echo $db->connect_error;
    }

    $q = "CREATE TABLE IF NOT EXISTS onlineshop(
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100) NOT NULL,
        price INT NOT NULL,
        picture VARCHAR(200) NOT NULL,
        avalible INT DEFAULT 20,
        productType VARCHAR(100) NOT NULL
        )ENGINE=INNODB;";

    $result = $db->multi_query($q);
    if(!$result){
        echo $db->connect_error;
    }

    $q = "CREATE TABLE IF NOT EXISTS cart(
            shoppingId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            userId INT UNSIGNED NOT NULL,
            dateAndTime DATETIME NOT NULL,
            adress VARCHAR(200) NOT NULL,
            city VARCHAR(100) NOT NULL,
            zip INT UNSIGNED NOT NULL,
            CONSTRAINT fk_user_id FOREIGN KEY(userId) REFERENCES users(id)
            )ENGINE=INNODB;";
    $q .= "CREATE TABLE IF NOT EXISTS boughtProduct(
            shoppingId INT UNSIGNED NOT NULL,
            productId INT UNSIGNED NOT NULL,
            amount INT NOT NULL,
            PRIMARY KEY(shoppingId, productId),
            CONSTRAINT fk_product_id FOREIGN KEY(productId) REFERENCES onlineshop(id)
            )ENGINE=INNODB;";
    $result = $db->multi_query($q);
    if(!$result){
        echo $db->connect_error;
    }
    
    
    $q = "CREATE TABLE IF NOT EXISTS menagers(
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        menager_name VARCHAR(50) UNIQUE NOT NULL,
        pass VARCHAR(255) NOT NULL
        )ENGINE=INNODB;";

    $result = $db->query($q);
    if(!$result){
        echo $db->connect_error;
    }

    $passwordMenager = password_hash("tamara11", PASSWORD_DEFAULT);
    $insert = "INSERT INTO menagers(`menager_name`, `pass`) VALUES('MenagerTamara', '$passwordMenager');";
    $result2 = $db->query($insert);
    if(!$result2){
        echo $db->connect_error;
    }