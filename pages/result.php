<?php
 
session_start();

include "../config/database.php";
include "../repository/userRepository.php";
include "../repository/resultRepository.php";
include "../repository/answerRepository.php";
include "../repository/gamelogRepository.php";

// sécurité
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
// vérifie si il y a bien un résultat
if (!isset($_SESSION['id_result'])) {
    die("Erreur : Aucun résultat trouvé. <a href='quiz.php'>Recommencer</a>");
}
// recupère le user et son id ainsi que l'id du résultat
$username = $_SESSION['user'];
$user = getUserByUsername($username);
$id_user = $user['id'];
$id_result = $_SESSION['id_result'];

$result = getResultById($id_result);

// sauvgarde en base de données pour l'historique
saveGameLog($id_user, $id_result);

$template = "result";
include "layout.phtml";