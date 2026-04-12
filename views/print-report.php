<?php
	require_once 'session.php';
	require_once "../class/config/config.php";
	global $conn;
	if ($_POST['selectStatus'] == 0) {
		$stats ="";
		if ($_POST['selectMonth'] == 0) {
			# code...
			$getBorrowedLists = $conn->prepare("SELECT *, item.id as i_id FROM item LEFT JOIN item_stock ON item_stock.id = item.id  WHERE YEAR(item.i_date_purchase) = ".$_POST['selectYear']." $stats AND item.i_roomID = ".$_SESSION['room_id']." "); 
		} else {
			# code...
			$getBorrowedLists = $conn->prepare("SELECT *, item.id as i_id FROM item LEFT JOIN item_stock ON item_stock.id = item.id  WHERE YEAR(item.i_date_purchase) = ".$_POST['selectYear']." $stats AND MONTH(item.i_date_purchase) = ".$_POST['selectMonth']." AND item.i_roomID = ".$_SESSION['room_id']." "); 
		}
		
	}elseif ($_POST['selectStatus'] == 4 || $_POST['selectStatus'] == 3){
		$stats =" AND borrow.status = ".$_POST['selectStatus'];
		if ($_POST['selectMonth'] == 0) {
			$getBorrowedLists = $conn->prepare("SELECT *,count(borrow.id) as l_stock, item.id as i_id FROM borrow LEFT JOIN item ON borrow.item_id=item.id LEFT JOIN item_stock ON item_stock.id = item.id  WHERE YEAR(item.i_date_purchase) = ".$_POST['selectYear']." $stats AND item.i_roomID = ".$_SESSION['room_id']." "); 
		}else {
			$getBorrowedLists = $conn->prepare("SELECT *,count(borrow.id) as l_stock, item.id as i_id FROM borrow LEFT JOIN item ON borrow.item_id=item.id LEFT JOIN item_stock ON item_stock.id = item.id  WHERE YEAR(item.i_date_purchase) = ".$_POST['selectYear']." $stats AND MONTH(item.i_date_purchase) = ".$_POST['selectMonth']." AND item.i_roomID = ".$_SESSION['room_id']." "); 
		}
	}else {
		$stats =" AND item.i_status = ".$_POST['selectStatus'];
		if ($_POST['selectMonth'] == 0) {
		$getBorrowedLists = $conn->prepare("SELECT *, item.id as i_id FROM item LEFT JOIN item_stock ON item_stock.id = item.id  WHERE YEAR(item.i_date_purchase) = ".$_POST['selectYear']." $stats AND item.i_roomID = ".$_SESSION['room_id']." "); 
		}else{
			$getBorrowedLists = $conn->prepare("SELECT *, item.id as i_id FROM item LEFT JOIN item_stock ON item_stock.id = item.id  WHERE YEAR(item.i_date_purchase) = ".$_POST['selectYear']." $stats AND MONTH(item.i_date_purchase) = ".$_POST['selectMonth']." AND item.i_roomID = ".$_SESSION['room_id']." "); 
		}
	}
	
	$getBorrowedLists->execute();
	$data = $getBorrowedLists->fetchAll();
	if ($_POST['selectStatus'] == 1) {
		$status = "NEW";
	}elseif ($_POST['selectStatus'] == 2) {
		$status = "OLD";
	}elseif ($_POST['selectStatus'] == 3) {
		$status = "LOST";
	}elseif ($_POST['selectStatus'] == 4) {
		$status = "DAMAGE";
	}else{
		$status = "ALL";
	}
	$monthArr =array("","January","February","March","April","May","June","July","August","September","October","November"," December");
?>
<html>
<title>Report</title>
<link href="../images/don jose.png" rel="icon" type="image">
<style type="text/css">
	table, th, td{
		border: 1px solid black;
		border-collapse: collapse;
		padding: 10px;
	}
