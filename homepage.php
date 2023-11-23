<?php
include("header.php");

?><h1>Welcome to immnewsnetwork!</h1>
<p>Here, you can stay informed about the latest industry knowledge. Select the content that interests you and begin your exploration!</p>

<?php
$dsn = "mysql:host=localhost;dbname=immnewsnetwork;charset=utf8mb4";
$dbusername = "root";  
$dbpassword = "";

$pdo = new PDO($dsn, $dbusername, $dbpassword);

$stmt2 = $pdo->prepare("SELECT * FROM `articles` WHERE `is_featured` = 1");

$stmt2->execute();

?><section><?php
if($row2 = $stmt2->fetch()) {
    if ($row2["is_featured"] == 1){
    ?><article><h1>Featured Article</h1>
    <img src="pics/<?=$row2["articlePicture"]?>"/>
    <h2><?=$row2["articleName"]?></h2>
    <p><?=$row2["articleAuthor"]?></p>
    <p><?=$row2["articlePreview"]?></p>
    <a href="article.php?articleId=<?=$row2["articleId"]?>">See full article</a>
    </article><?php
}}
?></section><?php

$stmt = $pdo->prepare("SELECT * FROM `articles`");

$stmt->execute();

?><section><?php
while($row = $stmt->fetch()) {
    if ($row["is_featured"] == 0){
    ?><article>
    <h1><?=$row["articleCategory"]?></h1>
    <img src="pics/<?=$row["articlePicture"]?>"/>
    <h2><?=$row["articleName"]?></h2>
    <p><?=$row["articleAuthor"]?></p>
    <p><?=$row["articlePreview"]?></p>
    <a href="article.php?articleId=<?=$row["articleId"]?>">See full article</a>
    </article><?php
}}
?></section>


    <section>
        <table>
            <tr>
                <td>month</td> <td>site visitors</td>
            </tr>
            <tr>
                <td>October</td> <td>1,245</td>
            </tr>
            <tr>
                <td>September</td> <td>5,489</td>
            </tr>
            <tr>
                <td>August</td> <td>4,801</td>
            </tr>
            <tr>
                <td>July</td> <td>2,490</td>
            </tr>
            <tr>
                <td>June</td> <td>9,012</td>
            </tr>
            <tr>
                <td>May</td> <td>7,076</td>
            </tr>
        </table>
    </section>

    <section>
        <iframe width="560" height="315" 
            src="https://www.youtube.com/embed/LbtmzpSh2Co?si=zWX3CuPJ_jmX6Ls9" 
            title="YouTube video player" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
            allowfullscreen>
        </iframe>
    </section>

    <footer> 
        about cookie usage
        <a href="#">accept cookies</a>    
    </footer>