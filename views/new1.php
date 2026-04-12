<?php 

include 'header.php';
?>
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
						<div class="error-message"></div>
						<div class="panel-body">
							<form class="frm_borrow">
								<div class="form-group">
									<label class="">Borrower</label>
									<input type="text" class="form-control" name="borrow_membername" readonly value="<?php echo $_SESSION['admin_name']; ?>">
								</div>
								<div class="form-group">
									<label class="">Selected Item</label>
									<input type="text" class="form-control" name="borrowitem[]" id="result" required>
									<input type="hidden" name="user_id" value="<?php echo $_SESSION['admin_id']; ?>">
								</div>
								<div class="form-group">
									<label>Select Room</label>
									<select class="form-control" name="reserve_room" required></select>
								</div>
								<div class="form-group">
									<label class="">Time Limit</label>
									<input name="expected_time_of_return" id="timeLimit" type="text" class="form-control" value="<?php echo date('Y-m-d h:i A'); ?>" />
								</div>
								<div class="form-group">
									<div class="pull-right">
										<button class="btn btn-primary" type="submit">
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

		<script type="text/javascript">
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