</style>
<body>
	<div style="width: 8.25in;">
		<center>
			<img src="logo.png" class="img-responsive" style="width: 80px;height: 80px;" />
			<p style="margin:0;padding:0;">Republic of the Philippines</p>
			<p style="margin:0;padding:0;font-weight:bold;">DON JOSE ECLEO MEMORIAL COLLEGE</p>
			<p style="margin:0;padding:0;">San Jose, Dinagat Islands</p>
			<h3 style="text-align:center; font-weight:bold;font-size:16px; font-family:'Bookman Old Style'; text-transform: uppercase;">
				INVENTRY LIST OF <?=$status;?> ITEM</h3>
		</center>
		<p>Date: <?=$monthArr[$_POST['selectMonth']];?> <?=$_POST['selectYear']?></p>
	</div>
	<table style="width:8.25in;border: 0.1px solid black;">
		<thead>
			<tr>
				<th>Date (M/d/Y)</th>
				<th>Item Description</th>
				<th>Quantity<br>Available</th>
				<th>Item Status</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($data as $item):
			if ($_POST['selectStatus'] == 4 || $_POST['selectStatus'] == 3){
				if ($_POST['selectStatus'] == 3) {
					$i_status = "LOST";
					$stock = "Stock=".$item['items_stock']. "& ".$item['l_stock'].' '.$i_status;
				}elseif ($_POST['selectStatus'] == 4) {
					$i_status = "DAMAGE";
					$stock = "Stock=".$item['items_stock']. "& ".$item['l_stock'].' '.$i_status;
				}
			}elseif ($_POST['selectStatus'] == 0) {
					$sql1 = $conn->prepare('SELECT count(*) as newcount,borrow.status as stats FROM borrow WHERE borrow.item_id = ? AND borrow.status = ?');
					$sql1->execute(array($item['i_id'],3));
					$row = $sql1->fetchAll();
					foreach($row as $rows){
							$lostcount = $rows['newcount'].' Lost';
							$lostcount1 = $rows['newcount'];
					}
					$sql2 = $conn->prepare('SELECT count(*) as newcount,borrow.status as stats FROM borrow WHERE borrow.item_id = ? AND borrow.status = ?');
					$sql2->execute(array($item['i_id'],4));
					$row1 = $sql2->fetchAll();
					foreach($row1 as $rows1){
							$damcount = $rows1['newcount'].' Damage';
							$damcount1 = $rows1['newcount'];
					}
					$sql3 = $conn->prepare('SELECT count(*) as newcount,borrow.status as stats FROM borrow WHERE borrow.item_id = ? AND borrow.status = ? AND borrow.b_action < 3 AND borrow.e_remarks="" ');
					$sql3->execute(array($item['i_id'],1));
					$row3 = $sql3->fetchAll();
					foreach($row3 as $rows3){
							$uncount = $rows3['newcount'].' Un-return';
							$uncount1 = $rows3['newcount'];
					}
					$all = $item['item_rawstock'];
					$i_status = $damcount."<br>".$lostcount."<br>".$uncount;
					$stock = "Purchase Quantity=".$all."<br>Available Stock=".$item['items_stock'];
			}elseif ($_POST['selectStatus'] == 2) {
					$i_status = "OLD";
					$stock = "Stock=".$item['items_stock']. "& ".$item['l_stock'].' '.$i_status;
			}else {
				$i_status = "NEW";
				$stock = "Stock=".$item['items_stock'];
		}
		 ?>
			<tr>
				<td><?=date('M. d, Y', strtotime($item['i_date_purchase']))?></td>
				<td><?=$item['i_description'];?> <?=$item['i_brand'];?> <?=$item['i_model'];?> (<?=$item['i_serial'];?>)</td>
				<td><?=$stock;?></td>
				<td><?=$i_status;?></td>
			</tr>
		<?php endforeach; ?>			
		</tbody>
	</table>	
</body>
	<br/><br/>
		<?php 
		echo "<p> ____________________</p>"; 
		echo "<p> Incharge's Signature </p>"; 
		?>
</html>