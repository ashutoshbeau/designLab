<?php
session_start();
require("StatusManager.php");

$obj = new StatusManager();
$vname= $_SESSION['vname'];
if(array_key_exists('aon', $_POST)) {
	$obj->changeStatusOn($vname);
	echo "Updated!!";
}
if(array_key_exists('aoff', $_POST)) {
	$obj->changeStatusOff($vname);
	echo "Updated!!";
}
if(array_key_exists('deleteA', $_POST)) {
	$obj->deleteAccount($vname);
	header("Location: homepage.html");
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