<center>
  <h2>CREATING DATABASE</h2>
  <?php

  try {
    $pdo = new PDO('mysql:host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE lab_mgt";
    $pdo->exec($sql);
    $pdo->exec('USE lab_mgt');
    $table = "CREATE TABLE `borrow` (
      `id` int(11) NOT NULL,
      `date_borrow` datetime NOT NULL DEFAULT current_timestamp(),
      `borrowcode` bigint(50) NOT NULL,
      `member_id` int(11) NOT NULL,
      `item_id` varchar(200) NOT NULL,
      `stock_id` int(11) NOT NULL,
      `user_id` int(11) NOT NULL,
      `room_assigned` int(11) NOT NULL,
      `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=UnReturn,\r\n2=????,\r\n3=Lost,\r\n4=Damage',
      `time_limit` date NOT NULL,
      `date_return` datetime DEFAULT NULL,
      `e_remarks` varchar(200) NOT NULL,
      `b_action` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

    CREATE TABLE `category` (
      `id` int(11) NOT NULL,
      `description` varchar(50) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


    CREATE TABLE `equipment` (
      `id` int(11) NOT NULL,
      `e_deviceid` varchar(50) NOT NULL,
      `e_model` varchar(50) NOT NULL,
      `e_category` varchar(50) NOT NULL,
      `e_brand` varchar(50) NOT NULL,
      `e_description` text NOT NULL,
      `e_stock` int(11) NOT NULL,
      `e_stockleft` int(11) NOT NULL,
      `e_type` varchar(50) NOT NULL,
      `e_status` varchar(50) NOT NULL,
      `room_id` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


    CREATE TABLE `history_logs` (
      `id` int(11) NOT NULL,
      `description` text NOT NULL,
      `table_name` varchar(100) NOT NULL,
      `status_name` text NOT NULL,
      `user_id` int(11) NOT NULL,
      `user_type` int(11) NOT NULL,
      `date_created` datetime NOT NULL DEFAULT current_timestamp()
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

    CREATE TABLE `item` (
      `id` int(5) NOT NULL,
      `i_date_purchase` date NOT NULL,
      `i_deviceID` varchar(50) NOT NULL,
      `i_serial` varchar(50) NOT NULL,
      `i_model` varchar(50) NOT NULL,
      `i_category` int(50) NOT NULL,
      `i_brand` varchar(50) NOT NULL,
      `i_description` text NOT NULL,
      `i_type` varchar(50) NOT NULL,
      `item_rawstock` int(11) NOT NULL,
      `i_status` int(11) NOT NULL DEFAULT 1,
      `i_mr` varchar(50) NOT NULL,
      `i_price` decimal(10,2) NOT NULL,
      `i_photo` varchar(100) NOT NULL,
      `i_roomID` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

    CREATE TABLE `item_inventory` (
      `id` int(11) NOT NULL,
      `item_id` int(11) NOT NULL,
      `inventory_itemstock` int(11) NOT NULL,
      `inventory_status` int(11) NOT NULL,
      `item_remarks` text NOT NULL,
      `date_change` timestamp NOT NULL DEFAULT current_timestamp()
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

    CREATE TABLE `item_stock` (
      `id` int(11) NOT NULL,
      `item_id` int(11) NOT NULL,
      `room_id` int(11) NOT NULL,
      `items_stock` int(11) NOT NULL,
      `item_status` int(11) NOT NULL DEFAULT 1,
      `status` int(11) NOT NULL DEFAULT 1
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

    CREATE TABLE `member` (
      `id` int(11) NOT NULL,
      `m_school_id` varchar(11) NOT NULL,
      `m_fname` varchar(50) NOT NULL,
      `m_lname` varchar(50) NOT NULL,
      `m_gender` varchar(10) NOT NULL,
      `m_contact` varchar(15) NOT NULL,
      `m_department` varchar(50) NOT NULL,
      `m_year_section` varchar(20) NOT NULL,
      `m_type` varchar(50) NOT NULL,
      `m_password` varchar(50) NOT NULL,
      `m_status` int(11) NOT NULL DEFAULT 1,
      `online_stats` int(11) NOT NULL COMMENT '1=online, 0=off'
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

    CREATE TABLE `room` (
      `id` int(11) NOT NULL,
      `rm_name` varchar(50) NOT NULL,
      `rm_date_added` datetime NOT NULL DEFAULT current_timestamp(),
      `rm_status` int(11) NOT NULL DEFAULT 0,
      `incharge` int(11) NOT NULL,
      `timelimit` varchar(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

    CREATE TABLE `system_info` (
      `id` int(11) NOT NULL,
      `system_info` varchar(50) NOT NULL,
      `abbr` varchar(10) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

    CREATE TABLE `user` (
      `id` int(11) NOT NULL,
      `name` varchar(50) NOT NULL,
      `username` varchar(50) NOT NULL,
      `password` varchar(50) NOT NULL,
      `type` int(11) NOT NULL COMMENT '1=admin, 2=stafff',
      `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 2=inactive',
      `online_stats` int(11) NOT NULL COMMENT '1=online, 0=off'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    ALTER TABLE `borrow`
      ADD PRIMARY KEY (`id`);

    ALTER TABLE `category`
      ADD PRIMARY KEY (`id`);

    ALTER TABLE `equipment`
      ADD PRIMARY KEY (`id`);

    ALTER TABLE `history_logs`
      ADD PRIMARY KEY (`id`);

    ALTER TABLE `item`
      ADD PRIMARY KEY (`id`),
      ADD KEY `i_category` (`i_category`);

    ALTER TABLE `item_inventory`
      ADD PRIMARY KEY (`id`);

    ALTER TABLE `item_stock`
      ADD PRIMARY KEY (`id`),
      ADD KEY `item_id` (`item_id`),
      ADD KEY `room_id` (`room_id`);

    ALTER TABLE `member`
      ADD PRIMARY KEY (`id`);

    ALTER TABLE `room`
      ADD PRIMARY KEY (`id`);

    ALTER TABLE `system_info`
      ADD PRIMARY KEY (`id`);

    ALTER TABLE `user`
      ADD PRIMARY KEY (`id`);

    ALTER TABLE `borrow`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

    ALTER TABLE `category`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

    ALTER TABLE `equipment`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

    ALTER TABLE `history_logs`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

    ALTER TABLE `item`
      MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

    ALTER TABLE `item_inventory`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

    ALTER TABLE `item_stock`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

    ALTER TABLE `member`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

    ALTER TABLE `room`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

    ALTER TABLE `system_info`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

    ALTER TABLE `user`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

    ALTER TABLE `item`
      ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`i_category`) REFERENCES `category` (`id`);

    ALTER TABLE `item_stock`
      ADD CONSTRAINT `item_stock_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
      ADD CONSTRAINT `item_stock_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`);
    COMMIT;
  ";
    $pdo->query($table);
    echo "<img style=align-content:center src=images/1_1A6_7adoPZL9CJPurJm76w.gif>";
    header("refresh:15.9;url=install");
  } catch (PDOException $e) {
    echo "";
  }
  ?>
</center>