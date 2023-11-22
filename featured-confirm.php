<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["articleId"])) {
    $articleId = $_POST["articleId"];

    $dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
    $dbusername = "root";  
    $dbpassword = "";

    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->beginTransaction();

    try {
        $pdo->query("UPDATE `articles` SET `is_featured` = 0");

        $stmt = $pdo->prepare("UPDATE `articles` SET `is_featured` = 1 WHERE `articleId` = :articleId");
        $stmt->execute([':articleId' => $articleId]);

        $pdo->commit();

        header("Location: featured-select.php");
        exit();
        
    } catch (Exception $e) {
        
        $pdo->rollBack();
        
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    echo("ERROR!");
}
