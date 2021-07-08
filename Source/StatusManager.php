<?php
class StatusManager{
	public $vname;
	function changeStatusOn($vname){
		$conn = mysqli_connect("localhost", "root", "", "esahoyog");

		$query= "update volunteer set status_flag=1 where fname='$vname'";
		$result = mysqli_query($conn, $query);
		if($result){
			return 1;
		}else{
			return 0;
		}
	}
	function changeStatusOff($vname){
		$conn = mysqli_connect("localhost", "root", "", "esahoyog");
		$query= "update volunteer set status_flag=0 where fname='$vname'";
		$result = mysqli_query($conn, $query);
		if($result){
			return 1;
		}else{
			return 0;
		}
	}
	
	function deleteAccount($vname){
		$conn = mysqli_connect("localhost", "root", "", "esahoyog");
		
		$pwd="-99";
		$pwd=md5($pwd);
		$query= "update volunteer set password1='$pwd' where fname='$vname'";
		$result = mysqli_query($conn, $query);
		if($result){
			return 1;
		}else{
			return 0;
		}
	}
}
?>