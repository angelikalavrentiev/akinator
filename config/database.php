<?php

function getConnexion():object
{
    $pdo = new PDO('mysql:host=db.3wa.io;port=3306;dbname=angelikalavrentiev_sprint;charset=utf8', 'angelikalavrentiev', '8494e43c821e8b1b9107fd258db8f071');
    
    return $pdo;
}