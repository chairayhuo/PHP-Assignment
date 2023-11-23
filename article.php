<?php session_start();
include("header.php");

$articleId = $_GET['articleId'];

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";  
$dbpassword = "";
$pdo = new PDO($dsn, $dbusername, $dbpassword);

$stmt = $pdo->prepare("SELECT * FROM `articles` WHERE `articleId` = $articleId");
$stmt->execute();
if($row = $stmt->fetch()){

  ?><article>
  <img src="pics/<?=$row["articlePicture"]?>"/>
  <h1><?=$row["articleName"]?></h1>
  <p><?=$row["articleAuthor"]?></p>
  <p><?=$row["articleContent"]?></p>
  <a href="<?=$row["articleLink"]?>">See original article</a> 
  <a href="homepage.php">Go Back</a>
  </article><?php
}else{
  ?><p>"Not found"</p><?php
};


$likeCount = 0;
$userHasLiked = false;
$stmt2 = $pdo->prepare("SELECT COUNT(*) FROM `member_articles_likes` WHERE `articleId` = $articleId");
$stmt2->execute();
$likeCount = (int)$stmt2->fetchColumn();

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    

    $stmt3 = $pdo->prepare("SELECT COUNT(*) FROM `member_articles_likes` WHERE `articleId` = :articleId AND `personId` = :personId");
    $stmt3->bindParam(':articleId', $articleId, PDO::PARAM_INT);
    $stmt3->bindParam(':personId', $_SESSION['personId'], PDO::PARAM_INT);
    $stmt3->execute();
    $userHasLiked = $stmt3->fetchColumn() > 0;

  ?>
  <form action="process-like.php" method="POST">
      <input type="hidden" name="articleId" value="<?= $row["articleId"] ?>">
      <input type="submit" name="action" value="<?= $userHasLiked ? 'Unlike' : 'Like' ?>">
      <?= $userHasLiked ? 'You like this article.' : 'Like this article?' ?>
  </form>
  <?php
}
?>Liked by <?= $likeCount ?> times