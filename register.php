<?php
// register.php
$pageTitle = "Register";
require 'inc/header.inc.php';
require_once 'inc/db_connect.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $db->real_escape_string($_POST['email']);
    $first_name = $db->real_escape_string($_POST['first_name']);
    $last_name = $db->real_escape_string($_POST['last_name']);
    $password = hash('sha512', $db->real_escape_string($_POST['password']));

    $sql = "INSERT INTO user (email,first_name,last_name,password) 
                    VALUES('$email','$first_name','$last_name','$password')";

    // echo $sql;
    $result = $db->query($sql); 

    if (!is_dir('uploads/' . $email)) {
        mkdir('uploads/' . $email);
    }


}
?>

    <div class="container login">
        <div class="row">
            <div class="col-md-3 login-left">
                <img src="img/imageedit_1_3709156988.png" alt="logo-freeware" />
                <h3>Welcome</h3>
                <p>Are you ready to upload some pictures?</p>
                <a class="loginbtn" href="login.php" title="Login Page">Login</a>
            </div>
            <div class="col-md-9 login-right">
                <div class="tab-content" id="myTabContent">
                        <h3 class="login-heading">Register Here</h3>
                        <div class="row login-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                <form action="register.php" method="POST">
                                    <div class="form-group">
                                    <?php
                                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                            if (!$result) {
                                                echo "<div class= 'alert alert-danger'>There was a problem registering your account</div>";
                                            } else {
                                                echo "<div class='alert alert-success'>You are successfully registered Please login to view your account .!</div>";
                                                echo '<a href="login.php" title="Login Page">Login</a>';
                                            }
                                        }
                                        ?> <br><br>
                                        <label for="email">Email :</label>
                                        <input type="email" id="email" class="form-control" placeholder="First Name *" required name="email">
                                        </div>      
                                        <div class="form-group">
                                        <label for="password">Password :</label>
                                        <input type="password" id="password" class="form-control" placeholder="First Name *" required name="password">
                                        </div>
                                        <div class="form-group">
                                        <label for="first_name">First Name : </label>
                                        <input type="text" id="first_name" class="form-control" placeholder="First Name *" required name="first_name">
                                        </div>  
                                        <div class="form-group">
                                        <label for="last_name">Last Name :</label>
                                        <input type="text" id="last_name" class="form-control" placeholder="First Name *" required name="last_name">
                                        </div>  
                                        <input class="registerBtn" type="submit" value="Register" name="register">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require 'inc/footer.inc.php'; ?>