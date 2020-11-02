<?php
include 'file:///C:/laragon/www/Medoo/database.php';
// $bdd = new PDO('mysql:host=localhost;dbname=niv2 /exo1','root','');
$message="";

if (isset($_POST["submit"])){

    $nom =htmlspecialchars($_POST["nom"]);
    $nomValid = !empty($nom);

    $prenom =htmlspecialchars($_POST["prenom"]);
    $prenomValid = !empty($prenom);

    $email = htmlspecialchars($_POST["email"]);
    $emailValid = !empty($email);

    $password =htmlspecialchars($_POST["password"]);
    $confirmPassword=htmlspecialchars($_POST["confirmPassword"]);
    $charPassword = preg_match('@[A-Z]@', $password) && preg_match('@[a-z]@', $password) && preg_match ('@[0-9]@', $password);
    $passwordValid = !empty($password) && $password === $confirmPassword && $charPassword;
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
      

    $statut=htmlspecialchars($_POST["statut"]);
    $statutValid = !empty($statut);

    $mentionValid = !empty($_POST['mentions']);

    $succes = $nomValid && $prenomValid && $passwordValid && $mentionValid && $emailValid && $statutValid;

    if($succes){

        // $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE email= :email');
        // $req->execute(array(':email' => $email));

         // $rowCount = $req->rowCount();
            
            $rowCount = $database->count("utilisateurs", [
                "email" 
            ], [
                "email" => $email
            ]);

        if ($rowCount === 0) {
            // $sql="INSERT INTO utilisateurs (nom, prenom, email, password, statut) VALUES (?,?,?,?,?)";
            // $insertmbr = $bdd->prepare($sql);
            // $insertmbr->execute(array($nom, $prenom, $email, $passwordHash, $statut));

            $insertmbr = $database->insert("utilisateurs", [
                "nom" => $nom,
                "prenom" => $prenom,
                "email" => $email,
                "password" => $passwordHash,
                "statut"=> $statut
            ]); 

        } else{
            $message = "adresse mail déjà utilisé !";
        }
    } 
}
  
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice1, niveau 2</title>
    </head>

    <body>
    <div align="center">

        <h2>Connexion</h2>
       
        <form action="signin.php" method="post">
            <table>
                <tr>
                    <td>
                        <label for="login">Nom</label>
                    </td>
                    <td>
                        <input type="text" id="nom" name="nom" value="<?= isset($_POST['nom'])?$_POST['nom']:"";?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="login">Prénom</label>
                    </td>
                    <td>
                        <input type="text" id="prenom" name="prenom" value="<?=isset($_POST['prenom'])?$_POST['prenom']:"";?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="login">Email</label>
                    </td>
                    <td>
                        <input type="email" id="email" name="email" value="<?=isset($_POST['email'])?$_POST['email']:""?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Mot de Passe</label>
                    </td>
                    <td>
                        <input type="password" id="password" name="password">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Confirmation du mot de passe</label>
                    </td>
                    <td>
                        <input type="password" id="confirmPassword" name="confirmPassword">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="particulier">Particulier</label>
                        <input type="radio" id="particulier" name="statut" value="particulier" checked>
                
                        <label for="professionnel">Professionnel</label>
                        <input type="radio" id="professionnel" name="statut" value="professionnel"> 
                    </td>
                </tr> 
                </table>
                <div>
                    <input type="checkbox" name="mentions" id="mentions">
                    <label for="mentions">Je reconnais avoir pris connaissance des conditions d’utilisation et y adhère totalement</label>
                </div>       
                <div>
                    <input type="submit" value="Envoyer" name="submit">
                </div>
            
            <?php

                echo '<p>' .$message. "</p>";
            ?>
        </form>
    

    </div>
    </body>
</html>