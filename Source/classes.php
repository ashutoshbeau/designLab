<?php

class Order{
    public $item;
    public $userName;
    public $additionalDescription;
    public $location;
    public $volunteerName;
    public $userInfo;
    public $volunteerStatus;  
}

class OrderManager{
   
    public function insertOrderDetails(Order $order){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $query= "insert into helpdb(Item, Username, Volname, UInfo, VStatus, AdditionalDescription, Location) VALUES('$order->item', '$order->userName', '$order->volunteerName', '$order->userInfo', '$order->volunteerStatus', '$order->additionalDescription', '$order->location')";
        $result = mysqli_query($conn, $query);
        return $result;    
    }
    public function getRejectionDetails($uname){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $query="select Volname, Item, AdditionalDescription, Location from helpdb where Username='$uname' and VStatus=-1 and Volname <> '-1'";
        $result=mysqli_query($conn, $query);
        return $result;
    }
    public function getHelplineInfo($uname){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $query="select Location, Item, AdditionalDetails, Helpline from info where Location in (select distinct Location from helpdb where Username='$uname' and UInfo=1)";
        $result=mysqli_query($conn, $query);
        return $result;
    }
    public function orderFulfilled($uname, $vname){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $query= "update helpdb set VStatus=0 where Username='$uname' and Volname='$vname'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    public function fetchOrderDetails($vname){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $query="select Username, Item, AdditionalDescription, Location from helpdb where Volname='$vname' and VStatus=-99";
        $result=mysqli_query($conn, $query);
        return $result;
    }
    public function acceptOrder($uname, $vname){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $row = mysqli_fetch_array(mysqli_query($conn, "select VStatus from helpdb where Username='$uname' and Volname='$vname'"));

        if($row['VStatus']!=1){
          $query2= "UPDATE helpdb SET VStatus=1 WHERE Username='$uname' and Volname='$vname'";
          $result2 = mysqli_query($conn, $query2);
          return $result2;
        }
        else
          return !$result2;
    }
    public function rejectOrder($vname, $uname){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $row = mysqli_fetch_array(mysqli_query($conn, "select VStatus from helpdb where Username='$uname' and Volname='$vname'"));
        if($row['VStatus']!=-1){
            $query2= "UPDATE helpdb SET VStatus=-1 WHERE Username='$uname' and Volname='$vname'";
            $result2 = mysqli_query($conn, $query2);
            return $result2;
        }
        else
            return !$result2;      
    }
}

class StatusManager{
	public $vname;
	function changeStatusOn($vname){
		$conn = mysqli_connect("localhost", "root", "", "esahoyog");

		$query= "update volunteer set status_flag=1 where fname='$vname'";
		$result = mysqli_query($conn, $query);
		if($result){
			return 1;
		}else{
			return 0;
		}
	}
	function changeStatusOff($vname){
		$conn = mysqli_connect("localhost", "root", "", "esahoyog");
		$query= "update volunteer set status_flag=0 where fname='$vname'";
		$result = mysqli_query($conn, $query);
		if($result){
			return 1;
		}else{
			return 0;
		}
	}
	
	function deleteAccount($vname){
		$conn = mysqli_connect("localhost", "root", "", "esahoyog");
		
		$pwd="-99";
		$pwd=md5($pwd);
		$query= "update volunteer set password1='$pwd' where fname='$vname'";
		$result = mysqli_query($conn, $query);
		if($result){
			return 1;
		}else{
			return 0;
		}
	}
}

class UserLoginManager{
    public $email;
    public $password;

    public function __construct($e,$p)
    {
        
            $email = strip_tags($e); //Remove html tags
            $email = str_replace(' ', '', $email); //remove spaeletterces
            $this->email = ucfirst(strtolower($email)); //Uppercase first 
            $password = strip_tags($p); //Remove html tags
            $this->password = md5($password); //Get password
            
    }
    public function verify(){
        $con = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $e=$this->email;
        $p=$this->password;
        $check_database_query = mysqli_query($con, "SELECT * FROM user WHERE email='$e' AND password1='$p'");
        
            $check_login_query = mysqli_num_rows($check_database_query);

            if($check_login_query == 1) {
                return 1;
	        }
            else
            {
                return 0;
            }
        
    }
}

