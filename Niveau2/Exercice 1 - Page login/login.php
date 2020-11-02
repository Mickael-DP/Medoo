<?php

include 'file:///C:/laragon/www/Medoo/database.php';
// $bdd = new PDO('mysql:host=localhost;dbname=niv2 /exo1','root','');

if (isset($_POST ['submit'])){

    $login = ($_POST['login']);
    $validLogin = !empty($login);

    $password = ($_POST['password']);
    $validPassword = !empty($password);
    
    $tentative= date('Y-m-d H:i:s');
    
    $validAll= $validLogin && $validPassword && $tentative;

    if ($validAll){

        // $insertmbr = $bdd->prepare("INSERT INTO connexion (login, password, tentative) VALUES (?,?,?)");
        // $insertmbr->execute(array($login, $password, $tentative));

        $database->insert("connexion", [
            "login" => $login, 
            "password" => $password, 
            "tentative" => $tentative
        ]);


        $message = "Votre compte a été créé";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice1, niveau 2</title>
</head>

<body>
    <div align="center">

        <h2>Inscription</h2>

        <form action="login.php" method="post">
            <div>
                <label for="login">Login</label>
                <input type="text" id="login" name="login">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="text" id="password" name="password">
            </div>
            <div>
                <input type="submit" value="Envoyer" name="submit">
            </div>
        </form>
    
    <?php
    if(isset($message)){
        echo $message;
    }
    ?>
    </div>
</body>
</html>