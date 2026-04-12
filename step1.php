<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Creating Database</title>
</head>
<body>
<?php date_default_timezone_set('Asia/Manila');
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=lab_mgt", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    header('Location:index');
    }
catch(PDOException $e)
    {?>
      <center>
        
        <img src="images/1_1A6_7adoPZL9CJPurJm76w.gif">
      </center>
<?php
// install code
 require_once 'create.php';     
    }
?>
</body>
</html>