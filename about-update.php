<?php session_start();
include("header.php");
if (!isset($_SESSION['loggedIn']) || !$_SESSION['is_admin'] == '1') {
    header("Location: login.php");
    exit;
}else{

$aboutContent = $_POST["aboutContent"];

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";  
$dbpassword = "";

$pdo = new PDO($dsn, $dbusername, $dbpassword);

$stmt = $pdo->prepare("UPDATE `about` 
	SET `aboutContent` = '$aboutContent';");

if($stmt->execute()){
	?><p>ABOUT CONTENT UPDATED</p><?php
}else{
	?><p>Could not UPDATE record</p><?php
}
?>
<a href="dashboard.php">Back to dashboard</a><?php
}