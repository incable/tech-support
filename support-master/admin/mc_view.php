<?php include("header.php");
// include("../auth_admin.php");
// include("../dbConnect.php");
// $employee_name = $_SESSION['employee_name'];
// $email = $_SESSION['email'];
// $phone = $_SESSION['phone'];
// $employeeid = $_SESSION['id'];
?>
<style>
  .dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
  }

  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content a:hover {
    background-color: #ddd;
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  .dropdown:hover .dropbtn {
    background-color: #3e8e41;
  }
</style>

<body id="page-top">
  <div id="wrapper">
    <?php include("sidemenu.php"); ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- DataTables Example -->
        <div class="card text-dark bg-light mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Active/InActive Operators
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>OPERATOR ID</th>
                    <th>NAME</th>
                    <th>BALANCE</th>
                    <th>PHONE</th>
                    <th>STATUS</th>
                    <th>DISABLED</th>
                    <th>ACTIONS</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $conn = connect();
                  $query = mysqli_query($conn, "SELECT Operator_Id,customer_name,bcy_balance,phone,Operator_Status,disabled_on from mc_owner_balance");
                  close($conn);
                  if ($_SESSION['role'] == 'admin') {
                    while ($fetch = mysqli_fetch_array($query, MYSQLI_ASSOC)) { //while start
                      if ($fetch['Operator_Status'] == 'InActive') {
                        echo '<tr class="text-danger font-weight-bold">
                                                    <td>' . $fetch['Operator_Id'] . '</td>
                                                    <td>' . $fetch['customer_name'] . '</td>
                                                    <td>' . $fetch['bcy_balance'] . '</td>
                                                    <td>' . $fetch['phone'] . '</td>
                                                    <td >' . $fetch['Operator_Status'] . '</td>
                                                    <td>' . $fetch['disabled_on'] . '</td>
                                                    <td>
                                                        <div class="container">
                                                          <div class="row" style="flex-wrap: unset;">
                                                            <button type="button" class="btn" data-toggle="modal" data-target="#myModal' . $fetch['Operator_Id'] . '">
                                                              <img src="assets/img/active.png" style="width:35px;" title="Active">
                                                            </button>
                                                            <div class="modal fade" id="myModal' . $fetch['Operator_Id'] . '" role="dialog">
                                                              <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <h4 class="modal-title">Change Status</h4>
                                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <form action="active_admin.php" method="post">
                                                                      <div class="row">
                                                                        <div class="col-md-6">
                                                                          <div class="form-group">
                                                                          <div class="col-md-6">
                                                                            <input type="hidden" class="form-control" id="op_id" name="opid" value="' . $fetch['Operator_Id'] . '">

                                                                              <input type="date" name="date">

                                                                          </div>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                          <div class="form-group float-right">
                                                                            <label>&nbsp</label>
                                                                            <div class="col-md-6">
                                                                              <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </form>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <a href="inactive.php?id=' . $fetch['Operator_Id'] . '">
                                                              <img src="assets/img/inactive.png" style="width:40px;margin-top:5px;" title="InActive">
                                                            </a>
                                                            
                                                            <button type="button" class="btn" data-toggle="modal" data-target="#myModal1' . $fetch['Operator_Id'] . '">
                                                              <img src="assets/img/complete.png" style="width:41px;" title="Completed">
                                                            </button>

                                                            <div class="modal fade" id="myModal1' . $fetch['Operator_Id'] . '" role="dialog" style="margin-top:15%;">
                                                              <div class="modal-dialog modal-sm">
                                                                <div class="modal-content"> 
                                                                  <div class="modal-body">
                                                                    <form action="completed.php" method="post">
                                                                    <h3>Confirm to Delete the Operator</h3>
                                                                      <div class="row">
                                                                        <div class="col-md-6">
                                                                          <div class="form-group">
                                                                            <label>&nbsp</label>
                                                                            <div class="col-md-6">
                                                                              <input type="hidden" class="form-control" id="op_id" name="opid" value="' . $fetch['Operator_Id'] . '">
                                                                              <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                          <div class="form-group float-right">
                                                                            <label>&nbsp</label>
                                                                            <div class="col-md-6">
                                                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </form>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </td> 
                                                    </tr>';
                      }
                      if ($fetch['Operator_Status'] == 'Active') {
                        echo '<tr class="text-black">
                                                    <td>' . $fetch['Operator_Id'] . '</td>
                                                    <td>' . $fetch['customer_name'] . '</td>
                                                    <td>' . $fetch['bcy_balance'] . '</td>
                                                    <td>' . $fetch['phone'] . '</td>
                                                    <td >' . $fetch['Operator_Status'] . '</td>
                                                    <td>' . $fetch['disabled_on'] . '</td>
                                                    <td>
                                                        <div class="container">
                                                          <div class="row" style="flex-wrap: unset;">
                                                            <button type="button" class="btn" data-toggle="modal" data-target="#myModal' . $fetch['Operator_Id'] . '">
                                                              <img src="assets/img/active.png" style="width:35px;" title="Active">
                                                            </button>
                                                            <div class="modal fade" id="myModal' . $fetch['Operator_Id'] . '" role="dialog">
                                                              <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <h4 class="modal-title">Change Status</h4>
                                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <form action="active_admin.php" method="post">
                                                                      <div class="row">
                                                                        <div class="col-md-6">
                                                                          <div class="form-group">
                                                                          <label>Select Days:</label>
                                                                          <div class="col-md-6">
                                                                            <input type="hidden" class="form-control" id="op_id" name="opid" value="' . $fetch['Operator_Id'] . '">
                                                                            <input type="date" name="date">

                                                                          </div>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                          <div class="form-group float-right">
                                                                            <label>&nbsp</label>
                                                                            <div class="col-md-6">
                                                                              <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </form>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <a href="inactive.php?id=' . $fetch['Operator_Id'] . '">
                                                              <img src="assets/img/inactive.png" style="width:40px;margin-top:5px;" title="InActive">
                                                            </a>
                                                            <button type="button" class="btn" data-toggle="modal" data-target="#myModal1' . $fetch['Operator_Id'] . '">
                                                              <img src="assets/img/complete.png" style="width:41px;" title="Completed">
                                                            </button>
                                                            <div class="modal fade" id="myModal1' . $fetch['Operator_Id'] . '" role="dialog" style="margin-top:15%;">
                                                              <div class="modal-dialog modal-sm">
                                                                <div class="modal-content"> 
                                                                  <div class="modal-body">
                                                                    <form action="completed.php" method="post">
                                                                    <h3>Confirm to Delete the Operator</h3>
                                                                      <div class="row">
                                                                        <div class="col-md-6">
                                                                          <div class="form-group">
                                                                            <label>&nbsp</label>
                                                                            <div class="col-md-6">
                                                                              <input type="hidden" class="form-control" id="op_id" name="opid" value="' . $fetch['Operator_Id'] . '">
                                                                              <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                          <div class="form-group float-right">
                                                                            <label>&nbsp</label>
                                                                            <div class="col-md-6">
                                                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </form>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </td> 
                                                    </tr>';
                      }
                    } // while end

                  } else {
                    // else part here
                    while ($fetch = mysqli_fetch_array($query, MYSQLI_ASSOC)) { //while start
                      if ($fetch['Operator_Status'] == 'InActive') {
                        echo '<tr class="text-danger font-weight-bold">
                                                    <td>' . $fetch['Operator_Id'] . '</td>
                                                    <td>' . $fetch['customer_name'] . '</td>
                                                    <td>' . $fetch['bcy_balance'] . '</td>
                                                    <td>' . $fetch['phone'] . '</td>
                                                    <td >' . $fetch['Operator_Status'] . '</td>
                                                    <td>' . $fetch['disabled_on'] . '</td>
                                                    <td>
                                                        <div class="container">
                                                          <div class="row" style="flex-wrap: unset;">
                                                            <button type="button" class="btn" data-toggle="modal" data-target="#myModal' . $fetch['Operator_Id'] . '">
                                                              <img src="assets/img/active.png" style="width:35px;" title="Active">
                                                            </button>
                                                            <div class="modal fade" id="myModal' . $fetch['Operator_Id'] . '" role="dialog">
                                                              <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <h4 class="modal-title">Change Status</h4>
                                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <form action="active.php" method="post">
                                                                      <div class="row">
                                                                        <div class="col-md-6">
                                                                          <div class="form-group">
                                                                            <label>Select Days:</label>
                                                                            <div class="col-md-6">
                                                                              <input type="hidden" class="form-control" id="op_id" name="opid" value="' . $fetch['Operator_Id'] . '">

                                                                              



                                                                              <select name="date" id="date">
                                                                              <option value="0">Select Days</option>
                                                                                  <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="5">5</option>
                                                                                  
                                                                                  </select>

                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                          <div class="form-group float-right">
                                                                            <label>&nbsp</label>
                                                                            <div class="col-md-6">
                                                                              <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </form>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <a href="inactive.php?id=' . $fetch['Operator_Id'] . '">
                                                              <img src="assets/img/inactive.png" style="width:40px;margin-top:5px;" title="InActive">
                                                            </a>
                                                            
                                                           

                                                            <div class="modal fade" id="myModal1' . $fetch['Operator_Id'] . '" role="dialog" style="margin-top:15%;">
                                                              <div class="modal-dialog modal-sm">
                                                                <div class="modal-content"> 
                                                                  <div class="modal-body">
                                                                    <form action="completed.php" method="post">
                                                                    <h3>Confirm to Delete the Operator</h3>
                                                                      <div class="row">
                                                                        <div class="col-md-6">
                                                                          <div class="form-group">
                                                                            <label>&nbsp</label>
                                                                            <div class="col-md-6">
                                                                              <input type="hidden" class="form-control" id="op_id" name="opid" value="' . $fetch['Operator_Id'] . '">
                                                                              <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                          <div class="form-group float-right">
                                                                            <label>&nbsp</label>
                                                                            <div class="col-md-6">
                                                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </form>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </td> 
                                                    </tr>';
                      }
                      if ($fetch['Operator_Status'] == 'Active') {
                        echo '<tr class="text-black">
                                                    <td>' . $fetch['Operator_Id'] . '</td>
                                                    <td>' . $fetch['customer_name'] . '</td>
                                                    <td>' . $fetch['bcy_balance'] . '</td>
                                                    <td>' . $fetch['phone'] . '</td>
                                                    <td >' . $fetch['Operator_Status'] . '</td>
                                                    <td>' . $fetch['disabled_on'] . '</td>
                                                    <td>
                                                        <div class="container">
                                                          <div class="row" style="flex-wrap: unset;">
                                                            <button type="button" class="btn" data-toggle="modal" data-target="#myModal' . $fetch['Operator_Id'] . '">
                                                              <img src="assets/img/active.png" style="width:35px;" title="Active">
                                                            </button>
                                                            <div class="modal fade" id="myModal' . $fetch['Operator_Id'] . '" role="dialog">
                                                              <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <h4 class="modal-title">Change Status</h4>
                                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <form action="active.php" method="post">
                                                                      <div class="row">
                                                                        <div class="col-md-6">
                                                                          <div class="form-group">
                                                                          <label>Select Days:</label>
                                                                          <div class="col-md-6">
                                                                            <input type="hidden" class="form-control" id="op_id" name="opid" value="' . $fetch['Operator_Id'] . '">

                                                                            



                                                                            <select name="date" id="date">
                                                                            <option value="0">Select Days</option>
                                                                                <option value="1">1</option>
                                                                                  <option value="2">2</option>
                                                                                  <option value="3">3</option>
                                                                                  <option value="4">4</option>
                                                                                  <option value="5">5</option>
                                                                                
                                                                                </select>

                                                                          </div>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                          <div class="form-group float-right">
                                                                            <label>&nbsp</label>
                                                                            <div class="col-md-6">
                                                                              <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </form>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <a href="inactive.php?id=' . $fetch['Operator_Id'] . '">
                                                              <img src="assets/img/inactive.png" style="width:40px;margin-top:5px;" title="InActive">
                                                            </a>
                                                           
                                                            <div class="modal fade" id="myModal1' . $fetch['Operator_Id'] . '" role="dialog" style="margin-top:15%;">
                                                              <div class="modal-dialog modal-sm">
                                                                <div class="modal-content"> 
                                                                  <div class="modal-body">
                                                                    <form action="completed.php" method="post">
                                                                    <h3>Confirm to Delete the Operator</h3>
                                                                      <div class="row">
                                                                        <div class="col-md-6">
                                                                          <div class="form-group">
                                                                            <label>&nbsp</label>
                                                                            <div class="col-md-6">
                                                                              <input type="hidden" class="form-control" id="op_id" name="opid" value="' . $fetch['Operator_Id'] . '">
                                                                              <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                          <div class="form-group float-right">
                                                                            <label>&nbsp</label>
                                                                            <div class="col-md-6">
                                                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                    </form>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </td> 
                                                    </tr>';
                      }
                    } // while end
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