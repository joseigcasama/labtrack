<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Print</title>
</head>
<body>
	<div style="width: 13in;height: 8in;size: landscape;display: flex;flex-wrap: wrap;">
		
	<?php
	require_once('../libs/phpqrcode/qrlib.php');
	include '../class/config/config.php';
				global $conn;

				$sql = $conn->prepare('SELECT *, item_stock.id as e_id, item.id as i_id FROM item_stock
										LEFT JOIN item ON item.id = item_stock.item_id
										LEFT JOIN category ON category.id = item.i_category
										WHERE item_stock.item_status = ? OR item_stock.item_status = ?');
				$sql->execute(array(1,2));
				$row = $sql->rowCount();
				$fetch = $sql->fetchAll();

					foreach ($fetch as $key => $value) {
						$code = $value['i_id'].'|'.$value['i_deviceID'].'|'.$value['e_id'].'|'.$value['i_roomID'].'|'.md5(date('Y-m-d')).'|'.$value['i_brand'].'|'.$value['i_model'];
						$tempDir = '../temp/';
						QRcode::png($code, $tempDir.''.$value['i_deviceID'].'.png', QR_ECLEVEL_L, 5);
						$qr = '../temp/'.$value['i_deviceID'].'.png';
						$data = $value['description'].'<br>'.'<img src="'.$qr.'" style="width: 120px;" ><br>'.$value['i_brand'].' '.$value['i_model'];?>
				<div style="margin-left: 3px;border: 1px solid black;max-height: 2in;padding: 2px;">
					<p align="center"><?php echo $data;?></p>
				</div>
	<?php } ?>
	</div>
</body>
</html>