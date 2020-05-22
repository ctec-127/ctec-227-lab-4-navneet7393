<?php 
/* logout.php */
session_start();

require_once('inc/db_connect.inc.php');
require_once('inc/functions.inc.php');

// log page usage
log_page($db,"Logout");


if(isset($_SESSION['loggedin'])){
	session_unset("loggedin");
	session_unset('first_name');
	session_unset('last_name');
	session_unset('email');
	session_unset('password');
	session_destroy();
}

?>

<?php 
$pageTitle = "Logged Out - Image Gallery";
require_once("inc/header.inc.php");
?>


<?php require_once('inc/navbar.inc.php'); ?>
<h1>Image Gallery Home</h1>
<div class="success">You have been logged out from Image Gallery</div>
<a href="register.php">Register</a>
<a href="login.php" id="login">Login</a>
<a href="" id="logout">Logout</a>
<?php require_once('inc/footer.inc.php') ?>