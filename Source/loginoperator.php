<?php
session_start();
include("Operator.php");
$conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
if (isset($_POST['submit']))
{
    $e=$_POST['email'];
    $p=$_POST['password'];
    $obj=new Operator($e,$p);
    $r=$obj->verify();
    if ($r==0)
    {
        echo"<font color=red><b> Wrong Password or Wrong Email </b></font>";
    }
    else{
        
        $check_database_query = mysqli_query($con, "SELECT * FROM operator WHERE email='$e' AND password1='$p'");
        $check_login_query = mysqli_num_rows($check_database_query);
        $row = mysqli_fetch_array($check_database_query);
        $opmail = $row['email'];
        $_SESSION['pass'] = $row['password1'];
        $_SESSION["omail"]=$opmail;
        header("Location: OperatorPage.php");
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
        <title>Operator Login</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="topnav">
            <img src="img/logo.jpg" style="float: right ;" width="56" height="50" alt="logo">
            <a href="homepage.html">Home</a>
            
        </div>
        <div class="container1">
            <div><h1>Enter Operator's Login Credentials.</h1></div>
        </div>   
        <div class="container2">
        <form action="loginoperator.php" method="POST">
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
                    <label for="password">Password</label>
                </div>
               <div class="col-25">
                    <input type="password" style="padding: 12px;width: 310px;height:40px;border: 1px solid #1d2e4a;border-radius: 4px;" id="password" name="password" placeholder="Enter your password..." required>
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