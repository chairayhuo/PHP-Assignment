<?php

$articleId = $_GET["articleId"];

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";
$dbpassword = "";

//connect
$pdo = new PDO($dsn, $dbusername, $dbpassword); 

//prepare
$stmt = $pdo->prepare("SELECT * FROM `articles` WHERE `articles` . `articleId` = $articleId;");

//excute
$stmt->execute();

//process results
$row = $stmt->fetch();

?>

<h1>Delete Confirmation</h1>
<p>Are you sure you want to delete this record?</p>

<div>
    <p>Article Name:<?=$row["aName"]?></p>
    <p>Article Link:<?=$row["aLink"]?></p>
</div>

<a href="select-articles.php">No</a>
<form action="delete.php" method="POST">
    <input type="hidden"
    name="articleId"
    value="<?=$row['articleId']?>"
    >
    <input type="submit" value="Yes">
</form>

