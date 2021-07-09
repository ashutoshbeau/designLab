<?php

class Operator{
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
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $e=$this->email;
        $p=$this->password;
        $check_database_query = mysqli_query($conn, "SELECT * FROM operator WHERE email='$e' AND password1='$p'");
        
            $check_login_query = mysqli_num_rows($check_database_query);

            if($check_login_query == 1) {
                return 1;
	        }
            else
            {
                return 0;
            }
        
    }
    public function fetchResignedVolunteers(){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $pass="-99";
        $pass=md5($pass);
        $query="select fname, email, phone, wno, locality, service, t1, t2 from volunteer where password1='$pass'";
        $result=mysqli_query($conn, $query);
        return $result;
    }
    public function deleteVolunteer($vname){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $query= "DELETE FROM volunteer WHERE fname='$vname'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    
}

?>