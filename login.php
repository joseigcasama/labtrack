<?php
		session_start();	
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		global $conn;

		$sql = $conn->prepare('SELECT * FROM user WHERE BINARY username = ? AND BINARY password = ? AND status = ?');
		$sql->execute(array($username,$password,1));
		$fetch = $sql->fetch();
		$count = $sql->rowCount();
		if($count > 0){

			session_start();
			$_SESSION['admin_id'] = $fetch['id'];
			$_SESSION['admin_name'] = $fetch['name'];
			$_SESSION['admin_username'] = $fetch['username'];
			$_SESSION['admin_type'] = $fetch['type'];
			echo "1";
		}else{
			echo "0";
		}
				
		?>