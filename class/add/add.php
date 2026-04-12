<?php
require_once "../config/config.php";
// include "../../views/session.php";

// 1 == success
// 2 == exist
// 0 == failed

class add
{
  public function add_cat($name)
  {
    global $conn;

    session_start();
    $h_desc = 'add new room ' . $name;
    $h_tbl = 'room';
    $sessionid = $_SESSION['admin_id'];
    $sessiontype = $_SESSION['admin_type'];

    $select = $conn->prepare("SELECT * FROM category WHERE description = ? ");
    $select->execute(array($name));
    $row = $select->rowCount();
    if ($row <= 0) {
      $sql = $conn->prepare("INSERT INTO category(description) VALUES(?) ;
									   INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)");
      $sql->execute(array($name, $h_desc, $h_tbl, $sessionid, $sessiontype));
      $count = $sql->rowCount();
      if ($count > 0) {
        echo "1";
      } else {
        echo "0";
      }
    } else {
      echo "2";
    }
  }

  public function add_room($name, $assign)
  {
    global $conn;

    session_start();
    $h_desc = 'add new room ' . $name;
    $h_tbl = 'room';
    $sessionid = $_SESSION['admin_id'];
    $sessiontype = $_SESSION['admin_type'];
    $new_name = $name;
    $newassign = explode("|", $assign);

    $select = $conn->prepare("SELECT * FROM room WHERE rm_name = ? ");
    $select->execute(array($new_name));
    $row = $select->rowCount();
    if ($row <= 0) {
      $sql = $conn->prepare("INSERT INTO room(rm_name,rm_status,incharge) VALUES(?,?,?) ;
									   INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)");
      $sql->execute(array($new_name, 1, $newassign[0], $h_desc, $h_tbl, $sessionid, $sessiontype));
      $count = $sql->rowCount();
      if ($count > 0) {
        echo "1";
      } else {
        echo "0";
      }
    } else {
      echo "2";
    }
  }

