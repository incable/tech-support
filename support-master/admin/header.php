<?php
    include("../auth_admin.php");
    include("../dbConnect.php");
    include("../includes_wap/wap.php");
    $employee_name = $_SESSION['employee_name'];
    $email = $_SESSION['email'];
    $phone = $_SESSION['phone'];
    $employeeid = $_SESSION['id'];
    $conn = connect();
    $selectfeedback =  mysqli_query($conn, "SELECT count(*) as counts FROM feedback ");
    $feedback = mysqli_fetch_array($selectfeedback,MYSQLI_ASSOC);
    $select_employee = mysqli_query($conn, "SELECT count(assigned_to) AS counts,assigned_to from complaint_to_mobiezy where assigned_to = '$employeeid' AND (complaint_status = 'registered' OR complaint_status = 'viewed' )");
    $data = mysqli_fetch_array($select_employee,MYSQLI_ASSOC);
   //echo $data['counts'];
   
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Mobiezy.Tech.Support</title>
  <link rel="icon" href="assets/img/title1.png" type="image/gif" sizes="16x16">
  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">


  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="dashboard.php"> <img src="assets/img/mobiezy-logo.png" width="170px;"> </a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1" title="Pending Instamojo Transaction Counts">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="badge badge-warning" style="font-size: 12px;" id="num">
            +
          </span>
          <img src="assets/img/pending.png" width="20px">
        </a>
        <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="duplicate_type_1.php">FeedBack</a>
        </div> -->
      </li>
      <li class="nav-item dropdown no-arrow mx-1" title="FeedBack">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="badge badge-info" style="font-size: 12px;" id="num">
            +<?php echo $feedback['counts']; ?>
          </span>
          <img src="assets/img/feedback.png" width="20px">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="feedback.php">FeedBack</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1" title="Duplicates">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="badge badge-danger" style="font-size: 12px;">
            +9
          </span>
          <img src="assets/img/duplicate.png" width="20px">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="duplicate_type_1.php">Duplicates</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1" title="Complaints">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="badge badge-success" style="font-size: 12px;">+<?php echo $data['counts'];?>
          </span>
          <i class="fas fa-bell fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="find_complaint.php?id=<?php echo $data['assigned_to'];?>">Complaints</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow" title="Profile">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="profile.php?id=<?php echo $employeeid; ?>">Settings</a>
          <a class="dropdown-item" href="records.php?id=<?php echo $employeeid; ?>">Records</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>
  </nav>
</head>
<script src="assets/vendor/jquery/jquery.min.js"></script>

 