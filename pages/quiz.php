<?php
include "../config/database.php";
include "../repository/userRepository.php";
include "../repository/answerRepository.php";
include "../repository/resultRepository.php";
include "../repository/questionsRepository.php";
include "../repository/gamelogRepository.php";

$template = "quiz";
include "layout.phtml";