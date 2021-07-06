<?php
session_start();

class StatusManager{
	public $vname;
	function changeStatusOn(){
		$conn = mysqli_connect("localhost", "root", "", "esahoyog");
		if(isset($_POST['aon'])){ 
			$vname= $_SESSION['vname'];
			$query= "update volunteer set status_flag=1 where fname='$vname'";
			$result = mysqli_query($conn, $query);
		
			echo "Updated!!";
			//return 1;
		}
		
	}
	function changeStatusOff(){
		$conn = mysqli_connect("localhost", "root", "", "esahoyog");
		if(isset($_POST['aoff'])){ 
			$vname= $_SESSION['vname'];
			$query= "update volunteer set status_flag=0 where fname='$vname'";
			$result = mysqli_query($conn, $query);
		
			echo "Updated!!";
			//return 0;
		}
	}
	
	function deleteAccount(){
		$conn = mysqli_connect("localhost", "root", "", "esahoyog");
		if(isset($_POST['deleteA'])){ 
			$vname= $_SESSION['vname'];
			$pwd="-99";
			$pwd=md5($pwd);
			$query= "update volunteer set password1='$pwd' where fname='$vname'";
			$result = mysqli_query($conn, $query);
		
			echo "Updated!!";
			header("Location: ../homepage.html");
        	exit();
		}
	}
}
$obj = new StatusManager();
if(array_key_exists('aon', $_POST)) {
	$obj->changeStatusOn();
}
if(array_key_exists('aoff', $_POST)) {
	$obj->changeStatusOff();
}
if(array_key_exists('deleteA', $_POST)) {
	$obj->deleteAccount();
}

?>

<!DOCTYPE html>
	<html>
		
		<head>
    		<!-- Required meta tags -->
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        	<title> Volunteer</title>
        	<link rel="stylesheet" href="css/style.css">
    	</head>
	<body>

		<div class="topnav">
       		<a href="volunteernext.html">Back</a>
            <img src="img/logo.jpg" style="float: right ;" width="56" height="50" alt="logo">
        </div>
        
            <div class="container2">
				<form method="POST" action="updateStatus.php">
                <input style="float:left;margin-left:100px;" class="main" type="submit" name="aon" value="Availability On">
				<input style="float:left;margin-left:100px;" type="submit" name="aoff" value="Availability Off">
				<input style="float: left;margin-left:100px;" type="submit" name="deleteA" value="Delete Account">
				</form>
				<br>
				<br>
				<br>
            </div>
           
            <img src="img/helpingHand.jpg"  width="100%" height="100%" alt="motivation">
      

	</body>
</html>