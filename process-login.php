<?php
//process-login.php

$username = $_POST["username"];
$password = $_POST["password"];

$dsn = "mysql:host=localhost;dbname=PersonApp;charset=utf8mb4";
$dbusername = "root";
$dbpassword = "";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

$stmt = $pdo->prepare("SELECT `personId`, `username` 
    FROM `person` 
    WHERE `person` . `username` = '$username' AND `person` . `password` = '$password';");
$stmt->execute();

if($row = $stmt->fetch()){
	?>
	<p>Hello, I am dashboard</p><?php
	$_SESSION["personId"] = $row['personId'];
	$_SESSION["username"] = $row['username'];
	$_SESSION["loggedIn"] = true;
	?><a href="select-persons.php">View all persons</a><?php
}else{
	
	?><p>Error. <a href="login.php">Try login again</p><?php
}

?>