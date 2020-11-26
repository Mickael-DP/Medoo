<?php
include_once("Medoo.php");

use Medoo\Medoo;

//Initialisation
function dbinit()
{
    $database = new Medoo([
        'database_type' => 'mysql',
        'database_name' => 'scraper_email',
        'server' => 'localhost',
        'username' => 'root',
        'password' => ''
    ]);

    return $database;
}
function getEmail($url)
{

    include 'email_scraper.php';
    // $url = 'https://github.com/nyxgeek/username-lists/blob/master/usernames-top100/usernames_gmail.com.txt';
    $emails = scrape_email($url);


    foreach ($emails as $email) {

        dbinit()->insert("email", ["mail" => $email]);
    }
}

if (isset($_POST["submit"])) {
    $url = htmlspecialchars($_POST["url"]);

    getEmail($url);
}

$req = dbinit()->select("email", ['mail']);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Niveau 3 Boss1</title>
</head>

<body class="bg-primary">
    <h1 class="text-center"> Le Scraper d'email</h1>
    
    <div class="container p-2">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <form action="" method="post">
                        <div class="form-group d-flex justify-content-center">
                            <input class="form-control form-control-sm" type="text" id="url" name="url" placeholder="Entrez votre url">
                        </div>
                        <div class="d-flex justify-content-center">
                            <input class='btn btn-sm btn-danger' type="submit" value="Envoyer" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class='table table-light table-hover table-striped table-bordered table-sm'>
                    <?php $i = 0;
                    foreach ($req as $email) : $i++ ?>
                        <?php if ($i == 1) : ?>
                            <tr>
                            <?php endif; ?>

                            <td class="text-center m-0"><?= $email['mail'] ?></td>
                            <?php if ($i == 5) : $i = 0 ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if ($i != 0) : ?>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>