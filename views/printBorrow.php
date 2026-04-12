<?php
require_once 'session.php';
require_once "../class/config/config.php";

global $conn;
$sql = $conn->prepare('UPDATE borrow SET b_action = ? WHERE id = ?');
$sql->execute(array(1, $_GET['borrowIds']));
$update = $conn->prepare('UPDATE item_stock SET items_stock = (items_stock - ?) WHERE item_id = ?');
$update->execute(array(1, $_GET['itemID']));
$getBorrowedLists = $conn->prepare("SELECT * FROM borrow LEFT JOIN member ON member.id = borrow.member_id LEFT JOIN room ON room.id = borrow.room_assigned LEFT JOIN item ON item.id = borrow.item_id LEFT JOIN category ON category.id=item.i_category WHERE borrow.id IN(?)");
$getBorrowedLists->execute(array(trim($_GET['borrowIds'])));
$data = $getBorrowedLists->fetchAll();
?>
<html>
<style>
  body {
    font-size: 18px
  }

  h4 {
    margin: 0 0 5px;
    padding: 0
  }
</style>

<body>
  <center>
    <br />
    <table style="width:6in" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <td colspan="4" align="center"><img src="logo.png" class="img-responsive" style="width: 60px;height: 60px;" /></td>
        </tr>
        <tr>
          <td colspan="4" style="text-align:center; font-size:14px; font-family:'Times New Roman'">
            <p style="margin:0;padding:0;">Republic of the Philippines</p>
            <p style="margin:0;padding:0;font-weight:bold;">DON JOSE ECLEO MEMORIAL COLLEGE</p>
            <p style="margin:0;padding:0;">San Jose, Dinagat Islands</p>
          </td>
        </tr>
        <tr>
          <td colspan="4" style="text-align:center; font-weight:bold; padding:10px 0; font-size:16px; font-family:'Bookman Old Style'; text-transform: uppercase;">Borrowing Proof Receipt</td>
        </tr>
        <tr>
          <td colspan="4">Name: <?php echo $data[0]['m_fname']; ?> <?php echo $data[0]['m_lname']; ?></td>
        </tr>
        <tr>
          <td>Room: <label style="text-transform: uppercase;font-size: 12px;"><?php echo $data[0]['rm_name']; ?></label></td>
          <td>Date Borrow:</td>
          <td colspan="2"><?php echo date('Y-M-d', strtotime($data[0]['date_borrow'])); ?></td>
        </tr>
        <tr>
          <td colspan="3">
            <table style="width:100%; border:1px solid #000; border-bottom: none;" cellpadding="0" cellspacing="0">
              <thead>
                <tr>
                  <th style="padding:5px; font-size:14pt; font-family:'Calibri'; border-bottom:1px solid #000;">Category</th>
                  <th style="padding:5px; font-size:14pt; font-family:'Calibri'; border-bottom:1px solid #000; border-left:1px solid #000;">Item Description</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $item) : ?>
                  <tr>
                    <td style="padding:5px; font-size:14pt; font-family:'Calibri'; border-bottom:1px solid #000; text-align:center;"><?php echo $item['description']; ?></td>
                    <td style="padding:5px; font-size:12pt; font-family:'Calibri'; border-bottom:1px solid #000; border-left:1px solid #000; text-align:center;"><?php echo $item['i_brand']; ?> <?php echo $item['i_model']; ?> (SN:<?= $item['i_serial']; ?>)</td>
                  </tr>
                <?php endforeach; ?>

                <br />

              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
    <br />
    <?php
    echo "<p> ____________________</p>";
    echo "<p> Borrower's Signature </p>";
    ?>


    <div style="width:6in; text-align: left; margin-top:  5rem;">
      <p>
        Date Return: _________________
      </p>
      <p>
        Item Status: _________________
      </p>
    </div>

    <br />
    <p> ____________________</p>
    <p> Borrower's Signature </p>
  </center>



</body>

</html>