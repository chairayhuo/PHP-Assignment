<?php session_start();
include("header.php");


$articleId = $_GET['articleId'];

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";  
$dbpassword = "";
$pdo = new PDO($dsn, $dbusername, $dbpassword);

$stmt = $pdo->prepare("SELECT * FROM `articles` WHERE `articleId` = :articleId");
// $stmt->bindParam(':articleId', $articleId, PDO::PARAM_INT);
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

$userLikeExists = false;
$likeCount = 0;
if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true){
  if (isset($_SESSION['personId'])) {
    $personId = $_SESSION['personId'];

    $likeCheckStmt = $pdo->prepare("SELECT COUNT(*) FROM `member_articles_likes` WHERE `personId` = :personId AND `articleId` = :articleId");
  //   $likeCheckStmt->bindParam(':personId', $personId, PDO::PARAM_INT);
  // $likeCheckStmt->bindParam(':articleId', $articleId, PDO::PARAM_INT);
  $likeCheckStmt->execute();
  $userLikeExists = $likeCheckStmt->fetchColumn() > 0;

  $likeStmt = $pdo->prepare("SELECT COUNT(*) FROM `member_articles_likes` WHERE `articleId` = :articleId");
    // $likeStmt->bindParam(':articleId', $articleId, PDO::PARAM_INT);
    $likeStmt->execute();
    $likeCount = $likeStmt->fetchColumn();

}else{
  echo "<p>Error: User ID is not set in the session.</p>";
}
  
if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true) {
  ?><form action="process-like.php" method="POST">
      <input type="hidden" name="articleId" value="<?= htmlspecialchars($articleId) ?>">
      <input type="submit" name="action" value="<?= $userLikeExists ? 'Unlike' : 'Like' ?>">
      Liked by <?= htmlspecialchars($likeCount) ?> times
  </form><?php
}};




<?php
session_start();

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";  
$dbpassword = "";
$pdo = new PDO($dsn, $dbusername, $dbpassword);

$articleId = $_POST['articleId'];
$personId = $_SESSION['personId']; 
$action = $_POST['action'];

if ($action == 'Like') {
    $stmt = $pdo->prepare("INSERT INTO member_articles_likes (personId, articleId) VALUES (:personId, :articleId)");
    $stmt->execute([':personId' => $personId, ':articleId' => $articleId]);
} elseif ($action == 'Unlike') {
    $stmt = $pdo->prepare("DELETE FROM member_articles_likes WHERE personId = :personId AND articleId = :articleId");
    $stmt->execute([':personId' => $personId, ':articleId' => $articleId]);
}

header("Location: article.php?articleId=" . $articleId);
exit;
?>


$stmt = $pdo->prepare("SELECT COUNT(*) FROM `member_articles_likes` WHERE `personId` = :personId AND `articleId` = :articleId");
$stmt->bindParam(':personId', $personId, PDO::PARAM_INT);
$stmt->bindParam(':articleId', $articleId, PDO::PARAM_INT);
$stmt->execute();
$likeExists = $stmt->fetchColumn() > 0;

if($action === 'like' && !$likeExists){
		
	$insertStmt = $pdo->prepare("INSERT INTO `member_articles_likes` (`personId`, `articleId`) VALUES (:personId, :articleId)");
    $insertStmt->bindParam(':personId', $personId, PDO::PARAM_INT);
    $insertStmt->bindParam(':articleId', $articleId, PDO::PARAM_INT);
    $insertStmt->execute();
	
}elseif($action === 'unlike' && $likeExists){
	$deleteStmt = $pdo->prepare("DELETE FROM `member_articles_likes` WHERE `personId` = :personId AND `articleId` = :articleId");
    $deleteStmt->bindParam(':personId', $personId, PDO::PARAM_INT);
    $deleteStmt->bindParam(':articleId', $articleId, PDO::PARAM_INT);
    $deleteStmt->execute();
}

header("Location: article.php?articleId=" . $articleId);
exit;

}