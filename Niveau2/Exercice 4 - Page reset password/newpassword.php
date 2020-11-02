<?php

$bdd = new PDO('mysql:host=localhost;dbname=niv2 /exo1', 'root', '');

session_start();

if (isset($_POST["submit"])) {
 
    $newpassword = htmlspecialchars($_POST['newpassword']);
    $Validnewpassword = !empty($newpassword);

    $confirmpassword = htmlspecialchars($_POST['confirmpassword']);
    $Validconfirmpassword = !empty($confirmpassword);

    $success = $Validnewpassword && $Validconfirmpassword;

    if ($success) {
        if ($newpassword === $confirmpassword) {

            $passwordhash = password_hash($newpassword, PASSWORD_DEFAULT);

            $req = $bdd->prepare("UPDATE utilisateurs SET password = ?  WHERE email = ?");
            $req->execute(array($passwordhash, $_SESSION["email"] ));
            session_destroy();

        } else {

            echo "error password différent";
        }
    } else {

        echo "error champs vide";
    }
}

?>



<!DOCTYPE html>
<html>

    <head>
        <meta charset ="utf-8">
        <meta name="viewport" content= "width=device-width, initial-scale =1.0">
        <title>Nouveau Mot de passe</title>
    </head>

    <body>

        <h2>Nouveau mot de passe</h2>
        <form action="newpassword.php" method="post">
            <table>
            <tr>
                <td>
                    <label for="text" class="form__label">Nouveau Mot de passe:</label>
                </td>
                <td>
                    <input type="text" name="newpassword" id="newpassword" class="form__input">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="text" class="form__label">Confirmation Mot de passe :</label>
                </td>
                <td>
                    <input type="text" name="confirmpassword" id="confirmpassword" class="form__input">
                </td>
            </tr>
            </table>
            <div>
                <input type="submit" name="submit" value="Envoyer" class="form__input">
            </div>
        </form>



    </body>

</html>
