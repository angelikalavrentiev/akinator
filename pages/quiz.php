<?php

session_start(); 

include "../config/database.php";
include "../repository/userRepository.php";
include "../repository/answerRepository.php";
include "../repository/resultRepository.php";
include "../repository/questionsRepository.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if(!empty($_POST)){
    $choix = $_POST["response"];
    //var_dump($choix);
    $answer = getAnswerById($choix);
    //var_dump($answer);
    if(isset($answer["id_result"])){
       $_SESSION['id_result'] = $answer["id_result"];
       header ("Location: result.php");
    }
    else{
        $id_questions = $answer["id_next_question"];
        $possibleanswer = getPossibleAnswer($id_questions);
        $questions = getQuestionsById($id_questions);
        //var_dump($possibleanswer);
        //var_dump($questions);
    }
}
else{
    $questions = getFirstQuestions(1);
    $possibleanswer = getPossibleAnswer($questions["id"]);
    //var_dump($questions["id"]);
    //var_dump($possibleanswer);
    //var_dump($questions);
}

$template = "quiz";
include "layout.phtml";