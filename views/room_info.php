<?php 
include 'header.php';
?>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 col-md-2 sidebar">
  <?php include 'nav-bar.php'; ?>
</div>


<div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 col-lg-10 col-lg-offset-2 main">	
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="dashboard"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class=""><a href="room">Rooms</a></li>
			<li class="active"><?php echo ucwords($_GET['name']); ?></li>
		</ol>
	</div><!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table_roominfo">
							<thead>
								<tr>
									<th>Model</th>
									<th>Description</th>
									<th>Stock</th>
									<th>Stock Available</th>
									<th>Status</th>
								</tr>
							</thead>
						</table>
				</div>
			</div><!-- panel -->
		</div><!-- panel -->

	</div><!-- row -->
</div>

<div class="right-sidebar transfer">
	<div class="sidebar-form">
		<div class="container-fluid">
			<br/>
			<form class="frm_transfer">
				<input type="hidden" name="key" value="transfer_item" />
				<input type="hidden" name="id" value="0" />
				<div class="form-group">
					<label>Transfer Room</label>
					<select name="transfer_room" class="form-control" required></select>
				</div>
				<div class="form-group">
					<label>Number of Qty</label>
					<input type="number" name="number_items" class="form-control" min="0" required>
				</div>
				<div class="form-group">
					<label>Personnel-in-Charge</label>
					<input type="text" name="personincharge" class="form-control" required>
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Transfer</button>
					<button class="btn btn-danger cancel-transfer" type="button" >Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="right-sidebar change_status">
	<div class="sidebar-form">
		<div class="container-fluid">
			
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-sm mymodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<form class="frm_returnroom">
				<div class="modal-header">
					
					<h4 class="modal-title" id="myModalLabel">Number of Quantity</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Number of Quantity</label>
						<input type="number" name="qty_transfer" class="form-control" min="0">
						<input type="hidden" name="id">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Return</button>
				</div>	
			</form>
		</div>
	</div>
</div>




<?php include 'footer.php'; ?>

<script type="text/javascript">
	$(function() {
		var a = '<?php echo $_GET['name']; ?>';
		var b = '<?php echo $_GET['id']; ?>';
		room_info(a,b);
	});
</script>