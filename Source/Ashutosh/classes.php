<?php
class StatusManager{
	public $vname;
	function changeStatusOn(){
		$conn = mysqli_connect("localhost", "root", "", "esahoyog");
		if(isset($_POST['aon'])){ 
			$vname= $_SESSION['vname'];
			$query= "update volunteer set status_flag=1 where fname='$vname'";
			$result = mysqli_query($conn, $query);
		
			echo "Updated!!";
			return 1;
		}
		
	}
	function changeStatusOff(){
		$conn = mysqli_connect("localhost", "root", "", "esahoyog");
		if(isset($_POST['aoff'])){ 
			$vname= $_SESSION['vname'];
			$query= "update volunteer set status_flag=0 where fname='$vname'";
			$result = mysqli_query($conn, $query);
		
			echo "Updated!!";
			return 0;
		}
	}
}
?>