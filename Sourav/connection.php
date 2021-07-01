<?php
$conn=mysqli_connect('localhost', 'root', '', 'esahoyog');
if(mysqli_connect_errno($conn)){
    echo 'Failed to connect to database: '.mysqli_connect_error();
}
//else
//    echo 'Connected Successfully!!';
?>