class UserManager{
    public function registerUser($obj)
    {
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $error_array = array(); //Holds error messages
        $r=$obj->verifyname();
         if ($r==0)
         {
            array_push($error_array, "Only alphabets and white spaces allowed for name <br>");
 
         }
         $r=$obj->verifyemail ();   

         if($r == 0) {
             array_push($error_array, "Email already in use<br>");
         }
     
         else if ($r==-1){
         array_push($error_array, "Invalid email format<br>");
        }
        $r=$obj->verifypassword();
        if ($r == 0)
        {
            array_push($error_array,  "Your passwords do not match<br>");
        }
        else if ($r == -1)
        {
            array_push($error_array, "Your password can only contain english characters or numbers<br>");
        }
        $r=$obj->verifyphonenumber();
        if($r == 0 )
        {
            array_push($error_array, "Only numeric allowed for phone no <br>");
        }
        if($r== -1)
        {
            array_push($error_array, "Phone no should be of 10 digits <br>");
        }
        $r=$obj->verifywpnumber(); 
        if($r== 0)
        {
            array_push($error_array, "Only numeric allowed for Whatsapp no <br>");
        }
        if($r== -1)
        {
            array_push($error_array, "Whatsapp no should be of 10 digits <br>");
        }
        if(empty($error_array)) {
            $obj->password1 = md5($obj->password1); //Encrypt password before sending to database
            //insert into table
            $query = mysqli_query($conn, "INSERT INTO user(fname,dob,digilocker,email,password1,phone,wno,locality,gname,gphone,gaddress,t1,t2) VALUES ('$obj->fname','$obj->dob','$obj->digilocker','$obj->email','$obj->password1','$obj->phone','$obj->wno','$obj->locality','$obj->gname','$obj->gphone','$obj->gaddress','$obj->t1','$obj->t2')");
              }
        
        return $error_array;
    
    }
    function showUserContactDetails($vname){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $query="select fname, email, phone, wno, locality, gaddress from user where fname in (select distinct Username from helpdb where Volname='$vname' and VStatus=1)";
        $result=mysqli_query($conn, $query);
        return $result;

    }
}


class VolunteerLoginManager{
    public $email;
    public $password;

    public function __construct($e,$p)
    {
        
            $email = strip_tags($e); //Remove html tags
            $email = str_replace(' ', '', $email); //remove spaeletterces
            $this->email = ucfirst(strtolower($email)); //Uppercase first 
            $password = strip_tags($p); //Remove html tags
            $this->password = md5($password); //Get password
            
    }
    public function verify(){
        $con = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $e=$this->email;
        $p=$this->password;
        $check_database_query = mysqli_query($con, "SELECT * FROM volunteer WHERE email='$e' AND password1='$p'");
            $check_login_query = mysqli_num_rows($check_database_query);

            if($check_login_query == 1) {
                return 1;
	        }
            else
            {
                return 0;
            }
        
    }
}

class VolunteerManager{
    public function registerVolunteer($obj)
    {
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
            $error_array = array(); //Holds error messages
            $r=$obj->verifyname();
             if ($r==0)
             {
                array_push($error_array, "Only alphabets and white spaces allowed for name <br>");
     
             }
             $r=$obj->verifyemail ();   
    
             if($r == 0) {
                 array_push($error_array, "Email already in use<br>");
             }
         
             else if ($r==-1){
             array_push($error_array, "Invalid email format<br>");
            }
            $r=$obj->verifypassword();
            if ($r == 0)
            {
                array_push($error_array,  "Your passwords do not match<br>");
            }
            else if ($r == -1)
            {
                array_push($error_array, "Your password can only contain english characters or numbers<br>");
            }
            $r=$obj->verifyphonenumber();
            if($r == 0 )
            {
                array_push($error_array, "Only numeric allowed for phone no <br>");
            }
            if($r== -1)
            {
                array_push($error_array, "Phone no should be of 10 digits <br>");
            }
            $r=$obj->verifywpnumber(); 
            if($r== 0)
            {
                array_push($error_array, "Only numeric allowed for Whatsapp no <br>");
            }
            if($r== -1)
            {
                array_push($error_array, "Whatsapp no should be of 10 digits <br>");
            }
            if(empty($error_array)) {
                $obj->password1 = md5($obj->password1); //Encrypt password before sending to database
                //insert into table
                $obj->status_flag="1";
                $query = mysqli_query($conn, "INSERT INTO volunteer(fname,dob,digilocker,email,password1,phone,wno,locality,service,t1,t2,status_flag) VALUES ('$obj->fname','$obj->dob','$obj->digilocker','$obj->email','$obj->password1','$obj->phone','$obj->wno','$obj->locality','$obj->service','$obj->t1','$obj->t2','$obj->status_flag')");
             }
            
            return $error_array;
        
        }
        function showVolunteersDetails($location){
            $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
            $query="select fname, locality, service, status_flag from volunteer where locality='$location'";
            $result=mysqli_query($conn, $query);
            return $result;
        }
        function getVolContactDetails($uname){
            $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
            $query="select fname, email, phone, wno, locality, service, t1, t2 from volunteer where fname in (select distinct Volname from helpdb where Username='$uname' and VStatus=1 and Volname is not null)";
            $result=mysqli_query($conn, $query);
            return $result;
        }
	
}

