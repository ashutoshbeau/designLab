<?php  
//session_start();
include("Volunteer.php");
include("VolunteerManager.php");
$error_array=array();

if (isset($_POST['submit'])){
    global $error_array;
    $obj1=new Volunteer($_POST['fname'],$_POST['dob'],$_POST['digilocker'],$_POST['email'],$_POST['password'],$_POST['repassword'],$_POST['phone'],$_POST['wno'],$_POST['locality'],$_POST['service'],$_POST['t1'],$_POST['t2']);
    $ob2=new VolunteerManager();
    $error_array=$ob2->registerVolunteer($obj1);
}
?>


<!DOCTYPE html>
<html>
    <head>
    <!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Volunteer Registration</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="topnav">
            <img src="img/logo.jpg" style="float: right ;" width="56" height="50" alt="logo">
            <a href="homepage.html">Home</a>
            <a href="loginvolunteer.php">Login</a>
        </div>
        <div class="container1">
            <div><h1>Kindly Enter Your Details.</h1></div>
        </div>
        <div class ="container2">
            <form action="registervolunteer.php" method="POST">
                <div class="row">
                    <div class="col-25">
                        <label for="fname"> Name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fname" name="fname" placeholder="Your Name.." required>
                    </div>
                </div>
                <?php if(in_array("Only alphabets and white spaces allowed for name <br>", $error_array)) echo "<font color=red>Only alphabets and white spaces allowed for name</font> <br>"; ?>       

                <div class="row">
                    <div class="col-25">
                        <label for="dob">DOB</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="dob" name="dob" placeholder="Enter DOB.." required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="digilocker">DigiLocker ID</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="digilocker" name="digilocker" placeholder="Enter Digilocker Id..Make sure you have your identity proof uploaded in it" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="email">Email ID</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="email" name="email" placeholder="Enter your email address..." required>
                    </div>
                </div>
                <?php if(in_array("Email already in use<br>",$error_array)) echo "<font color=red>Email already in use</font><br>";
                else if (in_array("Invalid email format<br>",$error_array)) echo "<font color=red>Invalid email format</font><br>" ?>

                <div class="row">
                    <div class="col-25">
                        <label for="Password">Password</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="password" name="password" placeholder="Enter your password..." required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="repassword">Retype Password</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="repassword" name="repassword" placeholder="Retype your Password..." required>
                    </div>
                </div>
                <?php if(in_array("Your passwords do not match<br>", $error_array)) echo "<font color=red>Your passwords do not match</font><br>"; 
		        else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "<font color=red>Your password can only contain english characters or numbers</font><br>";
	            ?>

                <div class="row">
                    <div class="col-25">
                        <label for="phone">Phone No</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="phone" name="phone" placeholder="Enter your Phone No..." required>
                    </div>
                </div>
                <?php if(in_array("Only numeric allowed for phone no <br>", $error_array)) echo "<font color=red>Only numeric allowed for phone no </font><br>"; 
                else if (in_array("Phone no should be of 10 digits <br>", $error_array)) echo "<font color=red>Phone no should be of 10 digits </font><br>"; ?>       

                <div class="row">
                    <div class="col-25">
                        <label for="wno">WhatsApp No</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="wno" name="wno" placeholder="Enter your WhatsApp No..." required>
                    </div>
                </div>
                <?php if(in_array("Only numeric allowed for Whatsapp no <br>", $error_array)) echo "<font color=red>Only numeric allowed for Whatsapp no </font><br>"; 
                else if (in_array("Whatsapp no should be of 10 digits <br>", $error_array)) echo "<font color=red>Whatsapp no should be of 10 digits</font> <br>"; ?> 

                <div class="row">
                    <div class="col-25">
                        <label for="locality">Locality</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="locality" name="locality" placeholder="Enter your service locality..." required>
                    </div>
                </div>

                <div>Check the boxes accordingly</div>

                <div class="row">
                    <div class="col-25">
                        <label>Need Payment For Service</label>
                    </div>
                    <div class="col-75">
                        <input type="checkbox" id="service0" name="service[]" value="payment_needed">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label>Can arrange Beds</label>
                    </div>
                    <div class="col-75">
                        <input type="checkbox" id="service1" name="service[]" value="bed" >
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label>Can arrange Food</label>
                    </div>
                    <div class="col-75">
                        <input type="checkbox"  id="service2" name="service[]" value="food">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-25">
                        <label>Other Service (Medicines, Grocery Items etc)</label>
                    </div>
                    <div class="col-75">
                        <input type="checkbox"  id="service3" name="service[]" value="other_items" >
                    </div>
                </div>

                <div> Select Slot Timing</div>
                <div class="row">
                    <div class="col-25">
                        <label for="t1">From</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="t1" name="t1" placeholder="Enter 0 for 12AM 12 for 12PM and likewise.. ." required >
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="t2">To</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="t2" name="t2" placeholder="Enter 0 for 12AM 12 for 12PM and likewise.. ." >
                    </div>
                </div>

                <div class="row">
                    <input type="submit" value="Submit" name="submit">
                </div>
 
            </form>
        </div>

        <footer>
            <p>Mail us at: <br> <a href="mailto:hege@example.com">hege@example.com</a></p>
         </footer>
    </body>
</html>
