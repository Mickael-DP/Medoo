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
    <div align="center">

    <?php include ('hearder.php')?>

        <h2>Connexion</h2>

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
    
    <?php
    if(isset($message)){
        echo $message;
    }
    ?>
    </div>
</body>
</html>