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
			<li class="active">User Profile</li>
		</ol>
		<div class="breadcrumb">
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
						<div class="col-lg-2"></div>
						<div class="col-lg-4">
							<div class="form-group">
								<p class="e_photo">
									<img src="../assets/noimagefound.jpg">
								</p>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="form-group">
								<label>Name</label>
								<p class="e_id"><?php echo $_SESSION['admin_name'];?></p>
							</div>
							<div class="form-group">
								<label>Username</label>
								<p class="e_model"><?php echo $_SESSION['admin_username'];?></p>
							</div>
							<div class="form-group">
								<label>User type</label>
								<p class="e_category"><?php echo ($_SESSION['admin_type'] == 1) ? 'Administrator' : 'Staff';?></p>
							</div>
						</div>
						<div class="col-lg-2"></div>
				</div>
			</div><!-- panel -->
		</div><!-- panel -->

	</div><!-- row -->

	
</div>

<style type="text/css">
	label{
		font-weight: bolder;
	}
</style>



<?php include 'footer.php'; ?>