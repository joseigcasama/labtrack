<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Installation</title>
  <link href="images/don jose.png" rel="icon" type="image">
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="boxicons.min.css">
  <script type="text/javascript" src="bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="vue.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/toastr/css/toastr.css">
  <link href="bootstrap/css/font-awesome.css" rel="stylesheet" media="screen" />
</head>

<body onload="return start();">
  <div class="container mt-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-6">
        <div class="card px-5 py-5" id="form1">
          <div class="form-data" v-if="!submitted">
            <form class="form-signin" action="save" method="POST">
              <?php
              $servername = "localhost";
              $username = "root";
              $password = "";

              try {
                $conn = new PDO("mysql:host=$servername;dbname=lab_mgt", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); ?>

                <div class="forms-inputs mb-4"> <span><i class="icon-info-sign"></i>System Name</span> <input autocomplete="off" type="text" class="form-control" name="system_name" required>
                </div>
                <div class="forms-inputs mb-4"> <span><i class="icon-info-sign"></i>System Abbreviation</span> <input autocomplete="off" type="text" class="form-control" name="abbr" required>
                </div>
                <p>Property Custodian Info</p>
                <div class="forms-inputs mb-4"> <span><i class="icon-user"></i> Name</span> <input autocomplete="off" type="text" class="form-control" name="fname" required>
                </div>
                <div class="forms-inputs mb-4"> <span><i class="icon-user"></i> Username</span> <input autocomplete="off" type="text" class="form-control" name="user" required>
                </div>
                <div class="forms-inputs mb-4"> <span><i class="icon-lock"></i> Password</span> <input autocomplete="off" type="password" class="form-control" name="pass" required>
                </div>
                <div class="mb-3"> <button v-on:click.stop.prevent="submit" class="btn btn-dark w-100 btn_install"><i class="icon-check"></i> SAVE</button> </div>
              <?php    } catch (PDOException $e) { ?>
                <center>
                  <h3>CREATING DATABASE</h3>
                </center>
                <a href="create" class="btn btn-dark w-100"><i class="icon-check"></i> CREATE DATABASE</a>
              <?php  } ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="assets/custom/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="assets/custom/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/toastr/js/toastr.min.js"></script>

</body>

</html>