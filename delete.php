<?php

$articleId = $_POST["articleId"];

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";
$dbpassword = "";

//connect
$pdo = new PDO($dsn, $dbusername, $dbpassword); 

//prepare
$stmt = $pdo->prepare("DELETE FROM `articles` WHERE `articles` . `articleId` = $articleId;");

//excute
if($stmt->execute()){
    ?><p>Reocrd <?=$articleId ?> deleted</p><?php
}else{
    ?><p>Could not delete record</p><?php
};

?>

<a href="select-articles.php">Back to all records</a>