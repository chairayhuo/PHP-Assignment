<?php
include("header.php");

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";
$dbpassword = "";

//connect
$pdo = new PDO($dsn, $dbusername, $dbpassword); 

//prepare
$stmt = $pdo->prepare("SELECT * FROM `articles`;");

//excute
$stmt->execute();

//process results

?>
<ul><?php
while($row = $stmt->fetch()) {     
	?><li>
        <?=$row["articleId"]?>
        <?=$row["articleName"]?>
        <?=$row["articleAuthor"]?>
        <a href="edit-form.php?articleId=<?=$row["articleId"]?>">Edit</a>
        <a href="delete-confirmation.php?articleId=<?=$row["articleId"]?>">Delete</a>
    </li>
<?php
}
?></ul>
<a href="dashboard.php">Back to dashboard</a><?php

?>