class User{
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
    public $gname;
    public $gaddress;
    public $gphone;
    public $t1;
    public $t2;
    public function __construct($f,$d1,$d2,$e,$p1,$p2,$ph,$w,$l,$gn,$ga,$gp,$i,$j){
        $fname=strip_tags($f);
        $this->fname = ucfirst(strtolower($fname)); //Uppercase first

        $this->dob=strip_tags($d1);

        $digilocker=strip_tags($d2);
        $digilocker = str_replace(' ', '', $digilocker); //remove spaeletterces
        $this->digilocker = ucfirst(strtolower($digilocker)); //Uppercase first 

        $email=strip_tags($e);
        $email = str_replace(' ', '', $email); //remove spaeletterces
        $this->email = ucfirst(strtolower($email)); //Uppercase first 
    
        $this->password1=strip_tags($p1);

        $this->password2=strip_tags($p2);

        $phone=strip_tags($ph);
        $phone = str_replace(' ', '', $phone); //remove spaeletterces
        $this->phone = ucfirst(strtolower($phone)); //Uppercase first 

        $wno=strip_tags($w);
        $wno = str_replace(' ', '', $wno); //remove spaeletterces
        $this->wno = ucfirst(strtolower($wno)); //Uppercase first

        $locality=strip_tags($l);
        $locality = str_replace(' ', '', $locality); //remove spaeletterces
        $this->locality = ucfirst(strtolower($locality)); //Uppercase first 

        $gname=strip_tags($gn);
        $gname = str_replace(' ', '', $gname); //remove spaeletterces
        $this->gname = ucfirst(strtolower($gname)); //Uppercase first 
    

        $gaddress=strip_tags($ga);
        $gaddress = str_replace(' ', '', $gaddress); //remove spaeletterces
        $this->gaddress = ucfirst(strtolower($gaddress)); //Uppercase first 
    
        $gphone=strip_tags($gp);
        $gphone = str_replace(' ', '', $gphone); //remove spaeletterces
        $this->gphone = ucfirst(strtolower($gphone)); //Uppercase first 
        
        $t1=strip_tags($i);
        $t1 = str_replace(' ', '', $t1); //remove spaeletterces
        $this->t1 = ucfirst(strtolower($t1)); //Uppercase first 

        $t2=strip_tags($j);
        $t2 = str_replace(' ', '', $t2); //remove spaeletterces
        $this->t2 = ucfirst(strtolower($t2)); //Uppercase first 

    }
    public function verifyname()
    {
    if(!preg_match("/^[a-zA-Z ]*$/",$this->fname))
    {
        return 0;
     }
    return 1;
    }
    public function verifyemail(){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog");
        
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                
            $this->email = filter_var($this->email, FILTER_VALIDATE_EMAIL);

        //Check if email already exists 
            $e=$this->email;
            $e_check = mysqli_query($conn, "SELECT email FROM user WHERE email='$e'");

        //Count the number of rows returned
            $num_rows = mysqli_num_rows($e_check);
            if ($num_rows >0)
            {return 0;}
            else
            {return 1;}
        }
        else{
            return -1;
        }
    }
    public function verifypassword()
    {
        if($this->password1 != $this->password2) {
            return 0;
        }
        else {
            if(preg_match('/[^A-Za-z0-9]/', $this->password1)) {
                return -1;
            }
            else{
                return 1;
            }
        }
    }
    public function verifyphonenumber()
    {
        if (!preg_match("/^[0-9]*$/", $this->phone))
        {
            return 0;
        }
        else if (strlen($this->phone)!=10){
            return -1;
        }
        else{
            return 1;
        }
    }
    public function verifywpnumber()
    {
        if (!preg_match("/^[0-9]*$/", $this->wno))
        {
            return 0;
        }
        else if (strlen($this->wno)!=10){
            return -1;
        }
        else{
            return 1;
        }
    }
    
}

