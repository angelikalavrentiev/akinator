<?php

session_start();

include "../config/database.php";
include "../repository/userRepository.php";
include "../repository/gamelogRepository.php";
include "../repository/answerRepository.php";
include "../repository/resultRepository.php";
include "../repository/questionsRepository.php";

// securité
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
// récuperer l'utilisateur
$username = $_SESSION['user'];
$user = getUserByUsername($username);

// verifier si il y a bien une session
if (!$user) {
    die("Erreur : utilisateur non trouvé dans la base de données.");
}
// récuperer l'id de l'utilisateur
$userId = $user['id'];
$dataPassword = getPasswordByUserId($userId);

// vérifier si il y a un mdp en base de données
if (!$dataPassword) {
    die("Erreur : Accès interdit.");
}

$regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,16}$/";

// changer le mot de passe        
if (!empty($_POST) && isset($_POST['thenpassword'], $_POST['newpassword'])) {
    $thenPassword = $_POST['thenpassword'];
    $newPassword = $_POST['newpassword'];
        
        // vérifie la validité de l'ancien mdp
        if (!password_verify($thenPassword, $dataPassword["password"])) {
         die("Erreur : Mot de passe actuel incorrect.");
        }

            // vérifie le regex
            if(!preg_match($regex, $newPassword)){
                die("Erreur : Le nouveau mot de passe ne respecte pas les critères.");
            }
             // hash le mdp
             $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);

               if (updatePassword($userId, $passwordHash)) {
                header("Location: account.php");
                exit;
               }
               else {
                die("Erreur : Échec de la modification du mot de passe.");
               }
}

$id_user = $user['id'];

// recupère l'historique en base de données
$gamelogs = getGamelogByUserId($id_user);

// supprimer le compte
if (isset($_POST['delete_account'])) {
    deleteUser($id_user);
    session_destroy();
    header('Location: index.php');
    exit;
}

$template = "account";
include "layout.phtml";