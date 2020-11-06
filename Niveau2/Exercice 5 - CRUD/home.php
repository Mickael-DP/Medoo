<?php

session_start();

if (!isset($_SESSION["email"])){
    header("Location:login.php");
}


?>

<!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Page d'accueil</title>
    </head>

    <body>
   
      <?php
         
        include 'database.php';
        
        $req = $database->select("utilisateurs", [
                    "ID",
                    "nom",
                    "prenom",
                    "email",
                    "statut"
        ]);
      ?>
      <div class="container"> 
        <h1 class="text-center">Liste d'utilisateur</h1>
        <table class="table  table-bordered">
            <thead class="bg-primary">
                <th class="text-center text-white">ID</th>
                <th class="text-center text-white">Nom</th>
                <th class="text-center text-white">Prenom</th>
                <th class="text-center text-white">Email</th>
                <th class="text-center text-white">Statut</th>
                <th class="text-center text-white">Action</th>
            </thead>
            <tbody>
                <?php
                foreach($req as $utilisateur){
                ?>
                    <tr>
                    <td class="text-center"><?= $utilisateur ['ID'] ?></td>
                    <td class="text-center"><?= $utilisateur ['nom'] ?></td>
                    <td class="text-center"><?= $utilisateur ['prenom'] ?></td>
                    <td class="text-center"><?= $utilisateur ['email'] ?></td>
                    <td class="text-center"><?= $utilisateur ['statut'] ?></td>
                    <td class="text-center"><a href="modif.php?id=<?= $utilisateur ['ID']?>" class="btn btn-secondary">Mettre a jour</a>
                    <a href="supp.php?id=<?= $utilisateur ['ID']?>" class="btn btn-danger">Supprimer</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="signin.php" class="btn btn-success">Ajouter un utilisiteur</a>
        </div>
    </body>

    </html>

