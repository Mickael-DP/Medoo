<?php
include 'database.php';

if (isset($_POST ['submit'])){

    $login = htmlspecialchars($_POST['login']);
    $validLogin = !empty($login);

    $password = htmlspecialchars($_POST['password']);
    $validPassword = !empty($password);
    
    $tentative= date('Y-m-d H:i:s');
    
    $success= $validLogin && $validPassword;

    if ($success){

        $search = $database->get("utilisateurs","password",[
            "email" => $login
        ]);

            if(password_verify($password,$search)) {
                session_start();
                $_SESSION["email"] = $login;
                header("Location:home.php");

            } else {
                $message = "Aucun membre inscrit a cette adresse mail";
            }

        $database->insert("connexion", [
            "login" => $login,
            "password" => $password,
            "tentative" => $tentative 
        ]);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include ('style.php')?>
    <title>Exercice1, niveau 2</title>
</head>

<body>
    

    <?php include ('header.php')?>
    <div class="d-flex justify-content-center">
        <div class="col-3">
            <h2 class="text-center">Connexion</h2>
            <div class=" col-12">
                <form action="login.php" method="post">
                    <div class=" form-group">
                        <label for="login">Email</label>
                        <input class="form-control" type="text" id="login" name="login">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" id="password" name="password">
                    </div>
                        <input  class=" btn btn-secondary btn-sm"type="submit" value="Envoyer" name="submit">
                </form>
            </div>
        </div>   
    </div>
       
       
    
    <?php
    if(isset($message)){
        echo $message;
    }
    ?>

    <?php include ('footer.php')?>
</body>
</html>