<?php
include 'database.php';

$id = $_GET['id'];
if($id > 0){
    $utilisateur = $database->get("utilisateurs", [
        "ID",
        "nom", 
        "prenom", 
        "email", 
        "statut"
    ], [
        "ID" => $id
    ]);
}

if (isset($_POST ['submit'])){
    $id = $_POST["id"];
    $login = htmlspecialchars($_POST['login']);
    $validLogin = !empty($login);

    $password = htmlspecialchars($_POST['password']);
    $validPassword = !empty($password);
    
    $tentative= date('Y-m-d H:i:s');
    
    $success= $validLogin && $validPassword;

    if ($success){

        $database->delete("utilisateurs", [
            "ID" => $id
        ]);
        
    }
    header("Location: home.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice1, niveau 2</title>
</head>

<body>
    <div align="center">

        <h2>Supprimer</h2>

        <form action="supp.php?id=<?=$utilisateur["ID"];?>" method="post">

            <input type="hidden" name="id" value="<?=$utilisateur["ID"];?>">

            <table>
                <tr>
                    <td>
                        <label for="login">Email</label>
                    </td>
                    <td>
                        <input type="text" id="login" name="login" value=<?= $utilisateur ['email'];?>>
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
                    <input type="submit" value="Supprimer" name="submit">
                </div>
            
        </form>

    </div>
</body>
</html>