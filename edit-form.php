<?php session_start();
include("header.php");
if (!isset($_SESSION['loggedIn']) || !$_SESSION['is_admin'] == '1') {
    header("Location: login.php");
    exit;
}else{
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
<h1>Edit Information</h1>

<form action="update.php" method="POST">
    Article Name:<input type="text" name="articleName" value="<?=$row["articleName"]?>">
    Article Link:<input type="text" name="articleAuthor" value="<?=$row["articleAuthor"]?>">
    <input type="hidden" name="articleId" value="<?= $row["articleId"] ?>">
    <input type="submit" />
</form><?php
}