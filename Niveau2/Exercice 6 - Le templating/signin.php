<?php
include 'file:///C:/laragon/www/Medoo/database.php';
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
            
            $rowCount = $database->count("utilisateurs", [
                "email" 
            ], [
                "email" => $email
            ]);

        if ($rowCount === 0) {

            $insertmbr = $database->insert("utilisateurs", [
                "nom" => $nom,
                "prenom" => $prenom,
                "email" => $email,
                "password" => $passwordHash,
                "statut"=> $statut
            ]); 

            header("Location:login.php");

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
    <?php include ('style.php')?>
    <title>Exercice1, niveau 2</title>
    </head>

    <body>
    
    <?php include ('header.php')?>
    <div class="d-flex justify-content-center">
        <div class="col-4">
            <h2 class="text-center">Inscription</h2>
                <form class= ""action="signin.php" method="post">
                        <div class=" form-group">
                            <label for="login">Nom:</label>
                            <input  class ="form-control form-control-sm" type="text" id="nom" name="nom" value="<?= isset($_POST['nom'])?$_POST['nom']:"";?>">                    
                        
                            <label for="login">Prénom:</label>
                            <input class ="form-control form-control-sm" type="text" id="prenom" name="prenom" value="<?=isset($_POST['prenom'])?$_POST['prenom']:"";?>">
                    
                            <label for="login">Email:</label>
                            <input class ="form-control form-control-sm" type="email" id="email" name="email" value="<?=isset($_POST['email'])?$_POST['email']:""?>">
                        
                            <label for="password">Mot de Passe:</label>
                            <input class ="form-control form-control-sm" type="password" id="password" name="password">
                    
                            <label for="password">Confirmation du mot de passe:</label>
                            <input class ="form-control form-control-sm" type="password" id="confirmPassword" name="confirmPassword">
                
                            <label for="particulier">Particulier</label>
                            <input type="radio" id="particulier" name="statut" value="particulier" checked>
                        
                            <label for="professionnel">Professionnel</label>
                            <input type="radio" id="professionnel" name="statut" value="professionnel"> 
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="msentions" id="mentions">
                            <label for="mentions">Je reconnais avoir pris connaissance des conditions d’utilisation et y adhère totalement</label>
                        
                            <input type="submit" value="Envoyer" name="submit">
                            <?= '<p>' .$message. "</p>";?>
                        </div>
            </form> 
        </div>
    </div>
    
   
    <?php include ('footer.php')?>
    </body>
</html>