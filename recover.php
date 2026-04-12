<?php include('header.php'); ?>
<style>
	body { 
		background: url(images/bg.jpg) no-repeat center center fixed;
		-webkit-background-size: cover !important; 
		-moz-background-size: cover !important; 
		-o-background-size: cover !important; 
		background-size: cover !important; 
	}
/* The container */
.wrapper {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.wrapper input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.wrapper:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.wrapper input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.wrapper input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.wrapper .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}
@media (max-width:768px) {
        .span8 {
            width: 100%;
        }
}@media (max-width:768px) {
        .span8 {
            width: 100%;
        }
}@media (max-width:320px) {
        .span8 {
            width: 100%;
        }
}
</style>
<!-- <script type="text/javascript">
	function start() {
		alert("If you are accessing through network, please include https: in the url to avoid error in accessing camera.\nex: https://192.168.1.2/labmanagement/");
	}
</script> -->
<body id="login" onload="return start();">
    <div class="container">
		<div class="row-fluid">
			<div class="span8">				
				<div class="pull-right">
					<img class="index_logo" src="images/newlogo1.png">
					<form id="login_form1" class="frm_index form-signin">
						<h3 class="form-signin-heading">
							<i class="icon-lock"></i> Please Login
						</h3>
						<br>
						<select name="usertype" class="form-control" required>
							<option value="">Select..</option>
							<option value="student">Student</option>
							<option value="admin">Lab Incharge/Admin</option>
						</select>
						<input type="text" class="input-block-level" id="idnumber" name="username" placeholder="ID Number / Username" required>
						<input type="password" class="input-block-level" id="password" name="password" placeholder="Password">
						
						<button data-placement="right" title="Click Here to Sign In" id="signin" name="login" class="btn btn-info" type="submit"><i class="icon-signin icon-large"></i> Sign in</button><br><br>
						<a href="member/signup">Register</a>
					</form>
				</div>
			</div>
		</div>
		<div class="row-fluid">
           <div class="offset2">		
			   
		   </div>
	    </div>
			
    </div>
	<!-- javascript -->
	<script type="text/javascript" src="assets/custom/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="assets/custom/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/toastr/js/toastr.min.js"></script>
	<script type="text/javascript" src="assets/mycustom/js/login.js"></script>
<?php include('script.php'); ?>
</body>
<!-- <script type="text/javascript">
 $(document).ready(function () { 
	$('input[type="radio"]').click(function(){
	  
	  if($(this).attr("value")=="0"){
	    $("#username").hide('slow');
	    $("#idnumber").show('slow');
	  }
	  if($(this).attr("value")=="1"){
	    $("#username").show('slow');
	    $("#idnumber").hide('slow');
	  }        
	});
});
</script> -->
</html>