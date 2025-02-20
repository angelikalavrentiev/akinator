<?php

function createUser(string $email, string $username, string $password){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("INSERT INTO user (email, username, password) VALUES (?,?,?)");
    
    $query->execute([$email, $username, $password]);
}

function getUserByUsername(string $username){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM user WHERE username = ?");
    
    $query->execute([$username]);
    
    return $query->fetch();
}

function getUserById($userId){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM user WHERE id = ?");
    
    $query->execute([$userId]);
    
    return $query->fetch();
}

function getPasswordByUserId($userId){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT password FROM user WHERE id = ?");
    
    $query->execute([$userId]);
    
    return $query->fetch();
}

function updatePassword($userId, $passwordHash){
    
    $pdo = getConnexion();
    
    $query = $pdo->prepare("UPDATE user SET password = ? WHERE id = ?");
    
    return $query->execute([$passwordHash, $userId]);
}
function deleteUser(int $userId): bool {
    $pdo = getConnexion();
    
    $query = $pdo->prepare("DELETE FROM game_log WHERE id_user = ?");
    
    $query->execute([$userId]);
    
    $query = $pdo->prepare("DELETE FROM user WHERE id = ?");
    
    return $query->execute([$userId]);
}

function emailExists($email) {
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT * FROM user WHERE email = ?");
    $query->execute([$email]);
    return $query->fetch(); 
}
