<?php
include("header.php");

$articleId = $_GET["articleId"];

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";  
$dbpassword = "";

//connect
$pdo = new PDO($dsn, $dbusername, $dbpassword);

//prepare
$stmt = $pdo->prepare("SELECT * FROM `articles` WHERE `articleId` = $articleId;");

//execute
$stmt->execute();
if($row = $stmt->fetch()){

  ?><article>
  <img src="pics/<?=$row["articlePicture"]?>"/>
  <h1><?=$row["articleName"]?></h1>
  <p><?=$row["articleAuthor"]?></p>
  <p><?=$row["articleContent"]?></p>
  <a href="<?=$row["articleLink"]?>">See original article</a> 
  <a href="homepage.php">Go Back</a>
  </article><?php
}else{
  ?><p>"Not found"</p><?php
};

?>