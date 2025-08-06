<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid']) == 0) {
  header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Scholarship Management System || Manage Scheme</title>
  <!-- loader-->
  <link href="../assets/css/pace.min.css" rel="stylesheet"/>
  <script src="../assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="../assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="../assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="../assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="../assets/css/app-style.css" rel="stylesheet"/>
  <!-- Custom CSS for buttons -->
  <style>
    .file-btn {
      display: inline-block;
      margin: 2px;
      font-size: 14px;
      text-align: center;
      padding: 5px 10px;
      border-radius: 4px;
    }
    .aadhar-btn { background-color: #007bff; color: #fff; }
    .tenth-btn { background-color: #28a745; color: #fff; }
    .twelfth-btn { background-color: #ffc107; color: #fff; }
    .aadhar-btn:hover { background-color: #0056b3; }
    .tenth-btn:hover { background-color: #218838; }
    .twelfth-btn:hover { background-color: #e0a800; }
  </style>
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner"><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

  <!--Start sidebar-wrapper-->
    <?php include_once('includes/sidebar.php');?>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<?php include_once('includes/header.php');?>
<!--End topbar header-->

<div class="clearfix"></div>
  
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Manage Scholarship Scheme</h5>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Application Number</th>
                      <th scope="col">Name of Scheme</th>
                      <th scope="col">Full Name</th>
                      <th scope="col">Mobile Number</th>
                      <th scope="col">Apply Date</th>
                      <th scope="col">Aadhar Card</th>
                      <th scope="col">10th Marks Card</th>
                      <th scope="col">12th Marks Card</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$sql = "SELECT * FROM apply";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

$cnt = 1;
if ($query->rowCount() > 0) {
  foreach ($results as $row) {
?>
                    <tr>
                        <td><?php echo htmlentities($cnt); ?></td>
                        <td><?php echo htmlentities($row->ApplicationNumber); ?></td>
                        <td><?php echo htmlentities($row->SchemeName); ?></td>
                        <td><?php echo htmlentities($row->FullName); ?></td>
                        <td><?php echo htmlentities($row->MobileNumber); ?></td>
                        <td><?php echo htmlentities($row->RegistrationDate); ?></td>
                        <td>
                          <a href="http://localhost/scholarshipms/users/uploads/<?php echo htmlentities($row->AadharCard); ?>" class="file-btn aadhar-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="View Aadhar Card">Aadhar Card</a>
                        </td>
                        <td>
                          <a href="http://localhost/scholarshipms/users/uploads/<?php echo htmlentities($row->TenthMarksCard); ?>" class="file-btn aadhar-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="View 10th Marks Card">10th Marks</a>
                        </td>
                        <td>
                          <a href="http://localhost/scholarshipms/users/uploads/<?php echo htmlentities($row->TwelfthMarksCard); ?>" class="file-btn aadhar-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="View 12th Marks Card">12th Marks</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" onclick="updateStatus('<?php echo $row->ApplicationNumber; ?>', 'Approved')">Approve</button>
                            <a href="verify.php"><button type="button" class="btn btn-warning btn-sm" >Verify</button></a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="updateStatus('<?php echo $row->ApplicationNumber; ?>', 'Rejected')">Reject</button>
                        </td>
                    </tr>
                    <?php $cnt = $cnt + 1; } } ?> 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div><!--End Row-->
    
    <!--start overlay-->
      <div class="overlay toggle-menu"></div>
    <!--end overlay-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
  
  <!--Start footer-->

  <!--End footer-->
  
  <!--start color switcher-->
   <?php include_once('includes/color-switcher.php'); ?>
  <!--end color switcher-->
   
  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  
  <!-- simplebar js -->
  <script src="../assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="../assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="../assets/js/app-script.js"></script>

   <script>
  function updateStatus(applicationNumber, status) {
      $.ajax({
          url: 'update_status.php',
          type: 'POST',
          data: { applicationNumber: applicationNumber, status: status },
          success: function(response) {
              alert(response);
              location.reload();
          },
          error: function() {
              alert('An error occurred while updating the status.');
          }
      });
  }
  </script>
  
</body>
</html>
<?php } ?>
