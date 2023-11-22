<?php

$aName = $_POST["aName"];
$aLink = $_POST["aLink"];
$articleId = $_POST["articleId"];

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";
$dbpassword = "";

//connect
$pdo = new PDO($dsn, $dbusername, $dbpassword); 

//prepare
$stmt = $pdo->prepare("UPDATE `articles` 
	SET `aName` = '$aName', 
	`aLink` = '$aLink'
	WHERE `articles`.`articleId` = $articleId;");

//execute
if($stmt->execute()){
	?><p>Record <?=$articleId ?> UPDATED</p><?php
}else{
	?><p>Could not UPDATE record</p><?php
}
?>
<a href="select-articles.php">Back to all records</a>