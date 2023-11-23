<?php session_start();
include("header.php");
if (!isset($_SESSION['loggedIn']) || !$_SESSION['is_admin'] == '1') {
    header("Location: login.php");
    exit;
}else{

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";
$dbpassword = "";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

$stmt = $pdo->prepare("SELECT `aboutContent` FROM `about` WHERE `aboutId` = 2;");

$stmt->execute();

$row = $stmt->fetch();

?>
<h1>Edit About Information</h1>

<form action="about-update.php" method="POST">
    About Content:
    <textarea name="aboutContent" style="width: 100%; height: 200px;"><?=$row["aboutContent"]?></textarea>
    <input type="submit" />
</form><?php
}
