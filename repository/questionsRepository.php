<?php

function getFirstQuestions($order_of_question){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM questions WHERE order_of_question = ?");
    
    $query->execute([$order_of_question]);
    
    return $query->fetch();
}

function getQuestionsById($id_questions){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM questions WHERE id = ?");
    
    $query->execute([$id_questions]);
    
    return $query->fetch();
}