<?php

session_start();

if (!isset($_SESSION["email"])){
    header("Location:login.php");
} else {


?>

<!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <a href="login.php">Retour au login</a>
        <?= $_SESSION["email"] ?>
    </body>

    </html>

<?php } ?>