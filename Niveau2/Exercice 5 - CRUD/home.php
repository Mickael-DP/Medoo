<?php

include 'database.php';
session_start();

if (!isset($_SESSION["email"])){
    header("Location:login.php");
}


        
$req = $database->select("utilisateurs", [
            "ID",
            "nom",
            "prenom",
            "email",
            "statut"
]);

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
        <header class="container-fluid bg-primary  p-2">
            <h4 class="text-white">Mon CRUD</h4>
        </header>
        
        <div class="container w-75  pt-5"> 
            <h3 class="text-center">Liste d'utilisateur</h3>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <th class="text-center text-white">ID</th>
                    <th class="text-center text-white">Nom</th>
                    <th class="text-center text-white">Prenom</th>
                    <th class="text-center text-white">Email</th>
                    <th class="text-center text-white">Statut</th>
                    <th class="text-center text-white">Action</th>
                </thead>
                <tbody>
                    <?php foreach($req as $utilisateur){ ?>
                    <tr>
                        <td class="text-center m-0"><?= $utilisateur ['ID'] ?></td>
                        <td class="text-cente m-0"><?= $utilisateur ['nom'] ?></td>
                        <td class="text-center m-0"><?= $utilisateur ['prenom'] ?></td>
                        <td class="text-center m-0"><?= $utilisateur ['email'] ?></td>
                        <td class="text-center m-0"><?= $utilisateur ['statut'] ?></td>
                        <td class="text-center m-0"><a href="modif.php?id=<?= $utilisateur ['ID']?>" class="btn btn-secondary btn-sm">Mettre a jour</a>
                        <a href="supp.php?id=<?= $utilisateur ['ID']?>" class="btn btn-danger btn-sm">Supprimer</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="signin.php" class="btn btn-success btn-sm">Ajouter un utilisiteur</a>
        </div>

        <footer class=" container-fluid bg-primary fixed-bottom">
            <p class="text-white text-right mt-2">BY Mickael DALLE PASQUALINE</p>
        </footer>

    </body>

    </html>

