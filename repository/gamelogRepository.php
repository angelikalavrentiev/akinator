<?php

function saveGameLog($id_user, $id_result) {
    
    $pdo = getConnexion();
    
    $query = $pdo->prepare("INSERT INTO game_log (id_user, id_result, date) VALUES (?, ?, NOW())");
    
    $query->execute([$id_user, $id_result]);
}

function getGamelogByUserId($id_user){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM game_log INNER JOIN result ON game_log.id_result = result.id WHERE id_user = ?");
    
    $query->execute([$id_user]);
    
    return $query->fetchAll();
}
