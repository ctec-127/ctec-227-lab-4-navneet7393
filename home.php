<?php
// home.php
session_start();
$pageTitle = 'Home';
require 'inc/header.inc.php';
?>

<a href="register.php">Register</a>
<a href="login.php" id="login">Login</a>
<a href="" id="logout">Logout</a>

<h1>Welcome to our great site <?= isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'New User!' ?></h1>
<div id="message"></div>
<!-- <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script src="js/script.js"></script>

<?php require 'inc/footer.inc.php' ?>