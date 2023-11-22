<?php
include("header.php");

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";  
$dbpassword = "";

//connect
$pdo = new PDO($dsn, $dbusername, $dbpassword);

//prepare
$stmt = $pdo->prepare("SELECT `aboutContent` FROM `about` WHERE `aboutId` = 2");

//execute
$stmt->execute();
if($row = $stmt->fetch()){
  ?><p><?=$row["aboutContent"]?></p><?php
}else{
  ?><p>"Not found"</p><?php
};

?>