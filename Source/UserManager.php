<?php
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
        $query="select fname, email, phone, wno, locality, gaddress, t1, t2  from user where fname in (select distinct Username from helpdb where Volname='$vname' and VStatus=1)";
        $result=mysqli_query($conn, $query);
        return $result;

    }
}

?>