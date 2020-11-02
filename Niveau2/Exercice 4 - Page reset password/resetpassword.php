<?php
session_start();
    include("sendemail.php");
    $bdd = new PDO('mysql:host=localhost;dbname=niv2 /exo1','root','');

    if(isset($_POST["submit"])){

        
        $recup_email = htmlspecialchars($_POST ["email"]);
        $tentative = date('Y-m-d H:i:s');
        $hashrecup_email = sha1($recup_email);
        
        
        $searchmail= $bdd->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $searchmail->execute(array($recup_email));
        $emailexist= $searchmail->fetch(PDO::FETCH_ASSOC);


        if ($emailexist){
        
            $sendemail= $bdd->prepare("INSERT INTO recuperation (email, tentative) VALUES (?,?)");
            $sendemail->execute(array($recup_email, $tentative));
            
           
            $message = "http://localhost/MySQL/Niveau2/Exercice%204%20-%20Page%20reset%20password/newpassword.php?email=" . $hashrecup_email;
            $_SESSION['email'] = $recup_email;
            send_mail($recup_email,"Recuperation du mot de passe" , $message);
        }
    }
?>



<!DOCTYPE html>
<html>

    <head>
        <meta charset ="utf-8">
        <meta name="viewport" content= "width=device-width, initial-scale =1.0">
        <title>Reinitialisation du Mot de passe</title>
    </head>

    <body>

        <h2>Réinitialisation du mot de passe</h2>
        <form action="resetpassword.php" method="post">
            <table>
            <tr>
                <td>
                    <label for="email" class="form__label">Entrez votre email :</label>
                </td>  
                <td>
                    <input type="text" name="email" id="email" class="form__input">
                </td>
            </tr>
            </table>
            <div>
                <input type="submit" name="submit" value="Envoyer" class="form__input">
            </div>
        </form>
        

        
    </body>

</html>