<?php 
date_default_timezone_set('Asia/Manila');
include 'header.php';
?>
<style>
/* Popup container - can be anything you want */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* The actual popup */
.popup .popuptext {
  visibility: hidden;
  width: 360px;
  background-color: #555;
  color: #fff;
  border-radius: 6px;
  padding: 8px;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: -88%;
  font-size: 12px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
</style>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 col-md-2 sidebar">
  <?php include 'nav-bar.php'; ?>
</div>



<div class="col-sm-9 col-lg-10 col-md-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-3 main">

	<div class="row">
		<ol class="breadcrumb">
			<li><a href="dashboard"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Borrow</li>
		</ol>
				
			<div class="row">
				<br/>
				<br/>
				<div class="col-md-4 col-sm-12 col-xs-12 col-md-offset-2">
					<div class="panel panel-primary custom-panel">
						<form class="frm_borrow" name="borrow">
							<div class="panel-heading">
								<i class="fa fa-plus-circle"></i>
								Scan Equipment QRcode
							</div>
							<div class="panel-body">
							  <div class="col">
							    <div style="width:325px;" id="reader"></div>
							  </div>
							</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12">
					<div class="panel panel-primary custom-panel">
						<div class="panel-heading">
							<i class="fa fa-plus-circle"></i>
							Borrow Item/s
						</div>
						<div class="panel-body">
							
								<div class="form-group">
									<!-- <label class="">Borrower</label> -->
									<input type="hidden" class="form-control" name="borrow_membername" readonly value="<?php echo $_SESSION['admin_name']; ?>">
								</div>
								<div class="form-group">
									<label class="">Selected Item</label>
									<input type="hidden" class="form-control input-lg borrowitem" name="borrowitem" readonly id="result" required="required">
									<input type="text" class="form-control input-lg" readonly id="name">
									<input type="hidden" name="user_id" value="<?php echo $_SESSION['admin_id']; ?>">
								</div>
								<input type="hidden" name="reserve_room">
								<input type="hidden" name="expected_time_of_return">

<!-- 								<div class="form-group">
									<label>Select Room</label>
									<select class="form-control" name="reserve_room" required></select>
								</div> -->
								<div class="form-group">
									<label class="">Terms and Conditions</label><br>
									<input type="checkbox" id="agree" disabled onchange="document.getElementById('submit').disabled = !this.checked;" /> I Agree to the <a href="#" class="popup" onclick="myFunction()">Terms and Conditions
									<span class="popuptext" id="myPopup">
										<b>Terms and Conditions</b><br>
										<ul>
											<li>Borrowers must comply laboratory rules and regulations.</li>
											<li>Borrowers must return item in good condition.</li>
											<li>If item return damage she/he must pay for repair fee.</li>
										</ul>
										<label class="pull-right" onclick="agreeterm()" style="color: #000;background-color: #fff;">OK</label>
									</span></a>
								</div>
								<div class="form-group">
									<div class="pull-right">
										<button class="btn btn-primary" id="submit" disabled type="submit">
											Confirm Borrow
											<i class="fa fa-chevron-right"></i>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include 'footer.php'; ?>
<script src="html5-qrcode.min.js"></script>
		<script type="text/javascript">
// When the user clicks on div, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
function agreeterm() {
  document.getElementById('agree').disabled=false;
}
function onScanSuccess(qrCodeMessage) {
	var name = qrCodeMessage.split('|');
    document.getElementById('name').value = name[5] + ' ' + name[6];
    document.getElementById('result').value = qrCodeMessage;
}
function onScanError(errorMessage) {
  //handle scan error
}
var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);

			$(document).ready(function(){
				$("#timeLimit").datetimepicker({
					minTime: '<?php echo date("H:i"); ?>',
					maxTime: '18:00',
					minDate: 0,
					maxDate: 0,
					format:'Y-m-d h:i A',
					step: 15
				});
			});
		</script>