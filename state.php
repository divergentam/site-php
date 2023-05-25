<?php
 require_once "validation.php";
 require_once "classes/database.php";

$databese = new DataBase();
$db = $databese->connect();

$validation = true;
$amountErr = $selectErr = "";

$q = "SELECT * FROM `onlineshop`";
$res = $db->query($q);  

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $amount = $_POST["amount"];
    $select = $_POST["admin-flowers"];

    if(empty(($amount))){
        $amountErr = "Polje ne sme da bude prazno!";
        $validation = false;
    }

    if($select == "Select"){
        $validation = false;
        $selectErr = "Molim Vas da selektujete odredjeni tip!";
    }

    if($validation){
        $q = "UPDATE `onlineshop` SET `avalible`='$amount' WHERE `title` = '$select';";
        $result = $db->query($q);
        if($result){
            echo "<script>alert('Uspesno ste podesili stanje za proizvod $select')</script>";
        }else{
            echo "<script>alert('UNije moguce podesiti stanje za proizvod $select')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Admin</title>
</head>
<body>
    <main>
        <section class="admin" id="admin">
            <?php 
                require_once "header-admin.php";   
            ?>
            <div class="pp-container bd-container">
                <?php 
                   require_once "user-log-admin.php";
                ?>
                <div class="home-text section-title">
                    Admin
                </div>
            </div>
        </section>
    </main>
    <div class="register-continer">
        <form class="register-form" action="" method="post"> 
            <p>
                <select class="box" id="admin-select" name="admin-flowers">
                    <option value="Select">--Izaberite neku od ponudjenih opcija</option>
                    <?php 
                        foreach($res as $row){
                            $title = $row["title"];
                            echo "<option value='$title'>$title</option>";
                        }
                    ?>
                </select>
                <span class ="err" id="err_selectErr">*<?php echo $selectErr?></span>

            </p>
            <p>
                <input class="box" type="number" name="amount"> 
                <span class ="err" id="err_selectErr">*<?php echo $amountErr?></span>
            </p>
            <p>
                <input class="content1-button" type="submit" value="Podesi stanje"> 
            </p>
        </form>
    </div>
    <?php
        require_once "admin-footer.php";
    ?>
    <script src="main.js"></script>
</body>
</html>