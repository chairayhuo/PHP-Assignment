<?php

$articleName = $_POST["articleName"];
$articleAuthor = $_POST["articleAuthor"];
$articleId = $_POST["articleId"];

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";
$dbpassword = "";

//connect
$pdo = new PDO($dsn, $dbusername, $dbpassword); 

//prepare
$stmt = $pdo->prepare("UPDATE `articles` 
	SET `articleName` = '$articleName', 
	`articleAuthor` = '$articleAuthor'
	WHERE `articles`.`articleId` = $articleId;");

//execute
if($stmt->execute()){
	?><p>Record <?=$articleId ?> UPDATED</p><?php
}else{
	?><p>Could not UPDATE record</p><?php
}
?>
<a href="select-articles.php">Back to all records</a>