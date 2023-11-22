<?php
session_start();
include("header.php");

if (!isset($_SESSION['loggedIn']) || !$_SESSION['is_admin'] == '1') {
    header("Location: login.php");
    exit;
}else{

?><h1>Administrator Dashboard</h1>
<h1>Hello, <?=$_SESSION["username"] ?></h1>
<a href="select-articles.php">Add, Edit and Delete articles</a>
<a href="featured-select.php">Set the featured article</a>
<a href="about-edit.php">Edit About Information</a>
<a href="contact-form.php">View Contact form submissions</a><?php
include("logout-link.php"); ?>
<?php
}