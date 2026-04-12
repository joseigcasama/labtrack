<?php
	require_once "../config/config.php";

	/**
	* 
	*/
	class login
	{
		public function admin_login($usertype,$username,$password)
		{
			global $conn;

			if($usertype =='admin'){
				$sql = $conn->prepare('SELECT * FROM user WHERE BINARY username = ? AND BINARY password = ? AND status = ?');
				 // 
				$sql->execute(array($username,$password,1));
				$fetch = $sql->fetch();
				$count = $sql->rowCount();			

				if($count > 0){
					if ($fetch['type']==1) {
						session_start();
						$_SESSION['admin_id'] = $fetch['id'];
						$_SESSION['room_id'] = "";
						$_SESSION['admin_name'] = $fetch['name'];
						$_SESSION['admin_username'] = $fetch['username'];
						$_SESSION['admin_type'] = $fetch['type'];
						$sql = $conn->prepare('UPDATE user SET online_stats = ? WHERE id = ?');
						$sql->execute(array(1,$fetch['id']));
						echo "1";
					} else if ($fetch['type']==2){
						session_start();
						$sqls = $conn->prepare('SELECT * FROM room WHERE incharge = ? ');
						$sqls->execute(array($fetch['id']));
						$row = $sqls->fetch();
						$counts = $sqls->rowCount();	
						if ($counts >0) {
							$_SESSION['admin_id'] = $fetch['id'];
							$_SESSION['room_id'] = $row['id'];
							$_SESSION['admin_name'] = $fetch['name'];
							$_SESSION['admin_username'] = $fetch['username'];
							$_SESSION['admin_type'] = $fetch['type'];
							$sql = $conn->prepare('UPDATE user SET online_stats = ? WHERE id = ?');
							$sql->execute(array(1,$fetch['id']));
							echo "1";
						} else {
							echo "4";
						}
					}

				}else{
					echo "0";
				}
			}
			elseif($usertype =='student'){
				$sql = $conn->prepare('SELECT * FROM member WHERE m_school_id = ? AND m_password = ? AND m_status = ?');
				// AND online_stats = ?
				$sql->execute(array($username,$password,1));
				$fetch = $sql->fetch();
				$count = $sql->rowCount();
				if($count > 0){

					session_start();
					$_SESSION['admin_id'] = $fetch['id'];
					$_SESSION['admin_name'] = $fetch['m_fname']." ".$fetch['m_lname'];
					$_SESSION['admin_username'] = $fetch['m_school_id'];
					$_SESSION['admin_type'] = $fetch['m_type'];
					$sql = $conn->prepare('UPDATE member SET online_stats = ? WHERE id = ?');
					$sql->execute(array(1,$fetch['id']));
					echo "3";
				}else{
					echo "0";
				}
			}
		}

		public function member_login($id){
			global $conn;

			$sql = $conn->prepare('SELECT * FROM member WHERE m_school_id = ? AND m_status = ?');
			$sql->execute(array($id,1));
			$count = $sql->rowCount();
			$fetch = $sql->fetch();

			if($count > 0){

				session_start();
				$_SESSION['member_id'] = $fetch['id'];
				$_SESSION['member_name'] = $fetch['m_fname']." ".$fetch['m_lname'];
				$_SESSION['member_type'] = $fetch['m_type'];
				echo "1";
			}else{
				echo "0";
			}

		}

	}

	$login =  new login();

	$key = trim($_POST['key']);

	switch ($key) {

		case 'admin_login';
		$usertype = trim($_POST['usertype']);
		$username = trim($_POST['username']);
		$password = trim(md5($_POST['password']));
		$login->admin_login($usertype,$username,$password);
		break;

		case 'member_login';
		$id = trim($_POST['id_number']);
		$login->member_login($id);
		break;
		
	}

?>