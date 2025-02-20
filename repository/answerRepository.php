<?php

function getPossibleAnswer($id_questions): array{
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM answer WHERE id_questions = ?");
    
    $query->execute([$id_questions]);
    
    return $query->fetchAll();
}

function getAnswerById($id): ?array{
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM answer WHERE id = ?");
    
    $query->execute([$id]);
    
    return $query->fetch();
}

function getAnswerByResult($id_result): array{
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM answer WHERE id_result = ?");
    
    $query->execute([$id_result]);
    
    return $query->fetchAll();
}
