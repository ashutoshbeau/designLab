<?php
session_start();
include_once('connection.php');
$uname=$_SESSION['uname'];
$query="select fname, email, phone, wno, locality, service, t1, t2 from volunteer where fname in (select distinct Volname from helpdb where Username='$uname' and VStatus=1 and Volname is not null)";
//echo ($query);
$result=mysqli_query($conn, $query);
//rejected request
$query2="select Volname, Item, AdditionalDescription, Location from helpdb where Username='$uname' and VStatus=-1 and Volname is not null";
$result2=mysqli_query($conn, $query2);
//info
$query3="select Location, Item, AdditionalDetails, Helpline from info where Location in (select distinct Location from helpdb where Username='$uname' and UInfo=1)";
$result3=mysqli_query($conn, $query3);
if (!$result3 || !$result2 || !$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

if(array_key_exists('satisfied', $_POST)) {
    satisfied();
}
function satisfied(){
    $conn = mysqli_connect("localhost", "root", "", "esahoyog");
    if(isset($_POST['satisfied'])){
        $uname= $_SESSION["uname"];
        
        if(isset($_POST['fname'])){
            $vname = strip_tags($_POST['fname']);
            $query2= "update helpdb set VStatus=0 where Username='$uname' and Volname='$vname'";
            $result2 = mysqli_query($conn, $query2);
            if($result2)
                echo "Done!!";
            else 
                echo "Already Done, reload the page to see the change.";
        }
        else
            echo "Kindly choose one of the option.";
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title>Help Acquired</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="topnav">
            <img src="../img/logo.jpg" style="float: right;" width="50" height="50" alt="logo">
            <a href="needAssistance.php">Back</a>
        </div>
        <div class="container1">    
            <table style="float:left;" class="styled" align="center">
            <thead>
            <tr><th>Request Accepted</th></tr>
            <tr>
                <th>Volunteer</th>
                <th>Email</th>
                <th>Phone No.</th>
                <th>Whatsapp No.</th>
                <th>Locality</th>
                <th>Service</th>
                <th>Active Time</th>
            </tr>
            </thead>
            <form method="post">
            <?php
        while($rows=mysqli_fetch_array($result)){
       ?>
        <tbody>
        <tr>
        <td><?php echo '<input type="radio" name="fname" value="'.$rows['fname'].'">'.$rows['fname'] ?></td>
            <td><?php echo $rows['email'] ?></td>
            <td><?php echo $rows['phone']?></td>
            <td><?php echo $rows['wno']?></td>
            <td><?php echo $rows['locality']?></td>
            <td><?php echo $rows['service']?></td>
            <td><?php echo $rows['t1'].'-'.$rows['t2']?></td>
        </tr>
        </tbody>
        <?php
        }
        $result=mysqli_query($conn, $query);
        if($rows=mysqli_fetch_array($result)){?>
        <tr>
            <td><input type="submit" name="satisfied" value="Satisfied" /></td>
        </tr>
  <?php } ?>
        </form>
        </table>
        </div>
        <br><br>
        <div class="container1">
            <table class="styled" align="center">
            <thead>
            <tr><th>Request Rejected</th></tr>
            <tr>
                <th>Volunteer</th>
                <th>Item</th>
                <th>Additional Description</th>
                <th>Location</th>
            </tr>
            </thead>
        <?php
            while($rows=mysqli_fetch_array($result2)){
        ?>
        <tbody>
        <tr>
            <td><?php echo $rows['Volname'] ?></td>
            <td><?php echo $rows['Item'] ?></td>
            <td><?php echo $rows['AdditionalDescription'] ?></td>
            <td><?php echo $rows['Location'] ?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
        </table>
        </div>
        <br><br>
        <div class="container1">
            <table class="styled" align="center">
            <thead>
            <tr><th>Emergency Helpline</th></tr>
            <tr>
                <th>Location</th>
                <th>Item</th>
                <th>Additional Details</th>
                <th>Helpline</th>
            </tr>
            </thead>
        <?php
            while($rows=mysqli_fetch_array($result3)){
        ?>
        <tbody>
        <tr>
            <td><?php echo $rows['Location'] ?></td>
            <td><?php echo $rows['Item'] ?></td>
            <td><?php echo $rows['AdditionalDetails'] ?></td>
            <td><?php echo $rows['Helpline'] ?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
        </div>
    </body>
</html>