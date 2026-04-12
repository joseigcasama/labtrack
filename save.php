<?php extract($_POST);
include 'class/config/config.php';
$insert = $conn->prepare('INSERT INTO  system_info(system_info,abbr) VALUES(?,?)');
$insert->execute(array($system_name,$abbr));
$insert = $conn->prepare('INSERT INTO  user(name,username,password,type,status,online_stats) VALUES(?,?,?,?,?,?)');
$insert->execute(array($fname,$user,md5($pass),1,1,0));
$insert_count = $insert->rowCount();
if($insert_count > 0){
	echo "<script>alert('System Successfully Configure');document.location.href = 'index'; </script>";
}else{
	echo "<script>alert('Failed to Configure');document.location.href = 'install'; </script>";
}?>