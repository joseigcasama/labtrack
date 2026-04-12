<?php
require_once 'session.php';
include '../class/config/config.php';
?>
<!DOCTYPE html>
<html>
<title><?php include '../title.php'; ?></title>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title></title>

  <!-- bootstrap -->
  <link rel="stylesheet" type="text/css" href="../assets/custom/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/custom/css/bootstrap-table.css">
  <link rel="stylesheet" type="text/css" href="../assets/custom/css/datepicker.css">
  <link rel="stylesheet" type="text/css" href="../assets/custom/css/datepicker3.css">
  <link rel="stylesheet" type="text/css" href="../assets/custom/css/styles.css">
  <!-- datatables -->
  <link rel="stylesheet" type="text/css" href="../assets/datatables/css/jquery.dataTables.min.css">

  <!-- fontawesome -->
  <link rel="stylesheet" type="text/css" href="../assets/fontawesome/css/font-awesome.min.css">

  <!-- custom -->
  <link rel="stylesheet" type="text/css" href="../assets/mycustom/css/styles.css">

  <!-- toastr -->
  <link rel="stylesheet" type="text/css" href="../assets/toastr/css/toastr.css">

  <!-- select2 -->
  <link rel="stylesheet" type="text/css" href="../assets/select/dist/css/select2.min.css">

  <!-- amcharts -->
  <link rel="stylesheet" href="../assets/amcharts/css/export.css" media="all" />
  <link rel="stylesheet" type="text/css" href="../assets/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/datetimepicker/datetimepicker.css">
  <link href="../images/don jose.png" rel="icon" type="image">


  <style>
    #notification-bell {
      position: relative;
      color: white;
      transform: translateY(1px);
      transition: opacity 0.1s ease-in-out;
    }

    #notification-bell:hover {
      opacity: 0.5;
    }

    #dueBadge {
      background-color: red;
      border-radius: 100%;
      position: absolute;
      top: -3px;
      right: -2px;
      font-size: small;
      padding-top: .2rem;
      width: 1.5rem;
      height: 1.5rem;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    #dueBadge[data-count="0"] {
      display: none;
    }

    li.user-dropdown {
      transition: opacity 0.1s ease-in-out;
    }

    li.user-dropdown:not(.open):hover {
      opacity: 0.5;
    }
  </style>

</head>

<body class="">
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
          <?php
          include '../class/config/config.php';
          $sql = $conn->prepare("SELECT * FROM system_info ");
          $sql->execute();
          $fetch = $sql->fetchAll();
          foreach ($fetch as $key => $value) {
            echo $value['system_info'];
          }
          ?>
        </a>
        <ul class="user-menu">
          <li class="dropdown pull-right user-dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <svg class="glyph stroked male-user" style="margin-right: 5px !important;">
                <use xlink:href="#stroked-male-user"></use>
              </svg>

              <span> <?= $_SESSION['admin_name']; ?></span>
              <span class="caret" style="transform: translateX(3px);"></span>
            </a>
            <ul class="dropdown-menu" role="menu" style="transform: translateY(5px)">
              <li>
                <a href="user_profile">
                  <svg class="glyph stroked male-user">
                    <use xlink:href="#stroked-male-user"></use>
                  </svg>
                  <span>Profile</span>
                </a>
              </li>
              <li>
                <a href="../class/logout/logout">
                  <svg class="glyph stroked cancel">
                    <use xlink:href="#stroked-cancel"></use>
                  </svg>
                  <span>Logout</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="dropdown pull-right notification">
            <div id="notification-bell" class="dropdown-toggle" data-toggle="dropdown">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell-icon lucide-bell">
                <path d="M10.268 21a2 2 0 0 0 3.464 0" />
                <path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326" />
              </svg>

              <div id="dueBadge" data-count="0"></div>
            </div>
            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="borrow">
                  <span id="dueBorrow" class="badge" style="background: red;"></span> - Borrow Due
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>