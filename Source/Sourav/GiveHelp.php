<?php
session_start();
include_once('connection.php');
$vname=$_SESSION['vname'];
$query="select fname, email, phone, wno, locality, gaddress from user where fname in (select distinct Username from helpdb where Volname='$vname' and VStatus=1)";
$result=mysqli_query($conn, $query);

?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title>Give Help</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="topnav">
            <img src="../img/logo.jpg" style="float: right;" width="50" height="50" alt="logo">
            <a href="AssistUser.php">Back</a>
        </div>
        <div class="container1">
            
            <table class="styled" align="center">
            <thead>
            <tr><th>Needy User</th></tr>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Phone No.</th>
                <th>Whatsapp No.</th>
                <th>Locality</th>
                <th>Address</th>
            </tr>
            </thead>
        <?php
            while($rows=mysqli_fetch_array($result)){
        ?>
        <tbody>
        <tr>
            <td><?php echo $rows['fname'] ?></td>
            <td><?php echo $rows['email'] ?></td>
            <td><?php echo $rows['phone'] ?></td>
            <td><?php echo $rows['wno'] ?></td>
            <td><?php echo $rows['locality'] ?></td>
            <td><?php echo $rows['gaddress'] ?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
        </div>
       
    </body>
</html>