<?php
include "../config/database.php";
include "../repository/userRepository.php";

session_start();

// enregistrer un nouvel utilisateur
if(!empty($_POST)){
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,16}$/";
    try {
        if(preg_match($regex, $password)){
            
            // vérifie les emails pour qu'ils soit uniques
            if (emailExists($email)) {
                throw new Exception("Cet email est déjà utilisé. Veuillez en choisir un autre.");
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            createUser($_POST["email"], $_POST["username"], $passwordHash);
            
            $_SESSION["user"] = $_POST["username"];
            
            //redirection vers la page top secrète
            header("Location: account.php");
            exit;

        } 
        else {
            throw new Exception('Les points ("."), slash ("/") ne sont pas toléré');
        }
    } // erreur si le regex n'est pas validé
    catch (Exception $e) {
       $error_message = $e->getMessage();
    }
}

$template = "register";
include "layout.phtml";
