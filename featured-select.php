<?php

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";
$dbpassword = "";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

$stmt = $pdo->prepare("SELECT `articleId` , `articleName` FROM `articles` ");

$stmt->execute();


?><h1>Select the Featured Article</h1>
<form action="featured-confirm.php" method="POST">
<select name="articleId"><?php

while($row = $stmt->fetch()) {
    ?><option value="<?=$row["articleId"]?>"><?=$row["articleName"]?></option><?php
}

?></select>
    <input type="submit" value="Set as Featured">
</form>
<?php

$stmt2 = $pdo->prepare("SELECT `articleName` FROM `articles` WHERE `is_featured` =1");
$stmt2->execute();

if($row2 = $stmt2->fetch()){
	?><p>The featured article right now is: <?=$row2["articleName"];?></p><?php
}else{
	?><p>No featured article.</p><?php
}
?>
<a href="dashboard.php">Back to dashboard</a>