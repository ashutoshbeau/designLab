<?php
session_start();
include("VolunteerLoginManager.php");
$con = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
if (isset($_POST['submit']))
{
    $e=$_POST['email'];
    $p=$_POST['password'];
    $obj=new VolunteerLoginManager($e,$p);
    $r=$obj->verify();
    if ($r==0)
    {
        echo"<font color=red><b> Wrong Password or Wrong Email </b></font>";
    }
    else{
        $p=md5($p);
        $check_database_query = mysqli_query($con, "SELECT * FROM volunteer WHERE email='$e' AND password1='$p'");
        $check_login_query = mysqli_num_rows($check_database_query);
        $row = mysqli_fetch_array($check_database_query);
        $volname = $row['fname'];
        //echo "vname".$volname;
        $_SESSION["vname"]=$volname;
        header("Location: volunteernext.html");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
    <!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Volunteer Login</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="topnav">
            <img src="img/logo.jpg" style="float: right ;" width="56" height="50" alt="logo">
            <a href="homepage.html">Home</a>
            <a href="registervolunteer.php">Register</a>
        </div>
        <div class="container1">
            <div><h1>Enter Volunteer's Login Credentials.</h1></div>
        </div>   
        <div class="container2">
        <form action="loginvolunteer.php" method="POST">
            <div class="row">
                <div class="col-25">
                    <label for="email">Email </label>
                </div>
                <div class="col-25">
                    <input type="text" id="email" name="email" placeholder="Enter your email address..." required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="Password">Password</label>
                </div>
                <div class="col-75">
                    <input type="password" id="password" name="password" style="padding: 12px;width: 310px;height:40px;border: 1px solid #1d2e4a;border-radius: 4px;" placeholder="Enter your password..." required>
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