<?php
session_start();

include ("includes/sendemail.php");
include ("includes/database.php");

    if(isset($_POST["submit"])){

        
        $recup_email = htmlspecialchars($_POST ["email"]);
        $tentative = date('Y-m-d H:i:s');
        $hashrecup_email = sha1($recup_email);
        
        
        $emailexist = $database->get("utilisateurs", "email", [
            "email" => $recup_email
        ]);


        if ($emailexist){
        
            $token= uniqid();
            
            $database->insert("recuperation", [
                "email" => $recup_email,
                "tentative" => $tentative,
                "token" => $token
            ]);
            
            $message = "http://localhost/Medoo/Niveau2/Exercice%206%20-%20Le%20templating/newpassword.php?email=" . $hashrecup_email . "&token=" . $token;
            $_SESSION['email'] = $recup_email;
            send_mail($recup_email,"Recuperation du mot de passe" , $message);
        }
    }
?>


<?php include ('templates/header.php') ?>

<div class="container mt-5">
    <h2 class="text-center">Réinitialisation du mot de passe</h2>
        <div class="d-flex justify-content-center">
            <div class="col-3 mt-3">
                <form action="resetpassword.php" method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input class="form-control" type="text" name="email" id="email" class="form__input">
                    </div>
                    <div>
                        <input class="btn btn-primary" type="submit" name="submit" value="Envoyer" class="form__input">
                    </div>
                </form>
            </div>
        </div>
</div>        

        
    </body>

<?php include ('templates/footer.php') ?>

</html>