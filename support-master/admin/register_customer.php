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
                        Register Customer Using Upload
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="post" action="register_customer.php" role="form" name="myForm" id="expenseForm" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card-header">
                                                <input type="file" name="Upload_file" class="form-control" accept=".csv">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card-header">
                                                <input type="type" class="form-control"  name="Operator_Id" placeholder="Enter Operator Id"required> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" name="submit" class="btn btn-secondary btn-block btn-lg float-right" style="margin-top:1%;">Upload CSV Data</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php 
                            try {
                                    if (isset($_POST['submit'])) {
                                    $Operator_Id=$_POST['Operator_Id'];
                                    $conn = connect();
                                     mysqli_set_charset($conn,'utf8');
                                    $deleted = mysqli_query($conn,"DELETE FROM staging_support WHERE owner_id = '".san_sqli(1, $Operator_Id)."'");
                                    close($conn);
                                    $file = $_FILES['Upload_file']['tmp_name'];
                                    $handle = fopen($file, "r");
                                    if ($file == NULL) {
                                        error(_('Please select a file to import'));
                                        header("Location:register_customer.php");
                                    }else{
                                        $query_insert = array();
                                        while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                                            if ($filesop[0] != 'derived_id' && $filesop[0] != 'customer_id' && $filesop[0] != 'full_name' && $filesop[0] != 'alias_name' && $filesop[0] != 'address1' && $filesop[0] != 'phone' && $filesop[0] != 'email' && $filesop[0] != 'agent_name' && $filesop[0] != 'area_name' && $filesop[0] != 'city' && $filesop[0] != 'state' && $filesop[0] != 'stb_number' && $filesop[0] != 'stb_vc_number' && $filesop[0] != 'stb_serial_number' && $filesop[0] != 'GSTIN' && $filesop[0] != 'pack_name' && $filesop[0] != 'pack_type' && $filesop[0] != 'pack_price'  && $filesop[0] != 'pack_gst' && $filesop[0] != 'service_status' && $filesop[0] != 'balanace' && $filesop[0] != 'product_start_date' && $filesop[0] != 'owner_id' && $filesop[0] != 'udf1' && $filesop[0] != 'udf2') {

                                                $query_insert[] = "('{$filesop[0]}','{$filesop[1]}','{$filesop[2]}','{$filesop[3]}','$filesop[4]','$filesop[5]','$filesop[6]','$filesop[7]','$filesop[8]','$filesop[9]','$filesop[10]','$filesop[11]','$filesop[12]','$filesop[13]','$filesop[14]','$filesop[15]','$filesop[16]','$filesop[17]','$filesop[18]','$filesop[19]','$filesop[20]','$filesop[21]','$filesop[22]','$filesop[23]','$filesop[24]')";
                                            }
                                        }
                                        if (count($query_insert)>0) {
                                           $query_insert_string = implode(',', $query_insert);
                                            $conn = connect();
                                              mysqli_set_charset($conn,'utf8');
                                            $insertAgent = mysqli_query ($conn, "INSERT INTO staging_support (derived_id, customer_id, full_name, alias_name, address1, phone, email, agent_name, area_name, city, state, stb_number, stb_vc_number, stb_serial_number, GSTIN, pack_name, pack_type, pack_price, pack_gst, service_status, balanace, product_start_date, owner_id, udf1, udf2) VALUES {$query_insert_string} ");
                                            if ($insertAgent) {?>
                                                <button type="button" class="btn btn-info btn-md float-right align-top active" data-toggle="modal" data-target=".bd-example-modal-xl" style="margin-top:20%;">Verify Data uploaded</button>

                                                <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="card mb-3">
                                                                <div class="card-header">
                                                                    <i class="fas fa-table"></i>
                                                                    Customer Upload Data
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Derived ID</th>
                                                                                    <th>Customer ID</th>
                                                                                    <th>Name</th>
                                                                                    <th>Alias Name</th>
                                                                                    <th>Address</th>
                                                                                    <th>Phone</th>
                                                                                    <th>Email</th>
                                                                                    <th>Agent Name</th>
                                                                                    <th>Area Name</th>
                                                                                    <th>City</th>
                                                                                    <th>State</th>
                                                                                    <th>STB Number</th>
                                                                                    <th>STB VC Number</th>
                                                                                    <th>STB Serial Number</th>
                                                                                    <th>GSTIN</th>
                                                                                    <th>Pack Name</th>
                                                                                    <th>Pack Type</th>
                                                                                    <th>Pack Price</th>
                                                                                    <th>Pack GST</th>
                                                                                    <th>Service Status</th>
                                                                                    <th>Balanace</th>
                                                                                    <th>Product Start Date</th>
                                                                                    <th>Owner ID</th>
                                                                                    <th>UDF1</th>
                                                                                    <th>UDF2</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            
                                                                            <?php 
                                                                                $conn = connect();
                                                                                   mysqli_set_charset($conn,'utf8');
                                                                                $query = mysqli_query($conn, "SELECT derived_id, customer_id, full_name, alias_name, address1, phone, email, agent_name, area_name, city, state, stb_number, stb_vc_number, stb_serial_number, GSTIN, pack_name, pack_type, pack_price, pack_gst, service_status, balanace, product_start_date, owner_id, udf1, udf2 FROM staging_support where owner_id = '".san_sqli(1, $Operator_Id)."'");
                                                                                close($conn);
                                                                                while ($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                                                                                    echo '<tr>
                                                                                            <td>'.$fetch['derived_id'].'</td>
                                                                                            <td>'.$fetch['customer_id'].'</td>
                                                                                            <td>'.$fetch['full_name'].'</td>
                                                                                            <td>'.$fetch['alias_name'].'</td>
                                                                                            <td>'.$fetch['address1'].'</td>
                                                                                            <td>'.$fetch['phone'].'</td>
                                                                                            <td>'.$fetch['email'].'</td>
                                                                                            <td>'.$fetch['agent_name'].'</td>
                                                                                            <td>'.$fetch['area_name'].'</td>
                                                                                            <td>'.$fetch['city'].'</td>
                                                                                            <td>'.$fetch['state'].'</td>
                                                                                            <td>'.$fetch['stb_number'].'</td>
                                                                                            <td>'.$fetch['stb_vc_number'].'</td>
                                                                                            <td>'.$fetch['stb_serial_number'].'</td>
                                                                                            <td>'.$fetch['GSTIN'].'</td>
                                                                                            <td>'.$fetch['pack_name'].'</td>
                                                                                            <td>'.$fetch['pack_type'].'</td>
                                                                                            <td>'.$fetch['pack_price'].'</td>
                                                                                            <td>'.$fetch['pack_gst'].'</td>
                                                                                            <td>'.$fetch['service_status'].'</td>
                                                                                            <td>'.$fetch['balanace'].'</td>
                                                                                            <td>'.$fetch['product_start_date'].'</td>
                                                                                            <td>'.$fetch['owner_id'].'</td>
                                                                                            <td>'.$fetch['udf1'].'</td>
                                                                                            <td>'.$fetch['udf2'].'</td>
                                                                                         </tr>';
                                                                                }
                                                                            ?> 
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="col-md-6">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <a href="filter_cust_details.php?id=<?php echo $Operator_Id;?>" type="submit" name="submit" class="btn btn-dark float-right">Next</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php   }
                                            close($conn);
                                        }
                                    }
                                }
                            }catch (Exception $e) {
                                close($conn);
                                errorPage();
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("footer.php"); ?>