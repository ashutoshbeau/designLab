<?php
include_once('connection.php');

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
       $url = "https://";   
else  
       $url = "http://";   
  // Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];   
    
  // Append the requested resource location to the URL   
$url.= $_SERVER['REQUEST_URI'];   

$url_components = parse_url($url);
  
// Use parse_str() function to parse the
// string passed via URL
parse_str($url_components['query'], $params);
      
  
//echo ($params['location']);
$query="select fname, locality, service, status_flag from volunteer where locality='".$params['location']."'";
//echo ($query);
$result=mysqli_query($conn, $query);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title>Search Volunteer</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="topnav">
            <img src="../img/logo.jpg" style="float: right;" width="50" height="50" alt="logo">
            <a href="needAssistance.html">Back</a>
            
          </div>
        <div class="container1">
            <h2>Search Volunteer</h2>
        </div>
        <table class="styled" align="center">
            <thead>
            <tr>
                <th>Volunteer</th>
                <th>Location</th>
                <th>Item</th>
                <th>Availability</th>
                <th>Action</th>
            </tr>
            </thead>
<?php
while($rows=mysqli_fetch_array($result)){
    ?>
    <tbody>
        <tr>
            <td><?php echo $rows['fname'] ?></td>
            <td><?php echo $rows['locality'] ?></td>
            <td><?php echo $rows['service'] ?></td>
            <td><?php echo $rows['status_flag'] ?></td>
            <td><button>HELP</button></td>
        </tr>
<?php
}
?>
</tbody>
</body>
</html>