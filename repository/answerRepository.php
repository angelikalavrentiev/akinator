<?php

function getAnswers(){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM answer");
    
    $query->execute();
    
    return $query->fetchAll();
}

function getPossibleAnswer($id_questions){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM answer WHERE id_questions = ?");
    
    $query->execute([$id_questions]);
    
    return $query->fetchAll();
}

function getAnswerById($id){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM answer WHERE id = ?");
    
    $query->execute([$id]);
    
    return $query->fetch();
}
