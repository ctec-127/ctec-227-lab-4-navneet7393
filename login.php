<?php
// login.php
session_start();
$pageTitle = 'Login';
require 'inc/header.inc.php';
require_once 'inc/db_connect.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $db->real_escape_string($_POST['email']);
    $password = hash('sha512', $db->real_escape_string($_POST['password']));

    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    //  echo $sql;

    $result = $db->query($sql);
    if ($result->num_rows == 1) {

        $_SESSION['loggedin'] = 1;
        $_SESSION['email'] = $email;

        $row = $result->fetch_assoc();
        $_SESSION['first_name'] = $row['first_name'];

        header('location: home.php');
    } else {
        echo '<p>Please try again or go away</p>';
    }
}

?>

<!-- <form action="login.php" method="POST">
    <label for="email">Email</label>
    <br><br>
    <input type="email" name="email" id="email" required>
    <br><br>
    <label for="password">Password</label>
    <span id="showPassword" onclick="showPassword();">Show Password</span>
    <br><br>
    <input type="password" name="password" id="password" required>
    <br><br>
    <input type="submit" value="Login">
</form> -->


<div class="container login">
        <div class="row">
            <div class="col-md-3 login-left">
                <img src="img/imageedit_1_3709156988.png" alt="logo-freeware" />
                <h3>Welcome</h3>
                <p>Are you ready to upload some pictures?</p>
                <input type="submit" name="register" value="Register" /><br />
            </div>
            <div class="col-md-9 login-right">
                <div class="tab-content" id="myTabContent">
                        <h3 class="login-heading">Login</h3>
                        <div class="row login-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                <form action="image-gallery.php" method="POST">
                                    <div class="form-group">
                                        <label for="email">Email :</label>
                                        <input type="email" id="email" class="form-control" placeholder="First Name *" required name="email">
                                        </div>      
                                        <div class="form-group">
                                        <label for="password">Password :</label>
                                        <input type="password" id="password" class="form-control" placeholder="Password *" required name="password">
                                        <span id="showPassword" onclick="showPassword();">Show Password</span>
                                        </div>
                                        <input type="submit" value="Login" name="Login">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script src="js/script.js"></script>

<?php require 'inc/footer.inc.php'; ?>