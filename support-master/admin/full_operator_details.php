<?php include("header.php");
    // include("../auth_admin.php");
    // include("../dbConnect.php");
    // $employee_name = $_SESSION['employee_name'];
    // $email = $_SESSION['email'];
    // $phone = $_SESSION['phone'];
    // $employeeid = $_SESSION['id'];
?>

<body id="page-top">
    <div id="wrapper">
    <?php include("sidemenu.php");?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- DataTables Example -->
                <div class="card text-dark bg-light mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        View Operators Details
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>OPERATOR ID</th>
                                        <th>COMPANY NAME</th>
                                        <th>LOGIN ID</th>
                                        <th>PASSWORD</th>
                                        <th>NAME</th>
                                        <th>NUMBER</th>
                                        <th>EMAIL ID</th>
                                        <th>CITY</th>
                                        <th>ACTIVE</th>
                                        <th>BILL TYPE</th>
                                        <th>REMINDER SMS</th>
                                        <th>MIGRATE STATUS</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                        $conn =connect();
                                        $query = mysqli_query($conn,"SELECT Operator_id,Operator_Comp_name,Operator_Login_Id,Operator_Password,Contact_Name,Contact_Number,Reminder_SMS,City,Active,Operator_Bill_Type,OP_Email_Id,MIGRATE_STATUS from OPERATOR where MSO_ID<>1");
                                        close($conn);
                                        while ($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                                            if ($fetch['Active'] == 'N') {
                                        	   echo '<tr>
                                        			  <td><center><a href="edit_operator.php?id='.$fetch['Operator_id'].'" title="Edit">'.$fetch['Operator_id'].'</a></center></td>
                                        			  <td>'.$fetch['Operator_Comp_name'].'</td>
                                                <td>'.$fetch['Operator_Login_Id'].'</td>
                                                <td>'.$fetch['Operator_Password'].'</td>
                                        			  <td>'.$fetch['Contact_Name'].'</td>
                                        			  <td>'.$fetch['Contact_Number'].'</td>
                                                <td>'.$fetch['OP_Email_Id'].'</td>
                                        			  <td>'.$fetch['City'].'</td>
                                        			  <td>
                                                        <center>
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm'.$fetch['Operator_id'].'">'.$fetch['Active'].'
                                                            </button>
                                                        </center>
                                                       
                                                        <div class="modal fade bd-example-modal-sm'.$fetch['Operator_id'].'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                 <form action="edit_operator_status.php?id='.$fetch['Operator_id'].'" method="post">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Modal title</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                     <select class="form-control" name="status">
                                                                        <option value="" disabled selected>Choose your option</option>
                                                                        <option value="Y">Active</option>
                                                                        <option value="N">InActive</option>
                                                                    </select>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary" name="change">Save changes</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                     </td>
                                        			  <td>'.$fetch['Operator_Bill_Type'].'</td>
                                                      <td>'.$fetch['Reminder_SMS'].'</td>
                                                      <td>'.$fetch['MIGRATE_STATUS'].'</td>
                                                      <td>
                                                        <div class="dropdown show">
                                                          <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                          </a>

                                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="register_complaint.php?id='.$fetch['Operator_id'].'">Register Complaint</a>
                                                            <a class="dropdown-item" href="maigret_operator.php?id='.$fetch['Operator_id'].'">Migrate Operator</a>
                                                          </div>
                                                        </div>
                                                        </td>
                                        	       </tr>';
                                               }
                                               if ($fetch['Active'] == 'Y') {
                                               echo '<tr>
                                                      <td><center><a href="edit_operator.php?id='.$fetch['Operator_id'].'" title="Edit">'.$fetch['Operator_id'].'</a></center></td>
                                                      <td>'.$fetch['Operator_Comp_name'].'</td>
                                                      <td>'.$fetch['Operator_Login_Id'].'</td>
                                                      <td>'.$fetch['Operator_Password'].'</td>
                                                      <td>'.$fetch['Contact_Name'].'</td>
                                                      <td>'.$fetch['Contact_Number'].'</td>
                                                      <td>'.$fetch['OP_Email_Id'].'</td>
                                                      <td>'.$fetch['City'].'</td>
                                                      <td>
                                                        <center>
                                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm'.$fetch['Operator_id'].'">'.$fetch['Active'].'
                                                            </button>
                                                        </center>
                                                       
                                                        <div class="modal fade bd-example-modal-sm'.$fetch['Operator_id'].'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                 <form action="edit_operator_status.php?id='.$fetch['Operator_id'].'" method="post">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Modal title</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                     <select class="form-control" name="status">
                                                                        <option value="" disabled selected>Choose your option</option>
                                                                        <option value="Y">Active</option>
                                                                        <option value="N">InActive</option>
                                                                    </select>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary" name="change">Save changes</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                     </td>
                                                      <td>'.$fetch['Operator_Bill_Type'].'</td>
                                                      <td>'.$fetch['Reminder_SMS'].'</td>
                                                      <td>'.$fetch['MIGRATE_STATUS'].'</td>
                                                      <td>
                                                        <div class="dropdown show">
                                                          <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                          </a>

                                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="register_complaint.php?id='.$fetch['Operator_id'].'">Register Complaint</a>
                                                            <a class="dropdown-item" href="maigret_operator.php?id='.$fetch['Operator_id'].'">Migrate Operator</a>
                                                          </div
                                                        </div>
                                                        </td>
                                                   </tr>';
                                               }
                                               if ($fetch['Active'] == 'X') {
                                               echo '<tr>
                                                      <td><center><a href="edit_operator.php?id='.$fetch['Operator_id'].'" title="Edit">'.$fetch['Operator_id'].'</a></center></td>
                                                      <td>'.$fetch['Operator_Comp_name'].'</td>
                                                      <td>'.$fetch['Operator_Login_Id'].'</td>
                                                      <td>'.$fetch['Operator_Password'].'</td>
                                                      <td>'.$fetch['Contact_Name'].'</td>
                                                      <td>'.$fetch['Contact_Number'].'</td>
                                                      <td>'.$fetch['OP_Email_Id'].'</td>
                                                      <td>'.$fetch['City'].'</td>
                                                      <td>
                                                        <center>
                                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm'.$fetch['Operator_id'].'">'.$fetch['Active'].'
                                                            </button>
                                                        </center>
                                                       
                                                        <div class="modal fade bd-example-modal-sm'.$fetch['Operator_id'].'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                 <form action="edit_operator_status.php?id='.$fetch['Operator_id'].'" method="post">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Modal title</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                     <select class="form-control" name="status">
                                                                        <option value="" disabled selected>Choose your option</option>
                                                                        <option value="Y">Active</option>
                                                                        <option value="N">InActive</option>
                                                                    </select>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary" name="change">Save changes</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                     </td>
                                                      <td>'.$fetch['Operator_Bill_Type'].'</td>
                                                      <td>'.$fetch['Reminder_SMS'].'</td>
                                                      <td>'.$fetch['MIGRATE_STATUS'].'</td>
                                                      <td>
                                                        <div class="dropdown show">
                                                          <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                          </a>

                                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="register_complaint.php?id='.$fetch['Operator_id'].'">Register Complaint</a>
                                                            <a class="dropdown-item" href="maigret_operator.php?id='.$fetch['Operator_id'].'">Migrate Operator</a>
                                                          </div>
                                                        </div>
                                                        </td>
                                                   </tr>';
                                               }
                                        }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
      </div>
  </div>
</body>
<?php include("footer.php"); ?>
