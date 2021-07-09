<?php
require(".\classes.php");



class SahoyogTest extends \PHPUnit\Framework\TestCase {
    //User
    /*
    public function testName(){
        $request = new User("Ram Chandra", "08-07-2021", "1234", "ramchandra@gmail.com", "ram", "ram", "1234567890", "1234567890", "Liluah", "Chakpara", "Dashrath", "1234567890", "0", "12");
        $result = $request->verifyname();

        $this->assertEquals(1, $result);
    }
    
    public function testEmail(){
        $request = new User("Ram Chandra", "08-07-2021", "1234", "ramchandra@gmail.com", "ram", "ram", "1234567890", "1234567890", "Liluah", "Chakpara", "Dashrath", "1234567890", "0", "12");
        $result = $request->verifyemail();

        $this->assertEquals(1, $result);
    }
    public function testPassword(){
        $request = new User("Ram Chandra", "08-07-2021", "1234", "ramchandra@gmail.com", "ram", "ram", "1234567890", "1234567890", "Liluah", "Chakpara", "Dashrath", "1234567890", "0", "12");
        //$verifyPassword = new Validator;
        $result = $request->verifypassword();
        $this->assertEquals(1, $result);

    }
    public function testPhoneno(){
        $request = new User("Ram Chandra", "08-07-2021", "1234", "ramchandra@gmail.com", "ram", "ram", "1234567890", "1234567890", "Liluah", "Chakpara", "Dashrath", "1234567890", "0", "12");
       // $verifyPhone = new Validator;
        $result = $request->verifyphonenumber();
        $this->assertEquals(1, $result);
    }
    //status manager
    public function testStatusOn(){
        $son= new StatusManager;
        $result = $son->changeStatusOn("Ram Chandra");
        $this->assertEquals(1, $result);
    }
    public function testStatusOff(){
        $soff= new StatusManager;
        $result = $soff->changeStatusOff("Ram Chandra");
        $this->assertEquals(1, $result);
    }
    public function testDeleteAccount(){
        $da= new StatusManager;
        $result = $da->deleteAccount("Ram Chandra");
        $this->assertEquals(1, $result);
    }
    //Order manager
    
    public function testInsertOrder(){
        $order= new Order();
        $order->item="Bed";
        $order->userName="Ram";
        $order->additionalDescription="With oxygen supply";
        $order->location="Bihar";
        $order->volunteerName="Ashutosh kumar singh";
        $order->userInfo=0;
        $order->volunteerStatus=-1;

        $om = new OrderManager();
        $result= $om->insertOrderDetails($order);
        $this->assertEquals(1, $result);
    }
    public function testOrderReject(){
        $om = new OrderManager();
        $result1= $om->getRejectionDetails("Ram");
        $result2= mysqli_num_rows($result1);
        
        $this->assertEquals(1, $result2);
    }
    public function testGetHelpline(){
        $om = new OrderManager();
        $result1= $om->getHelplineInfo("Beautysingh");
        $result2= mysqli_num_rows($result1);
        $this->assertEquals(1, $result2);
    }
    public function testOrderFulfilled(){
        $om = new OrderManager();
        $result= $om->orderFulfilled("Ram", "Ashutosh kumar singh");
        
        $this->assertEquals(1, $result);
    }
    public function testRejectOrder(){
        $om = new OrderManager();
        $result= $om->rejectOrder("Ram", "Ashutosh kumar singh");
        
        $this->assertEquals(1, $result);
    }
    public function testAcceptOrder(){
        $om = new OrderManager();
        $result= $om->acceptOrder("Ram", "Ashutosh kumar singh");
        
        $this->assertEquals(1, $result);
    }
    
    
    //volunteer manager
    function testShowVolDetails(){
        $om = new VolunteerManager();
        $result1= $om->showVolunteersDetails("Liluah");
        $result2= mysqli_num_rows($result1);
        $this->assertEquals(1, $result2);
    }
    function testGetVolConDetails(){
        $om = new VolunteerManager();
        $result1= $om->getVolContactDetails("Ram");
        $result2= mysqli_num_rows($result1);
        $this->assertEquals(1, $result2);
    }
    */
    //volunteer login manager
    function testVolLogin(){
        $vol= new VolunteerLoginManager("ashubeau51@gmail.com", "abcd");
        $result=$vol->verify();
        $this->assertEquals(1, $result);
    }
}