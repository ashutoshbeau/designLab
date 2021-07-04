<?php  
//session_start();
$con = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
//UserManager Class
class UserManager{
    public $fname;
    public $dob;
    public $digilocker;
    public $email;
    public $password1;
    public $password2;
    public $phone;
    public $wno;
    public $address;
    public $locality;
    public $gaddress;
    public $gphone;
    public $t1;
    public $t2;

    public function registerUser()
    
    {
        global $con;
        if(mysqli_connect_errno()) //checking connection
            {
                echo "Failed to connect: " . mysqli_connect_errno();
            }
    $error_array = array(); //Holds error messages
    //values we want to insert in user table
    //$id,$fname,$dob,$digilocker,$email,$password1,$phone,$wno,$locality,$gname,$gphone,$gaddress,$from,$to
    if (isset($_POST['submit']))
    {
        $fname = strip_tags($_POST['fname']); //Remove html tags
       // $fname = str_replace(' ', '', $fname); //remove spaeletterces
        $fname = ucfirst(strtolower($fname)); //Uppercase first
        if(!preg_match("/^[a-zA-Z]*$/", $fname))
        {
            array_push($error_array, "Only alphabets and white spaces allowed for name <br>");
        } 

        $dob = strip_tags($_POST['dob']); //Remove html tags

        $digilocker = strip_tags($_POST['digilocker']); //Remove html tags
        $digilocker = str_replace(' ', '', $digilocker); //remove spaeletterces
        $digilocker = ucfirst(strtolower($digilocker)); //Uppercase first 

        $email = strip_tags($_POST['email']); //Remove html tags
        $email = str_replace(' ', '', $email); //remove spaeletterces
        $email = ucfirst(strtolower($email)); //Uppercase first 
        //Check if email is in valid format 
                if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    
                    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

                    //Check if email already exists 
                    $e_check = mysqli_query($con, "SELECT email FROM user WHERE email='$email'");

                    //Count the number of rows returned
                    $num_rows = mysqli_num_rows($e_check);

                    if($num_rows > 0) {
                        array_push($error_array, "Email already in use<br>");

                    }
                }
                else{
                    array_push($error_array, "Invalid email format<br>");
                }
            

        $password1 = strip_tags($_POST['password']); //Remove html tags
        
        $password2 = strip_tags($_POST['repassword']); //Remove html tags
        if($password1 != $password2) {
            array_push($error_array,  "Your passwords do not match<br>");
        }
        else {
            if(preg_match('/[^A-Za-z0-9]/', $password1)) {
                array_push($error_array, "Your password can only contain english characters or numbers<br>");
            }
        }
        $phone = strip_tags($_POST['phone']); //Remove html tags
        $phone = str_replace(' ', '', $phone); //remove spaeletterces
        $phone = ucfirst(strtolower($phone)); //Uppercase first 
        if(!preg_match("/^[0-9]*$/", $phone))
        {
            array_push($error_array, "Only numeric allowed for phone no <br>");
        }
        if(strlen($phone)!=10)
        {
            array_push($error_array, "Phone no should be of 10 digits <br>");
        }

        $wno = strip_tags($_POST['wno']); //Remove html tags
        $wno = str_replace(' ', '', $wno); //remove spaeletterces
        $wno = ucfirst(strtolower($wno)); //Uppercase first 
        if(!preg_match("/^[0-9]*$/", $wno))
        {
            array_push($error_array, "Only numeric allowed for Whatsapp no <br>");
        }
        if(strlen($wno)!=10)
        {
            array_push($error_array, "Whatsapp no should be of 10 digits <br>");
        }

        $locality = strip_tags($_POST['locality']); //Remove html tags
        $locality = str_replace(' ', '', $locality); //remove spaeletterces
        $locality = ucfirst(strtolower($locality)); //Uppercase first 

        $gname = strip_tags($_POST['gname']); //Remove html tags
        $gname = str_replace(' ', '', $gname); //remove spaeletterces
        $gname = ucfirst(strtolower($gname)); //Uppercase first 
        
        $gphone = strip_tags($_POST['gphone']); //Remove html tags
        $gphone = str_replace(' ', '', $gphone); //remove spaeletterces
        $gphone = ucfirst(strtolower($gphone)); //Uppercase first 
        
        $gaddress = strip_tags($_POST['gaddress']); //Remove html tags
        $gaddress = str_replace(' ', '', $gaddress); //remove spaeletterces
        $gaddress = ucfirst(strtolower($gaddress)); //Uppercase first 

        $t1 = strip_tags($_POST['t1']); //Remove html tags
        $t1 = str_replace(' ', '', $t1); //remove spaeletterces
        $t1 = ucfirst(strtolower($t1)); //Uppercase first 

        $t2 = strip_tags($_POST['t2']); //Remove html tags
        $t2 = str_replace(' ', '', $t2); //remove spaeletterces
        $t2 = ucfirst(strtolower($t2)); //Uppercase first 

        if(empty($error_array)) {
            $password1 = md5($password1); //Encrypt password before sending to database
            //insert into table
            $query = mysqli_query($con, "INSERT INTO user(fname,dob,digilocker,email,password1,phone,wno,locality,gname,gphone,gaddress,t1,t2) VALUES ('$fname','$dob','$digilocker','$email','$password1','$phone','$wno','$locality','$gname','$gphone','$gaddress','$t1','$t2')");

            }
        }
    return $error_array;
        }
}
$ob=new UserManager();
$error_array=$ob->registerUser();

?>



<!DOCTYPE html>
<html>
    <head>
    <!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>User Registration</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="topnav">
            <img src="img/logo.jpg" style="float: right ;" width="56" height="50" alt="logo">
            <a href="homepage.html">Home</a>
            <a href="loginuser.php">Login</a>
        </div>
        <div class="container1">
            <div><h1>Kindly Enter Your Details.</h1></div>
        </div>
        <div class ="container2">
            <form action="registeruser.php" method="POST">
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
                        <label for="address">Address</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="address" name="address" placeholder="Enter your current address..." required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="locality">Locality</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="locality" name="locality" placeholder="Enter your locality..." required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="student">If Student fill the details else write NA</label>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="gname">Guardian Name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="gname" name="gname" placeholder="Your guardian name of student.." >
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-25">
                        <label for="gphone">Guardian Phone No</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="gphone" name="gphone" placeholder="Your guardian phone no of student.." >
                    </div>
                </div>
                 
                <div class="row">
                    <div class="col-25">
                        <label for="gaddress">Guardian Address</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="gaddress" name="gaddress" placeholder="Your guardian address of student.." >
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
