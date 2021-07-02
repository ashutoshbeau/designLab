<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable

class LoginManager{
    public $email;
    public $password;

    public function verify()
    {
        global $con;
        if(isset($_POST['submit'])){
            $email = strip_tags($_POST['email']); //Remove html tags
            $email = str_replace(' ', '', $email); //remove spaeletterces
            $email = ucfirst(strtolower($email)); //Uppercase first 
            $password = strip_tags($_POST['password']); //Remove html tags
            $password = md5($password); //Get password
            $check_database_query = mysqli_query($con, "SELECT * FROM user WHERE email='$email' AND password1='$password'");
            $check_login_query = mysqli_num_rows($check_database_query);

            if($check_login_query == 1) {
                $row = mysqli_fetch_array($check_database_query);
                $username = $row['id'];
               
                header("Location: usernext.html");
                exit();
	        }
            else
            {
            echo"<font color=red><b> Wrong Password or Wrong Email </b></font>";
            }
        }
    }
}
$obj= new LoginManager();
$obj->verify();
?>

<!DOCTYPE html>
<html>
    <head>
    <!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>User Login</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="topnav">
            <img src="img/logo.jpg" style="float: right ;" width="56" height="50" alt="logo">
            <a href="homepage.html">Home</a>
            <a href="registeruser.php">Register</a>
        </div>
        <div class="container1">
            <div><h1>Enter Login Credentials.</h1></div>
        </div>   
        <div class="container2">
        <form action="loginuser.php" method="POST">
            <div class="row">
                <div class="col-25">
                    <label for="email">Email </label>
                </div>
                <div class="col-75">
                    <input type="text" id="email" name="email" placeholder="Enter your email address..." required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="Password">Password</label>
                </div>
                <div class="col-75">
                    <input type="text" id="password" name="password" placeholder="Enter your password..." required>
                </div>
            </div>

            <div class="row">
                <input type="submit" value="Submit" name="submit">
                <input type="reset" value="Reset">
            </div>
        </form>
        </div>
    </body>
</html>