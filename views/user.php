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
			<li class="active">Users</li>
		</ol>
		<div class="breadcrumb">
			<button class="btn btn-primary col-sm-offset-10 add_user">
				<svg class="glyph stroked plus sign">
					<use xlink:href="#stroked-plus-sign"/>
				</svg>
				Add User
			</button>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table_user">
						<thead>
							<tr>
								<th>Name</th>
								<th>Type</th>
								<th>Username</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div><!-- panel -->
		</div><!-- panel -->

	</div><!-- row -->

	
</div>

<div class="right-sidebar user-side">
	<div class="sidebar-form">
		<div class="container-fluid">
			<form class="frmadd_users">
				<h4 class="alert bg-success">Add User</h4>
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="u_fname" class="form-control" required="required">
				</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="u_username" class="form-control" required="required">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="u_password" class="form-control" required="required">
				</div>
				<div class="form-group">
					<label>User Type</label>
					<select class="form-control" name="u_type" required="required">
						<option disabled selected>Please select user type</option>
						<option value="1">Property Custodian</option>
						<option value="2">Laboratory Incharge</option>
					</select>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<button class="btn btn-danger btn-block cancel_user" type="button">
								CANCEL
							</button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-primary btn-block" type="submit">
								SAVE
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="right-sidebar userdiv">
	<div class="container-fluid">
		<div class="edit-userside"></div>
	</div>
</div>


<?php include 'footer.php'; ?>