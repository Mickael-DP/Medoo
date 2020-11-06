<?php

    function RecupToutUtilisateurs(){
        include 'database.php';

        $reqs = $database->select("utilisateurs", [
            "nom",
            "prenom",
            "email",
            "statut"
        ]);
        return $reqs;
    }

    function RecupUnUtilisateurs($id){
        include 'database.php';
        $req = $database->get("utilisateurs", [
            "nom", 
            "prenom", 
            "email", 
            "statut"
        ], [
            "ID" => $id
        ]);
        if (!empty($req)){
            return $req;  
        }
       
    }

    function CreerUtilisateur($nom, $prenom, $email, $statut){
        include 'database.php';
        $req = $database->insert("utilisateurs", [
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => $email,
            "statut" => $statut
        ]);
        return $req;
    }
  
    function MajUtilisateur($id,$nom, $prenom, $email, $statut){
        include 'database.php';
        $req = $database->update("utilisateurs", [
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => $email,
            "statut" => $statut
        ], [
            "ID" => $id
        ]);
        return $req;
    }

    function SuppUtilisateur($id){
        include 'database.php';
        $req = $database->delete("utilisateurs", [
            "ID" => $id
        ]);
        return $req;

    }

  


?>