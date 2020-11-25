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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="post">
        <div>
            <label for="url">URL</label>
            <input type="text" id="url" name="url">
        </div>
        <div>
            <input type="submit" value="Envoyer" name="submit">
        </div>
    </form>

</body>

</html>