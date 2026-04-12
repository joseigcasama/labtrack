<?php
include 'class/config/config.php';
$sql = $conn->prepare("SELECT * FROM system_info ");
$sql->execute();
$fetch = $sql->fetchAll();
foreach ($fetch as $key => $value) {
  $sname = $value['system_info'];
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php include 'title.php'; ?></title>
  <link href="images/don jose.png" rel="icon" type="image">
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="boxicons.min.css">
  <script type="text/javascript" src="bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="vue.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/toastr/css/toastr.css">
  <link href="bootstrap/css/font-awesome.css" rel="stylesheet" media="screen" />
</head>
<!-- <script type="text/javascript">
    function start() {
        alert("If you are accessing through network, please include https: in the url to avoid error in accessing camera.\n ex: https://192.168.1.2/labmanagement/");
    }
</script> -->

<body onload="return start();">
  <div class="container mt-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-6">
        <div class="card px-5 py-5" id="form1">
          <div class="form-data" v-if="!submitted">
            <form id="login_form1" class="frm_index form-signin">
              <center>
                <h3><?= $sname; ?></h3>
              </center><br>
              <h3 class="form-signin-heading">
                <i class="icon-lock"></i> Please Login
              </h3>
              <br>
              <div class="forms-inputs mb-4">
                <span><i class="icon-user "></i> User Type</span>
                <select name="usertype" class="form-control" required>
                  <option value=""></option>
                  <option value="student">Borrower</option>
                  <option value="admin">Lab Incharge/Property Custodian</option>
                </select>
              </div>
              <div class="forms-inputs mb-4"> <span><i class="icon-user"></i> ID Number / Username</span> <input autocomplete="off" type="text" v-model="email" class="form-control" v-on:blur="emailBlured = true" name="username">
                <div class="invalid-feedback">A valid email is required!</div>
              </div>
              <div class="forms-inputs mb-4"> <span><i class="icon-lock"></i> Password</span> <input autocomplete="off" type="password" v-model="password" class="form-control" v-on:blur="passwordBlured = true" name="password">
                <div class="invalid-feedback">Password must be 8 character!</div>
              </div>
              <div class="mb-3"> <button v-on:click.stop.prevent="submit" class="btn btn-dark w-100"><i class="icon-check"></i> Login</button> </div>
            </form>
            <div class="forms-inputs mb-4">
              <!-- <a href="recover">Forgot Password / Logout</a><br><br>-->
              No account?
              <a href="member/signup">Register</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="assets/custom/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="assets/custom/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/toastr/js/toastr.min.js"></script>
  <script type="text/javascript" src="assets/mycustom/js/login.js"></script>
  <style type="text/css">
    body {
      background: url(images/djmc_logo.jpg) no-repeat center center fixed;
      -webkit-background-size: cover !important;
      -moz-background-size: cover !important;
      -o-background-size: cover !important;
      background-size: cover !important;

      .card {
        border: none;
        height: auto;
        background-color: #00000061;
        color: white;
        border-radius: 10px;
      }

      .forms-inputs {
        position: relative
      }

      .forms-inputs span {
        position: absolute;
        top: -28px;
        background-color: #fff;
        padding: 5px 10px;
        font-size: 15px;
        border-radius: 4px;
      }

      .forms-inputs input {
        height: 50px;
        border: 2px solid #eee;
        background-color: #00000061;
        color: #fff;
      }

      .forms-inputs input:focus {
        box-shadow: none;
        outline: none;
        border: 2px solid #000
      }

      .btn {
        height: 50px
      }

      .success-data {
        display: flex;
        flex-direction: column
      }

      .bxs-badge-check {
        font-size: 90px
      }

      .forms-inputs select {
        background-color: #00000061;
        color: #fff;
      }

      .forms-inputs span {
        background-color: #00000061;
      }
    }
  </style>
</body>

</html>