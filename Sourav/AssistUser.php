<?php
include_once('connection.php');
$query="select fname, locality, email, phone from user";
$result=mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Assist User</title>
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
      <div class="topnav">
          <img src="../img/logo.jpg" style="float: right;" width="50" height="50" alt="logo">
          <a href="../volunteernext.html">Back</a>
      </div>
      <div class="container1">
        <h2><pre>
        Hey Volunteer!!!
          Welcome
  Here are the list of users who need your help
          </pre></h2>
      </div>
  
      <table class="styled" align="center">
            <thead>
            <tr>
                <th>User</th>
                <th>Location</th>
                <th>Email</th>
                <th>Contact</th>
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
            <td><?php echo $rows['email'] ?></td>
            <td><?php echo $rows['phone'] ?></td>
            <td><button>ACCEPT</button><br>
              <button>DENY</button></td>
        </tr>
<?php
}
?>
</tbody>
</body>
</html>

