<?php
session_start();
include("VolunteerManager.php");

$conn = mysqli_connect("localhost", "root", "", "esahoyog");

$location=$_SESSION["location"];
$obj= new VolunteerManager();
$result=$obj->showVolunteersDetails($location);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title>Search Volunteer</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="topnav">
            <img src="img/logo.jpg" style="float: right;" width="50" height="50" alt="logo">
            <a href="needAssistance.php">Back</a>
            
          </div>
        <div class="container1">
            <h2>Search Volunteer</h2>
        </div>

        <?php
        if(array_key_exists('help', $_POST)) {
            help();
        }
        
        if(array_key_exists('info', $_POST)) {
            info();
        }

        function help() {
            $conn = mysqli_connect("localhost", "root", "", "esahoyog");
            include('Order.php');
            include('OrderManager.php');
            if(isset($_POST['help'])){
                $item= $_SESSION["item"];
                $uname= $_SESSION["uname"];
                $ades= $_SESSION["addDes"];
                $loc= $_SESSION["location"];
                $vname= "-1";
                $uinfo=0;
                $vstatus=-99;
                if(isset($_POST['fname'])){
                    $vname = strip_tags($_POST['fname']);
                    $order= new Order();
                    $order->item=$item;
                    $order->userName=$uname;
                    $order->additionalDescription=$ades;
                    $order->location=$loc;
                    $order->volunteerName=$vname;
                    $order->userInfo=$uinfo;
                    $order->volunteerStatus=$vstatus;
                    $orderManager= new OrderManager();

                    $result2=$orderManager->insertOrderDetails($order);
                
                    
                    if($result2)
                        echo "Request Sent";
                    else 
                        echo "Already Sent, have patience;)";
                }
                else
                    echo "Kindly choose one of the option before opting for help.";
            }
        }

        function info() {
            $conn = mysqli_connect("localhost", "root", "", "esahoyog");
            include("Order.php");
            include("OrderManager.php");
            if(isset($_POST['info'])){ 
                $item= $_SESSION["item"];
                $uname= $_SESSION["uname"];
                $ades= $_SESSION["addDes"];
                $loc= $_SESSION["location"];
                $vname= "-1";
                $uinfo= 1;
                $vstatus= 0;

                $order= new Order();
                $order->item=$item;
                $order->userName=$uname;
                $order->additionalDescription=$ades;
                $order->location=$loc;
                $order->volunteerName=$vname;
                $order->userInfo=$uinfo;
                $order->volunteerStatus=$vstatus;
                $orderManager= new OrderManager();

                $result3=$orderManager->insertOrderDetails($order);
            
                
                if($result3)
                    echo "Info Fetched. Kindly check Help Acquired tab.";
                else 
                    echo "Info Already Fetched.";
            }
           
        }
    ?>
        <table class="styled" align="center">
            <thead>
            <tr>
                <th>Volunteer</th>
                <th>Location</th>
                <th>Item</th>
                <th>Availability</th>
                <!--<th>Action</th>-->
            </tr>
            </thead>
            <form method="post">
<?php
while($rows=mysqli_fetch_array($result)){
    ?>
    <tbody>
        <tr>
            
            <td><?php echo '<input type="radio" name="fname" value="'.$rows['fname'].'">'.$rows['fname'] ?></td>
            <td><?php echo $rows['locality'] ?></td>
            <td><?php echo $rows['service'] ?></td>
            <td><?php echo $rows['status_flag'] ?></td>
            
            
        </tr>
    </tbody>
<?php
}
?> 

<tr>
<?php
 $result=$obj->showVolunteersDetails($location);
 if($rows=mysqli_fetch_array($result)) {?>
<td><input type="submit" name="help" value="Help" /></td>
<?php } ?>
<td><input type="submit" name="info" value="Emergency Helpline"/></td>
<tr>
</form>

</body>
</html>