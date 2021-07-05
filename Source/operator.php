<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "esahoyog");
$uname=$_SESSION['uname'];
$pass="-99";
$pass=md5($pass);
$query="select fname, email, phone, wno, locality, service, t1, t2 from volunteer where password1='$pass'";
//echo ($query);
$result=mysqli_query($conn, $query);

if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

if(array_key_exists('delete', $_POST)) {
    delete();
}
function delete(){
    $conn = mysqli_connect("localhost", "root", "", "esahoyog");
    if(isset($_POST['delete'])){
        
        if(isset($_POST['delete'])){
            $vname = strip_tags($_POST['fname']);
            $query= "DELETE FROM volunteer WHERE fname='$vname'";
            $result = mysqli_query($conn, $query);
            if($result)
                echo "Deleted!!";
            else 
                echo "Already Deleted, reload the page to see the change.";
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
    
        <title>Operator</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="topnav">
            <img src="img/logo.jpg" style="float: right;" width="50" height="50" alt="logo">
            <a href="loginoperator.php">Back</a>
        </div>
        <div class="container1">    
            <table style="float:left;" class="styled" align="center">
            <thead>
            <tr><th>Volunteer Gone...</th></tr>
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
            <td><input type="submit" name="delete" value="delete" /></td>
        </tr>
  <?php } ?>
        </form>
        </table>
        </div>
        <br><br>
    </body>
</html>