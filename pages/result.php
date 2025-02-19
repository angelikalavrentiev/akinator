<?php
 
session_start();

include "../config/database.php";
include "../repository/resultRepository.php";
include "../repository/gamelogRepository.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$result = getResult();


$template = "result";
include "layout.phtml";