  public function install($system_name, $fname, $username, $password, $type)
  {
    global $conn;
    $insert = $conn->prepare('INSERT INTO  system_info(system_info) VALUES(?);
									  INSERT INTO  user(name,username,password,type,status,online_stats) VALUES(?,?,?,?,?,?)');
    $insert->execute(array($system_name, $fname, $username, $password, $type, 1, 0));
    $insert_count = $insert->rowCount();
    if ($insert_count > 0) {
      echo "1";
    } else {
      echo "0";
    }
  }

  public function sign_student($sid_number, $s_fname, $s_lname, $s_gender, $s_contact, $s_department, $s_major, $s_year, $s_section, $s_password, $type)
  {
    global $conn;

    $sql = $conn->prepare('SELECT * FROM member WHERE m_school_id = ? AND m_fname = ? AND m_lname = ? AND m_type = ?');
    $sql->execute(array($sid_number, $s_fname, $s_lname, $type));
    $sql_count = $sql->rowCount();
    if ($sql_count <= 0) {

      $insert = $conn->prepare('INSERT INTO  member(m_school_id, m_fname, m_lname, m_gender, m_contact, m_department, m_year_section, m_type, m_password) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
      $insert->execute(array($sid_number, $s_fname, $s_lname, $s_gender, $s_contact, $s_department, $s_year . ' - ' . $s_section, $type, $s_password));
      $insert_count = $insert->rowCount();

      if ($insert_count > 0) {
        echo "1";
      } else {
        echo "0";
      }
    } else {
      echo "2";
    }
  }

  public function sign_faculty($f_id, $f_fname, $f_lname, $f_gender, $f_contact, $f_department, $f_password, $type)
  {
    global $conn;

    $sql = $conn->prepare('SELECT * FROM member WHERE m_school_id = ? AND m_fname = ? AND m_lname = ? AND m_type = ?');
    $sql->execute(array($f_id, $f_fname, $f_lname, $type));
    $sql_count = $sql->rowCount();
    if ($sql_count <= 0) {

      $insert = $conn->prepare('INSERT INTO  member(m_school_id, m_fname, m_lname, m_gender, m_contact, m_department, m_type, m_password) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
      $insert->execute(array($f_id, $f_fname, $f_lname, $f_gender, $f_contact, $f_department, $type, $f_password));
      $insert_count = $insert->rowCount();

      if ($insert_count > 0) {
        echo "1";
      } else {
        echo "0";
      }
    } else {
      echo "2";
    }
  }

  public function add_equipment()
  {
    global $conn;

    $e_date = $_POST['e_date'];
    $e_model = $_POST['e_model'];
    $e_serial = $_POST['e_serial'];
    $e_number = $_POST['e_number'];
    $e_category = $_POST['e_category'];
    $e_brand = $_POST['e_brand'];
    $e_description = $_POST['e_description'];
    $e_stock = $_POST['e_stock'];
    $e_assigned = $_POST['e_assigned'];
    $e_type = $_POST['e_type'];
    $e_status = $_POST['e_status'];
    $e_mr = $_POST['e_mr'];
    $e_price = $_POST['e_price'];

    session_start();
    $h_desc = "add new equipment $e_model, $e_category";
    $h_tbl = 'equipment';
    $sessionid = $_SESSION['admin_id'];
    $sessiontype = $_SESSION['admin_type'];



    $sql = $conn->prepare('INSERT INTO item(i_date_purchase,i_deviceID, i_serial, i_model, i_category, i_brand, i_description, i_type, item_rawstock, i_mr, i_price,i_roomID)
												VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
    $sql->execute([$e_date, $e_number, $e_serial, $e_model, $e_category, $e_brand, $e_description, $e_type, $e_stock, $e_mr, $e_price, $e_assigned]);
    $row = $sql->rowCount();
    $itemID = $conn->lastInsertId();

    $imageName = $_FILES['e_photo']['name'];
    $extension = pathinfo($imageName, PATHINFO_EXTENSION);
    $tmpData = $_FILES['e_photo']['tmp_name'];
    $fileName = time();
    $fileStatus = move_uploaded_file($tmpData, '../../uploads/' . $fileName . "." . $extension);

    $file = "";

    if ($fileStatus):
      $file = $fileName . "." . $extension;
      $sql = $conn->prepare('UPDATE item SET i_photo = ? WHERE id = ?');
      $sql->execute(array($file, $itemID));
    endif;

    if ($row > 0) {
      $item = $conn->prepare('INSERT INTO item_stock (item_id, room_id, items_stock, item_status)
										VALUES(?,?,?,?)');
      $item->execute(array($itemID, $e_assigned, $e_stock, $e_status));
      $countitem = $item->rowCount();
      if ($countitem > 0) {
        $history = $conn->prepare('INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
        $history->execute(array($h_desc, $h_tbl, $sessionid, $sessiontype));
        $historycount = $history->rowCount();
        echo $historycount;
      }
    } else {
      echo '0';
    }
  }

  public function add_member($as, $handle)
  {
    global $conn;

    session_start();
    $h_desc = 'add csv file clients';
    $h_tbl = 'client';
    $sessionid = $_SESSION['admin_id'];
    $sessiontype = $_SESSION['admin_type'];

    try {
      $sql = $conn->prepare('INSERT INTO member(m_school_id,m_fname,m_lname,m_gender,m_contact,m_department,m_year_section,m_type	) VALUES(?,?,?,?,?,?,?,?)');
      fgets($handle);
      while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        $sql->execute($data);
      }
      $insert = $conn->prepare('INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
      $insert->execute(array($h_desc, $h_tbl, $sessionid, $sessiontype));
    } catch (ePDOException $e) {
      echo 0;
    }
    echo 1;
  }


  public function add_itemqty($id, $item_qty)
  {
    global $conn;

    session_start();

    $h_tbl = 'equipment';
    $sessionid = $_SESSION['admin_id'];
    $sessiontype = $_SESSION['admin_type'];

    $sql = $conn->prepare('SELECT * FROM item_stock 
									LEFT JOIN item ON item.id = item_stock.item_id
									WHERE item_stock.id = ?');

    $sql->execute(array($id));
    $count = $sql->rowCount();
    $fetch = $sql->fetch();
    $itemID = $fetch['item_id'];

    $rawstock = $fetch['item_rawstock'] + $item_qty;
    $stockleft = $fetch['items_stock'] + $item_qty;

    $h_desc = 'add ' . $item_qty . 'items to' .  $fetch['i_model'] . 'quantity';

    if ($count > 0) {

      $addstock = $conn->prepare('UPDATE item SET item_rawstock = (item_rawstock + ?) WHERE id = ?');
      $addstock->execute(array($item_qty, $itemID));
      $addrow = $addstock->rowCount();

      if ($addrow > 0) {
        $update_stock = $conn->prepare('UPDATE item_stock SET items_stock = (items_stock + ?) WHERE id = ?');
        $update_stock->execute(array($item_qty, $id));
        $updaterow = $update_stock->rowCount();
        if ($updaterow > 0) {
          $history = $conn->prepare('INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
          $history->execute(array($h_desc, $h_tbl, $sessionid, $sessiontype));
          $historycount = $history->rowCount();

          echo $rawstock . '|' . $stockleft;
        }
      }
    } else {
    }
  }

  public function add_borrower($name, $item, $id, $reserve_room, $timeLimit)
  {

    global $conn;

    session_start();
    $h_desc = 'create borrow transaction';
    $h_tbl = 'borrow';
    $sessionid = $_SESSION['admin_id'];
    $sessiontype = $_SESSION['admin_type'];

    $code = date('mdYHis') . '' . $id;
    $itemsArr = explode("|", $item);

    $select1 = $conn->prepare('SELECT * FROM item WHERE i_deviceID = ?');
    $select1->execute(array($itemsArr[1]));
    $rows = $select1->rowCount();

    $select2 = $conn->prepare('SELECT * FROM item_stock WHERE item_id = ? AND items_stock = 0 ');
    $select2->execute(array($itemsArr[0]));
    $rows1 = $select2->rowCount();

    $sql = $conn->prepare('SELECT * FROM room WHERE id = ? ');
    $sql->execute(array($itemsArr[3]));
    $fetch = $sql->fetch();

    // $select = $conn->prepare('SELECT * FROM borrow WHERE member_id = ? AND status = ? AND item_id = ? ');
    // $select->execute(array($name,1,$itemsArr[0]));
    // $row = $select->rowCount();
    if ($rows1 > 0) {
      echo json_encode(array("response" => 0, "message" => 'Item not available!'));
    } elseif ($rows < 1) {
      echo json_encode(array("response" => 0, "message" => 'Item Code not Found!'));
    } else {
      $borrowIds = array();

      // foreach ($item as $key => $items)
      // {
      $Limit = Date('Y-m-d', strtotime('+ ' . $fetch['timelimit'] . ' days'));
      $sql = $conn->prepare('INSERT INTO borrow (borrowcode,member_id,item_id,stock_id,user_id,room_assigned,time_limit) VALUES(?,?,?,?,?,?,?)');
      $sql->execute(array($code, $name, $itemsArr[0], $itemsArr[2], $id, $itemsArr[3], $Limit));
      $count = $sql->rowCount();
      $borrowIds[] = $conn->lastInsertId();

      // }

      echo json_encode(array("response" => 1, "message" => "Successfully Borrowed", "borrowIds" => implode("|", $borrowIds)));
    }
  }

  public function add_users($u_fname, $u_username, $u_password, $u_type)
  {
    global $conn;

    session_start();
    $h_desc = 'add user' . $u_fname;
    $h_tbl = 'user';
    $sessionid = $_SESSION['admin_id'];
    $sessiontype = $_SESSION['admin_type'];

    $sql = $conn->prepare('SELECT * FROM user WHERE name = ? OR username = ? ');
    $sql->execute(array($u_fname, $u_username));
    $count = $sql->rowCount();
    if ($count <= 0) {
      $que = $conn->prepare('INSERT INTO user	(name,username,password,type) VALUES(?,?,?,?);
									   INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');

      $que->execute(array($u_fname, $u_username, $u_password, $u_type, $h_desc, $h_tbl, $sessionid, $sessiontype));
      $row = $que->rowCount();
      if ($row > 0) {
        echo "1";
      } else {
        echo "0";
      }
    } else {
      echo "2";
    }
  }


  public function addclient_reservation($items, $date, $time, $client_id, $assign_room, $timeLimit)
  {
    global $conn;
    $code = date('mdYhis') . '' . $client_id;

    // $sql = $conn->prepare('SELECT * FROM reservation WHERE reservation_code = ?');
    // $sql->execute(array($code));
    // $row = $sql->rowCount();
    // if($row > 0){
    // 	echo '2';
    // }else{
    if ($client_id == 0) {
      echo '3';
    } else {
      foreach ($items as $key => $items) {
        $itemsArr = explode("||", $items);
        $sql1 = $conn->prepare('INSERT INTO reservation(reservation_code,member_id,item_id,stock_id,reserve_date,reservation_time,assign_room,time_limit) VALUES(?,?,?,?,?,?,?,?)');
        $sql1->execute(array($code, $client_id, $itemsArr[0], $itemsArr[1], $date, $time, $assign_room, $timeLimit));
        $count = $sql1->rowCount();
      }
      echo ($count > 0) ? '1' : '0';
    }
    // }
    // foreach ($items as $key => $value) {

    // }
  }

  public function add_newstudent($sid_number, $s_fname, $s_lname, $s_gender, $s_contact, $s_department, $s_major, $s_year, $s_section)
  {
    global $conn;

    session_start();
    $h_desc = 'add new student';
    $h_tbl = 'client';
    $sessionid = $_SESSION['admin_id'];
    $sessiontype = $_SESSION['admin_type'];

    $type = 3;
    $pass = md5($sid_number);
    $sql = $conn->prepare('SELECT * FROM member WHERE m_school_id = ? AND m_fname = ? AND m_lname = ? AND m_type = ?');
    $sql->execute(array($sid_number, $s_fname, $s_lname, $type));
    $sql_count = $sql->rowCount();
    if ($sql_count <= 0) {

      $insert = $conn->prepare('INSERT INTO member(m_school_id, m_fname, m_lname, m_gender, m_contact, m_department, m_year_section, m_type, m_password) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);
						INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
      $insert->execute(array($sid_number, $s_fname, $s_lname, $s_gender, $s_contact, $s_department, $s_year . ' - ' . $s_section, $type, $pass, $h_desc, $h_tbl, $sessionid, $sessiontype));
      $insert_count = $insert->rowCount();

      if ($insert_count > 0) {
        echo "1";
      } else {
        echo "0";
      }
    } else {
      echo "2";
    }
  }

  public function add_newfaculty($f_id, $f_fname, $f_lname, $f_gender, $f_contact, $f_department, $type)
  {
    global $conn;

    $sql = $conn->prepare('SELECT * FROM member WHERE m_school_id = ? AND m_fname = ? AND m_lname = ? AND m_type = ?');
    $sql->execute(array($f_id, $f_fname, $f_lname, $type));
    $sql_count = $sql->rowCount();
    if ($sql_count <= 0) {

      $insert = $conn->prepare('INSERT INTO  member(m_school_id, m_fname, m_lname, m_gender, m_contact, m_department, m_type) VALUES(?, ?, ?, ?, ?, ?, ?);
						INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
      $insert->execute(array($f_id, $f_fname, $f_lname, $f_gender, $f_contact, $f_department, $type, $h_desc, $h_tbl, $sessionid, $sessiontype));
      $insert_count = $insert->rowCount();

      if ($insert_count > 0) {
        echo "1";
      } else {
        echo "0";
      }
    } else {
      echo "2";
    }
  }
}


$add_function = new add();

$key = trim($_POST['key']);

switch ($key) {
  case 'add_cat';
    $name = $_POST['name'];
    $add_function->add_cat($name);
    break;

  case 'add_room';
    $assign = $_POST['assign'];
    $name = strtolower($_POST['name']);
    $add_function->add_room($name, $assign);
    break;

  case 'install';
    $system_name = trim($_POST['system_name']);
    $fname = strtolower(trim($_POST['fname']));
    $username = strtolower(trim($_POST['username']));
    $password = md5(trim($_POST['password']));
    $type = 1;
    $add_function->install($system_name, $fname, $username, $password, $type);
    break;

  case 'sign_student';
    $sid_number = trim($_POST['sid_number']);
    $s_fname = strtolower(trim($_POST['s_fname']));
    $s_lname = strtolower(trim($_POST['s_lname']));
    $s_gender = trim($_POST['s_gender']);
    $s_contact = trim($_POST['s_contact']);
    $s_department = trim($_POST['s_department']);
    $s_major = trim($_POST['s_major']);
    $s_year = trim($_POST['s_year']);
    $s_section = trim($_POST['s_section']);
    $s_password = trim(md5($_POST['s_password']));
    $type = 3;
    $add_function->sign_student($sid_number, $s_fname, $s_lname, $s_gender, $s_contact, $s_department, $s_major, $s_year, $s_section, $s_password, $type);
    break;

  case 'sign_faculty';
    $f_id = trim($_POST['f_id']);
    $f_fname = strtolower(trim($_POST['f_fname']));
    $f_lname = strtolower(trim($_POST['f_lname']));
    $f_gender = trim($_POST['f_gender']);
    $f_contact = trim($_POST['f_contact']);
    $f_department = trim($_POST['f_department']);
    $f_password = trim(md5($_POST['f_password']));
    $type = 4;
    $add_function->sign_faculty($f_id, $f_fname, $f_lname, $f_gender, $f_contact, $f_department, $f_password, $type);
    break;

  case 'add_equipment';

    $e_date = trim($_POST['e_date']);
    $e_number = trim($_POST['e_number']);
    $e_model = trim($_POST['e_model']);
    $e_serial = trim($_POST['e_serial']);
    $e_category = trim($_POST['e_category']);
    $e_brand = trim($_POST['e_brand']);
    $e_description = trim($_POST['e_description']);
    $e_stock = trim($_POST['e_stock']);
    $e_assigned = trim($_POST['e_assigned']);
    $e_type = trim($_POST['e_type']);
    $e_status = trim($_POST['e_status']);
    $add_function->add_equipment($e_number, $e_date, $e_model, $e_serial, $e_category, $e_brand, $e_description, $e_stock, $e_assigned, $e_type, $e_status);
    break;

  case 'add_member';
    if ($_FILES['file']['name']) {
      $filename = explode('.', $_FILES['file']['name']);
      if ($filename[1] == 'csv') {
        $as = 1;
        $handle = fopen($_FILES['file']['tmp_name'], "r");
      } else {
        $as = 0;
      }
    }
    $add_function->add_member($as, $handle);
    break;

  case 'add_itemqty';
    $id = trim($_POST['id']);
    $item_qty = trim($_POST['item_qty']);
    $add_function->add_itemqty($id, $item_qty);
    break;

  case 'add_borrower';
    $name = $_POST['user_id'];
    $item = $_POST['borrowitem'];
    $id = $_POST['user_id'];
    $reserve_room = $_POST['reserve_room'];
    $timeLimit = $_POST['expected_time_of_return'];
    $add_function->add_borrower($name, $item, $id, $reserve_room, $timeLimit);
    break;

  case 'add_users';
    $u_fname = trim($_POST['u_fname']);
    $u_username = trim($_POST['u_username']);
    $u_password = trim(md5($_POST['u_password']));
    $u_type = trim($_POST['u_type']);
    $add_function->add_users($u_fname, $u_username, $u_password, $u_type);
    break;

  case 'addclient_reservation';
    $items = $_POST['reserve_item'];
    $date = $_POST['reserved_date'];
    $time = $_POST['reserved_time'];
    $client_id = $_POST['client_id'];
    $assign_room = $_POST['reserve_room'];
    $timeLimit = $_POST['time_limit'];
    $add_function->addclient_reservation($items, $date, $time, $client_id, $assign_room, $timeLimit);
    break;

  case 'add_newstudent';
    $sid_number = trim($_POST['sid_number']);
    $s_fname = ucwords(trim($_POST['s_fname']));
    $s_lname = ucwords(trim($_POST['s_lname']));
    $s_gender = trim($_POST['s_gender']);
    $s_contact = trim($_POST['s_contact']);
    $s_department = trim($_POST['s_department']);
    $s_major = trim($_POST['s_major']);
    $s_year = trim($_POST['s_year']);
    $s_section = ucwords(trim($_POST['s_section']));
    $add_function->add_newstudent($sid_number, $s_fname, $s_lname, $s_gender, $s_contact, $s_department, $s_major, $s_year, $s_section);
    break;

  case 'add_newfaculty';
    $f_id = trim($_POST['f_id']);
    $f_fname = strtolower(trim($_POST['f_fname']));
    $f_lname = strtolower(trim($_POST['f_lname']));
    $f_gender = trim($_POST['f_gender']);
    $f_contact = trim($_POST['f_contact']);
    $f_department = trim($_POST['f_department']);
    $type = 4;
    $add_function->add_newfaculty($f_id, $f_fname, $f_lname, $f_gender, $f_contact, $f_department, $type);
    break;
}
