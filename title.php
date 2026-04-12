<?php
include 'class/config/config.php';
$sql = $conn->prepare("SELECT * FROM system_info ");
$sql->execute();
$fetch = $sql->fetchAll();
foreach ($fetch as $key => $value){
   echo $value['abbr']; 
}

?>