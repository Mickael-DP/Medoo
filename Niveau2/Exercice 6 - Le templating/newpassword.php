<?php

include ("includes/database.php");

session_start();

if (isset($_POST["submit"])) {
 
    $newpassword = htmlspecialchars($_POST['newpassword']);
    $Validnewpassword = !empty($newpassword);

    $confirmpassword = htmlspecialchars($_POST['confirmpassword']);
    $Validconfirmpassword = !empty($confirmpassword);

    $success = $Validnewpassword && $Validconfirmpassword;

    $email = $_SESSION["email"];

    if ($success) {
        if ($newpassword === $confirmpassword) {

            $passwordhash = password_hash($newpassword, PASSWORD_DEFAULT);

            $database->update("utilisateurs", [
                "password" => $passwordhash], [
                "email" => $email 
                ]);

            session_destroy();

        } else {

            $message = "Attention, les mots de passe ne sont pas identique";
        }
    } else {

        $message = "Atttention, champs du formulaire vide";
    }
}

?>


<?php include ('templates/header.php') ?>

    <div class="container mt-5">
        <h2 class="text-center">Nouveau mot de passe</h2>
            <form action="newpassword.php" method="post">
                <div class="d-flex justify-content-center">
                    <div class="col-3 mt-3">
                        <div class="form-group">
                            <label for="text" class="form__label">Nouveau Mot de passe:</label>
                            <input class="form-control" type="password" name="newpassword" id="newpassword">
                            <label for="text" class="form__label">Confirmation Mot de passe :</label>
                            <input class="form-control" type="password" name="confirmpassword" id="confirmpassword">
                        </div>
                        <div>
                            <input class="btn btn-primary" type="submit" name="submit" value="Envoyer">
                        </div>
                    </div>
                </div>
                <div class="text-center mt-1"><?php echo $message ?></div>
            </form>
        
    </div>

<?php include ('templates/footer.php') ?>

</body>
</html>
