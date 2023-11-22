<?php
include("header.php");

$username = $_POST["username"];
$password = $_POST["password"];

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";
$dbpassword = "";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

$stmt = $pdo->prepare("INSERT INTO `member`
(`username`,`password`)
VALUES
('$username','$password');");

if($stmt->execute()){ 
?>
    <h1>You're registered successfully!</h1>    
<?php
}else{ 
	?><h1>Error</h1> <?php
}
?>