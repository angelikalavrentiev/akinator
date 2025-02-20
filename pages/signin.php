<?php
include "../config/database.php";
include "../repository/userRepository.php";

session_start();

// connexion d'utilisateur existant
if(!empty($_POST)){
    
    $user = getUserByUsername($_POST["username"]);
    
    if($user){
        if(password_verify($_POST['password'], $user["password"])){
            
            $_SESSION["user"] = $user["username"];
            
            header("Location: account.php");
            exit;
        }
        else{
            $error = "Identifiant ou mot de passe incorrect";
        }
    }
    else{
         $error = "Identifiant ou mot de passe incorrect";
    }
}

$template = "signin";
include "layout.phtml";