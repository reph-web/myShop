<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $serverName = '127.0.0.1';
    $userName = 'root';
    $password = '';
    $dbName = 'myshop';

    // Create connexion
    $connexion = new mysqli($serverName, $userName, $password, $dbName);

    $sql = "DELETE FROM clients WHERE id = $id";
    $result = $connexion->query($sql);
    header('Location: /index.php');
    exit;
}
?>