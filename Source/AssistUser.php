<?php
session_start();
include("OrderManager.php");
$conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable

$vname=$_SESSION['vname'];
$request= new OrderManager();
$result=$request->fetchOrderDetails($vname);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Assist User</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
      <div class="topnav">
          <img src="img/logo.jpg" style="float: right;" width="50" height="50" alt="logo">
          <a href="volunteernext.html">Back</a>
          <a href="GiveHelp.php">Give Help</a>
      </div>
      <div class="container1">
        <h2><pre>
        Hey Volunteer!!!
          Welcome
  Here are the list of users who need your help
          </pre></h2>
      </div>
      <?php
        if(array_key_exists('Accept', $_POST)) {
            acceptRequest();
        }
        
        if(array_key_exists('Deny', $_POST)) {
            deleteRequest();
        }

        function acceptRequest() {
            $conn = mysqli_connect("localhost", "root", "", "esahoyog");
           // include("OrderManager.php");
            if(isset($_POST['Accept'])){
                if(isset($_POST['uname'])){
                    $uname = strip_tags($_POST['uname']);
                    $vname=$_SESSION['vname'];
                    $request= new OrderManager();

                    if($request->acceptOrder($uname, $vname)){
                      echo "Accepted!";
                    }
                    else 
                        echo "Already accepted.";
                }
                else
                    echo "Kindly choose one of the option before accepting.";
            }
        }

        function deleteRequest() {
          $conn = mysqli_connect("localhost", "root", "", "esahoyog");
         // include("OrderManager.php");
          if(isset($_POST['Deny'])){
              if(isset($_POST['uname'])){
                  $uname = strip_tags($_POST['uname']);
                  $vname=$_SESSION['vname'];
                  //echo $uname." and ".$vname;
                  $request= new OrderManager();
                  $result=$request->rejectOrder($uname, $vname);
                 // echo "Result:".$result;
                  if($result){
                    echo "Rejected!";
                  }
                  else 
                      echo "Already rejected.";
              }
              else
                  echo "Kindly choose one of the option before rejecting.";
          }
        }
      ?>
      <table class="styled" align="center">
            <thead>
            <tr>
                <th>User</th>
                <th>Item</th>
                <th>Additional Description</th>
                <th>Location</th>
            </tr>
            </thead>
            <form method="post">
            <?php
            while($rows=mysqli_fetch_array($result)){
            ?>
            <tbody>
            <tr>
            
            <?php echo "<td><input type='radio' name='uname' value='".$rows['Username']."'>".$rows['Username']."</td>";
            echo '<td>'.$rows['Item'].'</td>';
            echo '<td>'.$rows['AdditionalDescription'].'</td>'; 
            echo '<td>'.$rows['Location'].'</td>'; 
            ?>
            
        </tr>

<?php
}
?> 
</tbody>
<tr>
<td><input type="submit" name="Accept" value="Accept" /></td>
<td><input type="submit" name="Deny" value="Deny"/></td>
<tr>
</form>

</body>
</html>

       
        
            