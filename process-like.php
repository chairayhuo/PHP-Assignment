<?php session_start();

if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    die('You must be logged in to like articles.');
}

$personId = $_SESSION['personId'];
$articleId = $_POST["articleId"];
$action = $_POST['action'];

$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";  
$dbpassword = "";
$pdo = new PDO($dsn, $dbusername, $dbpassword);

if ($action == 'Like') {
    $stmt = $pdo->prepare("INSERT INTO `member_articles_likes` (`personId`, `articleId`) VALUES ($personId, '$articleId')");
} elseif ($action == 'Unlike') {
    $stmt = $pdo->prepare("DELETE FROM `member_articles_likes` WHERE `personId` = $personId AND `articleId` = $articleId");
}

if (isset($stmt)) {
    $stmt->execute();
}

header("Location: article.php?articleId=$articleId");
exit;
