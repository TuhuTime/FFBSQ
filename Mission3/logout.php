<?php
session_start();
session_destroy();
header("Location: login.php");
exit;
$pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'siteuser', '');