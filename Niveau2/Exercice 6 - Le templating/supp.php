<?php
include ('includes/database.php');

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

<?php include ('templates/header.php')?>

    <div class="d-flex justify-content-center">
        <div class="col-3">
            <h2 class="text-center">Supprimer</h2>
            <div class=" col-12">
                <form action="supp.php?id=<?=$utilisateur["ID"];?>" method="post">
                    <input type="hidden" name="id" value="<?=$utilisateur["ID"];?>">
                    <div class=" form-group">
                        <label for="login">Email</label>
                        <input class="form-control" type="text" id="login" name="login" value=<?= $utilisateur ['email'];?>>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" id="password" name="password">
                    </div>
                        <input  class=" btn btn-danger btn-sm"type="submit" value="Supprimer" name="submit">
                </form>
            </div>
        </div> 
</div> 

    <?php include ('templates/footer.php')?>

</body>
</html>