class Volunteer{
    public $fname;
    public $dob;
    public $digilocker;
    public $email;
    public $password1;
    public $password2;
    public $phone;
    public $wno;
    public $locality;
    public $service;
    public $t1;
    public $t2;
    public $status_flag;//not to be taken as parameter...default value to be entered
    public function __construct($f,$d1,$d2,$e,$p1,$p2,$ph,$w,$l,$se,$i,$j){
        $fname=strip_tags($f);
        $this->fname = ucfirst(strtolower($fname)); //Uppercase first

        $this->dob=strip_tags($d1);

        $digilocker=strip_tags($d2);
        $digilocker = str_replace(' ', '', $digilocker); //remove spaeletterces
        $this->digilocker = ucfirst(strtolower($digilocker)); //Uppercase first 

        $email=strip_tags($e);
        $email = str_replace(' ', '', $email); //remove spaeletterces
        $this->email = ucfirst(strtolower($email)); //Uppercase first 
    
        $this->password1=strip_tags($p1);

        $this->password2=strip_tags($p2);

        $phone=strip_tags($ph);
        $phone = str_replace(' ', '', $phone); //remove spaeletterces
        $this->phone = ucfirst(strtolower($phone)); //Uppercase first 

        $wno=strip_tags($w);
        $wno = str_replace(' ', '', $wno); //remove spaeletterces
        $this->wno = ucfirst(strtolower($wno)); //Uppercase first

        $locality=strip_tags($l);
        $locality = str_replace(' ', '', $locality); //remove spaeletterces
        $this->locality = ucfirst(strtolower($locality)); //Uppercase first 

        $s = $se; 
        $this->service="";
        foreach($s as $h)
        {
            $this->service .=$h.", ";
        }

        $t1=strip_tags($i);
        $t1 = str_replace(' ', '', $t1); //remove spaeletterces
        $this->t1 = ucfirst(strtolower($t1)); //Uppercase first 

        $t2=strip_tags($j);
        $t2 = str_replace(' ', '', $t2); //remove spaeletterces
        $this->t2 = ucfirst(strtolower($t2)); //Uppercase first 

    }
    public function verifyname()
        {
        if(!preg_match("/^[a-zA-Z ]*$/",$this->fname))
        {
            return 0;
         }
        return 1;
        }
        public function verifyemail(){
            $conn = mysqli_connect("localhost", "root", "", "esahoyog");
            
            if(filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                    
                $this->email = filter_var($this->email, FILTER_VALIDATE_EMAIL);

            //Check if email already exists 
                $e=$this->email;
                $e_check = mysqli_query($conn, "SELECT email FROM volunteer WHERE email='$e'");

            //Count the number of rows returned
                $num_rows = mysqli_num_rows($e_check);
                if ($num_rows >0)
                {return 0;}
                else
                {return 1;}
            }
            else{
                return -1;
            }
        }

        public function verifypassword()
        {
            if($this->password1 != $this->password2) {
                return 0;
            }
            else {
                if(preg_match('/[^A-Za-z0-9]/', $this->password1)) {
                    return -1;
                }
                else{
                    return 1;
                }
            }
        }
        public function verifyphonenumber()
        {
            if (!preg_match("/^[0-9]*$/", $this->phone))
            {
                return 0;
            }
            else if (strlen($this->phone)!=10){
                return -1;
            }
            else{
                return 1;
            }
        }
        public function verifywpnumber()
        {
            if (!preg_match("/^[0-9]*$/", $this->wno))
            {
                return 0;
            }
            else if (strlen($this->wno)!=10){
                return -1;
            }
            else{
                return 1;
            }
        }

}



?>