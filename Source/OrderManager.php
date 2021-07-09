<?php


class OrderManager{
   
    public function insertOrderDetails(Order $order){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $query= "insert into helpdb(Item, Username, Volname, UInfo, VStatus, AdditionalDescription, Location) VALUES('$order->item', '$order->userName', '$order->volunteerName', '$order->userInfo', '$order->volunteerStatus', '$order->additionalDescription', '$order->location')";
        $result = mysqli_query($conn, $query);
        return $result;    
    }
    public function getRejectionDetails($uname){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $query="select Volname, Item, AdditionalDescription, Location from helpdb where Username='$uname' and VStatus=-1 and Volname <> '-1'";
        $result=mysqli_query($conn, $query);
        return $result;
    }
    public function getHelplineInfo($uname){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $query="select Location, Item, AdditionalDetails, Helpline from info where Location in (select distinct Location from helpdb where Username='$uname' and UInfo=1)";
        $result=mysqli_query($conn, $query);
        return $result;
    }
    public function orderFulfilled($uname, $vname){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $query= "update helpdb set VStatus=0 where Username='$uname' and Volname='$vname'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    public function fetchOrderDetails($vname){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $query="select Username, Item, AdditionalDescription, Location from helpdb where Volname='$vname' and VStatus=-99";
        $result=mysqli_query($conn, $query);
        return $result;
    }
    public function acceptOrder($uname, $vname){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $row = mysqli_fetch_array(mysqli_query($conn, "select VStatus from helpdb where Username='$uname' and Volname='$vname'"));

        if($row['VStatus']!=1){
          $query2= "UPDATE helpdb SET VStatus=1 WHERE Username='$uname' and Volname='$vname'";
          $result2 = mysqli_query($conn, $query2);
          return $result2;
        }
        else
          return !$result2;
    }
    public function rejectOrder($uname, $vname){
        $conn = mysqli_connect("localhost", "root", "", "esahoyog"); //Connection variable
        $row = mysqli_fetch_array(mysqli_query($conn, "select VStatus from helpdb where Username='$uname' and Volname='$vname'"));
        if($row['VStatus']==-99){
            $query2= "UPDATE helpdb SET VStatus=-1 WHERE Username='$uname' and Volname='$vname'";
            $result2 = mysqli_query($conn, $query2);
            return $result2;
        }
        else if($row['VStatus']==-1)
            return 0;      
    }
}

?>