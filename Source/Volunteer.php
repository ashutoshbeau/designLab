<?php
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