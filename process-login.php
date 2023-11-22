<?php session_start();

$username = $_POST["username"];
$password = $_POST["password"];

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";  
$dbpassword = "";

$pdo = new PDO($dsn, $dbusername, $dbpassword);

$stmt = $pdo->prepare("SELECT `personId`, `username` , `is_admin`
	FROM `member` 
	WHERE `username` = '$username' AND `password` = '$password';");
$stmt->execute();

if($row = $stmt->fetch()){
		
	$_SESSION["personId"] = $row['personId'];
	$_SESSION["username"] = $row['username'];
	$_SESSION["is_admin"] = $row['is_admin'];
	$_SESSION["loggedIn"] = true;

	include("header.php");

	if ($_SESSION["is_admin"] == 1) {		
		header("Location: dashboard.php");
	} else {
		?><p>You're logged in successfully!</p><?php
		include("logout-link.php");
	}
	
}else{
	include("header.php");
	?><p>Error. <a href="login.php">Try log in again</p><?php
}

?>