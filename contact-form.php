<?php session_start();
include("header.php");
if (!isset($_SESSION['loggedIn']) || !$_SESSION['is_admin'] == '1') {
    header("Location: login.php");
    exit;
}else{

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";
$dbpassword = "";

//connect
$pdo = new PDO($dsn, $dbusername, $dbpassword); 

//prepare
$stmt = $pdo->prepare("SELECT * FROM `contact`;");

//excute
$stmt->execute();

//process results

?>
<ul><?php
while($row = $stmt->fetch()) {     
	?><li>
        <?=$row["Name"]?>
        <?=$row["Email"]?>
        <?=$row["interests"]?>
        <?=$row["YourRole"]?>
    </li>
<?php
}
?></ul>
<a href="dashboard.php">Back to dashboard</a><?php

}