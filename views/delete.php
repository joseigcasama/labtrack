<?php
require_once "../class/config/config.php";
global $conn;
$update = $conn->prepare('UPDATE borrow SET b_action = ? WHERE id = ?');
$update->execute(array(3,$_GET['borrowIds']));
header('Location:pending');
?>