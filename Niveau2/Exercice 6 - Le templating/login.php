<?php
include 'includes/database.php';

if (isset($_POST['submit'])) {

    $login = htmlspecialchars($_POST['login']);
    $validLogin = !empty($login);

    $password = htmlspecialchars($_POST['password']);
    $validPassword = !empty($password);

    $tentative = date('Y-m-d H:i:s');

    $success = $validLogin && $validPassword;

    if ($success) {

        $search = $database->get("utilisateurs", "password", [
            "email" => $login
        ]);

        if (password_verify($password, $search)) {
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

<?php include('templates/header.php') ?>
<div class="d-flex justify-content-center p-5">
    <div class="col-3">
        <div class="card">
            <div class="card-hearder p-2 bg-primary">
                <h2 class="text-center text-white">Connexion</h2>
            </div>
            <div class="card-body bg-light">
                <div class="card-img col-12 d-flex justify-content-center">
                    <img class="w-50" src="image/image-utilisateur.png" alt="img utilisateur">
                </div>
                <div class="col-12">
                    <form action="login.php" method="post">
                        <div class=" form-group">
                            <label for="login">Email</label>
                            <input class="form-control" placeholder="Votre Email" type="text" id="login" name="login">
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input class="form-control" placeholder="Votre Mot de passe" type="password" id="password" name="password">
                        </div>
                        <div class="text-center">
                            <input class="btn btn-primary btn-sm" type="submit" value="Envoyer" name="submit">
                            <a class="font-italic" href="resetpassword.php">Mot de passe oublié ?</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($message)) {
    echo $message;
} ?>
<?php include('templates/footer.php') ?>
</body>

</html>