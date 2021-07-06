<?php
session_start();
class ItemManager{
    public $location;
    public $item;
    public $addDes;

    public function manageItems(){

        if(isset($_POST['submit'])){
            $location = strip_tags($_POST['location']); //Remove html tags
            $item = strip_tags($_POST['item']); //Remove html tags
            $addDes = strip_tags($_POST['AddDes']); //Remove html tags

            $_SESSION["location"]=$location;
            $_SESSION["item"]=$item;
            $_SESSION["addDes"]=$addDes;
        
            header("Location: searchVolunteer.php");
            exit();
        }
    }
}
$obj = new ItemManager();
$obj->manageItems();
?>





<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title>Need Assistance</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="topnav">
            <img src="../img/logo.jpg" style="float: right;" width="50" height="50" alt="logo">
            <a href="../usernext.html">Back</a>
            <a href="HelpAcquired.php">Help Acquired</a>
        </div>
        <div class="container1">
            <h2>New Help</h2>
        </div>
        
        <div class="container2">
            <form method="POST" action="needAssistance.php">
            <label for="localion"><h3>Choose your location:</h3></label>
            <select name="location" id="location">
                <option value="Liluah">Liluah</option>
                <option value="Gaya">Gaya</option>
                <option value="Bihar">Bihar</option>
                <option value="Ahmedabad">Ahmedabad</option>
            </select>
            <br><br>
            <label><h3>Choose Your Help Item:</h3></label><br>
            <input type="radio" id="item1" name="item" value="Bed" required >
            <label for="item1">Bed</label><br>
            <input type="radio" id="item2" name="item" value="Medicine">
            <label for="item2">Medicine</label><br>
            <input type="radio" id="item3" name="item" value="Oxygen">
            <label for="item3">Oxygen</label><br>
            <input type="radio" id="item4" name="item" value="Other">
            <label for="item3">Other</label><br>
            
            <br><br>
            <label>Additional Description:</label>
            <input type="text" id="AddDes" name="AddDes" />
            <br><br>
            <input style="float: left;" type="submit" class="btn" name="submit" value="Search Volunteer">
           <!-- <a class="btn" href="searchVolunteer.php" target="_blank">Search Volunteer</a>-->
        </form>
        </div>
 
        </body>
</html>