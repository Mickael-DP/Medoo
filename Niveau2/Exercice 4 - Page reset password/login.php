<?php

$bdd = new PDO('mysql:host=localhost;dbname=niv2 /exo1','root','');

if (isset($_POST ['submit'])){

    $login = htmlspecialchars($_POST['login']);
    $validLogin = !empty($login);

    $password = htmlspecialchars($_POST['password']);
    $validPassword = !empty($password);
    
    $tentative= date('Y-m-d H:i:s');
    
    $success= $validLogin && $validPassword;

    if ($success){
        
        $searchmbr= $bdd->prepare("SELECT email, password FROM utilisateurs WHERE email = ?");
        $searchmbr->execute(array($login));

        $search = $searchmbr->fetch(PDO::FETCH_ASSOC);

            if(password_verify($password,$search["password"])) {
                session_start();
                $_SESSION["email"] = $login;
                header("Location:home.php");

            } else {
                $message = "Aucun membre inscrit a cette adresse mail";
            }
        
        $sql= "INSERT INTO connexion(login, password,tentative) VALUES(?,?,?)";
        $insertmbr = $bdd->prepare($sql);
        $insertmbr->execute(array($login, $password, $tentative));
        
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

            <table>
                <tr>
                    <td>
                        <label for="login">Email</label>
                    </td>
                    <td>
                        <input type="text" id="login" name="login">
                    </td>    
                </tr>
              
                <tr>
                    <td>
                        <label for="password">Password</label>
                    </td>
                    <td>
                        <input type="text" id="password" name="password">
                    </td>      
                </tr>    
            </table>
                <div>
                    <input type="submit" value="Envoyer" name="submit">
                </div>
            
        </form>
        <a href="resetpassword.php">Mot de passe oublié ?</a>
    
    <?php
    if(isset($message)){
        echo $message;
    }
    ?>
    </div>
</body>
</html>