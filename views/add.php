<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=lab_mgt", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully"; 
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$user_id = $_POST['user_id'];
$item = $_POST['item'];
$reserve_room = $_POST['reserve_room'];
$time_return = $_POST['time_return'];

$code = date('mdYHis') . '' . $user_id;
$stmt = $conn->prepare("SELECT borrowcode FROM borrow WHERE borrowcode = ?");
$stmt->execute(array($code));
$row_count = $stmt->rowCount();

if ($row_count > 0) {
  $output = 'Asset Tag is already exist!';
} else {
  $sql = $conn->prepare("INSERT INTO borrow (borrowcode,member_id,item_id,user_id,room_assigned,time_limit) VALUES ()");
  $sql->execute(array($code, $user_id, $item, $user_id, $reserve_room, $time_return));

  $output = 'Item added successfully!';
}

echo $output;
