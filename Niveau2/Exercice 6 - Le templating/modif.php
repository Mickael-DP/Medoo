<?php
include ('includes/database.php');
$message="";

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


if (isset($_POST["submit"])){

    $id = $_POST["id"];
    $nom =htmlspecialchars($_POST["nom"]);
    $nomValid = !empty($nom);

    $prenom =htmlspecialchars($_POST["prenom"]);
    $prenomValid = !empty($prenom);

    $email = htmlspecialchars($_POST["email"]);
    $emailValid = !empty($email);

    $password =htmlspecialchars($_POST["password"]);
    $confirmPassword=htmlspecialchars($_POST["confirmPassword"]);
    $charPassword = preg_match('@[A-Z]@', $password) && preg_match('@[a-z]@', $password) && preg_match ('@[0-9]@', $password);
    $passwordValid = !empty($password) && $password === $confirmPassword && $charPassword;
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
      

    $statut=htmlspecialchars($_POST["statut"]);
    $statutValid = !empty($statut);

    $mentionValid = !empty($_POST['mentions']);

    $succes = $nomValid && $prenomValid && $passwordValid && $mentionValid && $emailValid && $statutValid;

    if($succes){

        $database->update("utilisateurs", [
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => $email,
            "statut" => $statut
        ], [
            "ID" => $id
        ]);
       
    } else {
        header("Location:modif.php");
    }
    header("Location:home.php");
}



  
?>

<?php include ('templates/header.php')?>

    <div class="container">

        <div class="d-flex justify-content-center pt-4">
            <div class="col-4">
               <div class="card ">
                    <div class="card-header p-2 bg-primary">
                        <h3 class="text-center text-white">Mise à jour Utilisateurs</h3>
                    </div>
                    <div class="card-body bg-light">
                            <form action="modif.php?id=<?=$utilisateur["ID"];?>" method="post">
                                <input type="hidden" name="id" value="<?= $utilisateur["ID"];?>">
                                    <div class="form-group">
                                        <label for="login">Nom</label>
                                        <input class ="form-control form-control-sm" placeholder="Votre Nom" type="text" id="nom" name="nom" value="<?= $utilisateur ['nom'];?>">
                                            
                                        <label for="login">Prénom</label>
                                        <input class ="form-control form-control-sm" placeholder="Votre Prénom" type="text" id="prenom" name="prenom" value="<?=$utilisateur['prenom']?>">
                                        
                                        <label for="login">Email</label>
                                        <input class ="form-control form-control-sm" placeholder="Votre Email" type="email" id="email" name="email" value="<?= $utilisateur["email"]?>">
                                    
                                        <label for="password">Mot de Passe</label>
                                        <input class ="form-control form-control-sm" placeholder="Votre Mot de passe" type="password" id="password" name="password">
                                    
                                        <label for="password">Confirmation du mot de passe</label>
                                        <input class ="form-control form-control-sm" placeholder="Confirmez votre Mot de passe" type="password" id="confirmPassword" name="confirmPassword">
                                
                                        <label for="particulier">Particulier</label>
                                        <input  type="radio" id="particulier" name="statut" value="Particulier" checked>
                                        
                                        <label for="professionnel">Professionnel</label>
                                        <input  type="radio" id="professionnel" name="statut" value="Professionnel">
                                    </div>
                                    <div class="form_group text-center">
                                        <input class="btn btn-sm btn-secondary" type="submit" value="Mettre a jour" name="submit">
                                        <div class="d-flex align-items-baseline">
                                            <input type="checkbox" name="mentions" id="mentions">
                                            <label class="m-2"for="mentions">Je reconnais avoir pris connaissance des conditions d’utilisation et y adhère totalement</label>
                                        </div>   
                                             
                                    </div>
                            </form>
                            </div>
                </div>
            </div>
        </div>
    </div>
        <?php include ('templates/footer.php') ?>
    </body>
</html>