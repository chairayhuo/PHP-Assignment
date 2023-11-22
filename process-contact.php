<?php
include("header.php");

$Name = $_POST["Name"];
$Email = $_POST["Email"];
$interests = $_POST["interests"];
$YourRole = $_POST["YourRole"];

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";
$dbpassword = "";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

$stmt = $pdo->prepare("INSERT INTO `contact`
(`Name`,`Email`,`interests`,`YourRole`)
VALUES
('$Name','$Email','$interests','$YourRole');");

if($stmt->execute()){ 
?>
    <h1>Thank you!</h1>    
<?php
}else{ 
	?><h1>Error</h1> <?php
}
?>