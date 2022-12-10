<?php include("header.php");
    // include("../auth_admin.php");
    // include("../dbConnect.php");
    // $employee_name = $_SESSION['employee_name'];
    // $email = $_SESSION['email'];
    // $phone = $_SESSION['phone'];
    // $employeeid = $_SESSION['id'];
    $id = $_GET['id'];
    $conn = connect();
    $query = mysqli_query($conn, "SELECT Contact_Name,Operator_id,Operator_Login_Id,Operator_Password FROM OPERATOR WHERE Operator_Id = '".san_sqli(1, $id,$conn)."'");
    close($conn);
    $data = mysqli_fetch_array($query,MYSQLI_ASSOC);
    $name = $data['Contact_Name'];
    $Operator_id = $data['Operator_id'];
    $user_id = $data['Operator_Login_Id'];
    $user_pass = $data['Operator_Password'];
    $user_type = 'webadmin';
    $permission = '{"permissions":{"dashboard":"dashboard","dashboard_collection_amount":"dashboard_collection_amount","dashboard_daily_collection":"dashboard_daily_collection","dashboard_due_amount":"dashboard_due_amount","dashboard_complaints":"dashboard_complaints","dashboard_expairy_report":"dashboard_expairy_report","dashboard_list_agent":"dashboard_list_agent","dashboard_collection_trends":"dashboard_collection_trends","add_customer":"add_customer","quick_view":"quick_view","add_subscription":"add_subscription","view_subscription":"view_subscription","view_a_la_carte_subscription":"view_a_la_carte_subscription","subscription_report":"subscription_report","prepaid_pack_request":"prepaid_pack_request","subscription_expiry":"subscription_expiry","current_month_renewed_report":"current_month_renewed_report","auto_renewal":"auto_renewal","add_area":"add_area","agent_area_mapping":"agent_area_mapping","technician_mapping":"technician_mapping","view_stb_details":"view_stb_details","stb_report":"stb_report","bill_generation":"bill_generation","complaints":"complaints","add_expenses":"add_expenses","view_expenses":"view_expenses","daily_collection_report":"daily_collection_report","monthly_collection_report":"monthly_collection_report","unpaid_customers_report":"unpaid_customers_report","gst_report":"gst_report","rebate_report":"rebate_report","excess_collection_report":"excess_collection_report","monthly_closure_report":"monthly_closure_report","counter_bill_report":"counter_bill_report","training_videos":"training_videos","tech_support":"tech_support","users":"users","activity_logs":"activity_logs","manage_roles":"manage_roles","transaction_delete":"transaction_delete","rebate_customer":"rebate_customer","view_cust":"view_cust","counter_item":"counter_item"}}';
    $permission1 = '{"permissions":{"dashboard":"dashboard","dashboard_collection_amount":"dashboard_collection_amount","dashboard_daily_collection":"dashboard_daily_collection","dashboard_due_amount":"dashboard_due_amount","dashboard_complaints":"dashboard_complaints","dashboard_expairy_report":"dashboard_expairy_report","dashboard_list_agent":"dashboard_list_agent","dashboard_collection_trends":"dashboard_collection_trends","add_customer":"add_customer","quick_view":"quick_view","add_subscription":"add_subscription","view_subscription":"view_subscription","view_a_la_carte_subscription":"view_a_la_carte_subscription","subscription_report":"subscription_report","prepaid_pack_request":"prepaid_pack_request","subscription_expiry":"subscription_expiry","current_month_renewed_report":"current_month_renewed_report","auto_renewal":"auto_renewal","add_area":"add_area","agent_area_mapping":"agent_area_mapping","technician_mapping":"technician_mapping","view_stb_details":"view_stb_details","stb_report":"stb_report","complaints":"complaints","add_expenses":"add_expenses","view_expenses":"view_expenses","daily_collection_report":"daily_collection_report","monthly_collection_report":"monthly_collection_report","unpaid_customers_report":"unpaid_customers_report","gst_report":"gst_report","rebate_report":"rebate_report","excess_collection_report":"excess_collection_report","monthly_closure_report":"monthly_closure_report","counter_bill_report":"counter_bill_report","training_videos":"training_videos","tech_support":"tech_support","activity_logs":"activity_logs"}}';
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
                        Maigret Operator Data 
                    </div>
                    <div class="card-body">
                        <?php 
                        $conn =connect();
                        $sql = mysqli_query($conn," SELECT count(*)as agent_count from AGENT WHERE AGENT_LOGIN_ID='$user_id'");
                        $count_login = mysqli_fetch_array($sql,MYSQLI_ASSOC);
                        if ($count_login['agent_count']>=1) {
                           echo "<div class='alert alert-danger' role='alert'>
                                 Login Id is already existed in Agent table Please modify this Id-> $user_id
                              </div>";
                        }else{
                            $insert_agent_query = mysqli_query($conn,"INSERT INTO AGENT(Name,Operator_id,USER_TYPE,AGENT_LOGIN_ID,AGENT_PASSWD)VALUE('$name','$Operator_id','$user_type','$user_id','$user_pass')");
                            $sql = mysqli_query($conn," SELECT count(*)as Operator_count from ROLES WHERE Operator_id=$Operator_id");
                            $count_operator = mysqli_fetch_array($sql,MYSQLI_ASSOC);
                            if ($count_operator['Operator_count']>=3) {
                                if ($insert_agent_query) {
                                    $conn = connect();
                                    $fetch_agent_query = mysqli_query($conn, "SELECT Agent_Id,USER_TYPE,AGENT_PASSWD,AGENT_LOGIN_ID FROM AGENT WHERE OPERATOR_ID ='$Operator_id'");
                                    close($conn);
                                    while ($agent_data = mysqli_fetch_array($fetch_agent_query,MYSQLI_ASSOC)) {
                                        $agent_id = $agent_data['Agent_Id'];
                                        $agent_user_id = $agent_data['AGENT_LOGIN_ID'];
                                        $agent_user_pass = $agent_data['AGENT_PASSWD'];
                                        $user_type = $agent_data['USER_TYPE'];

                                        if ($user_type == 'webadmin') {
                                            $conn = connect();
                                            $fetch_role_query = mysqli_query($conn, "SELECT ROLE_ID FROM ROLES WHERE OPERATOR_ID ='$Operator_id' AND ROLE_NAME ='Admin'");
                                            close($conn);
                                            $role_data = mysqli_fetch_array($fetch_role_query,MYSQLI_ASSOC);
                                            $role_id = $role_data['ROLE_ID'];
                                            $conn = connect();
                                            $test_id=mysqli_query($conn, "SELECT count(*) as role_id_count FROM ROLE_USER WHERE USER_ID ='$user_id' ");
                                            close($conn);
                                            $role_id_count = mysqli_fetch_array($test_id,MYSQLI_ASSOC);
                                            if ($role_id_count['role_id_count']>=1) {
                                                echo "<div class='alert alert-danger' role='alert'>
                                                    Login Id is already existed in ROLE_USER table Please modify this Id-> $user_id
                                                </div>";
                                            }else{
                                                $conn = connect();
                                                $role_admin = mysqli_query($conn,"INSERT INTO ROLE_USER(USER_ID, PASSWORD, ASSIGNED_ROLE, AGENT_ID, USER_TYPE,Operator_id)VALUE('$user_id','$user_pass','$role_id','$agent_id','W','$Operator_id')");
                                                close($conn);
                                                echo "<div class='alert alert-success' role='alert'>
                                                    Operator Maigretted successfully...!
                                                </div>";
                                            }
                                        }else if($user_type == 'webuser'){
                                            $conn = connect();
                                            $fetch_role_query = mysqli_query($conn, "SELECT ROLE_ID FROM ROLES WHERE OPERATOR_ID ='$Operator_id' AND ROLE_NAME ='Supervisor'");
                                            close($conn);
                                            $role_data = mysqli_fetch_array($fetch_role_query,MYSQLI_ASSOC);
                                            $role_id = $role_data['ROLE_ID'];
                                            $conn = connect();
                                            $test_id=mysqli_query($conn, "SELECT count(*) as role_id_count FROM ROLE_USER WHERE USER_ID ='$agent_user_id' ");
                                            close($conn);
                                            $role_id_count = mysqli_fetch_array($test_id,MYSQLI_ASSOC);
                                            if ($role_id_count['role_id_count']>=1) {
                                                echo "<div class='alert alert-danger' role='alert'>
                                                    Login Id is already existed in ROLE_USER table Please modify this Id-> $user_id
                                                </div>";
                                            }else{
                                                $conn = connect();
                                                $role_superuser = mysqli_query($conn,"INSERT INTO ROLE_USER(USER_ID, PASSWORD, ASSIGNED_ROLE, AGENT_ID, USER_TYPE,Operator_id)VALUE('$agent_user_id','$agent_user_pass','$role_id','$agent_id','W','$Operator_id')");
                                                close($conn);
                                                echo "<div class='alert alert-success' role='alert'>
                                                    Operator Maigretted successfully...!
                                                </div>";
                                            }
                                        }else if($user_type == 'Mobileuser'){
                                            $conn = connect();
                                            $fetch_role_query = mysqli_query($conn, "SELECT ROLE_ID FROM ROLES WHERE OPERATOR_ID ='$Operator_id' AND ROLE_NAME ='Mobile'");
                                            close($conn);
                                            $role_data = mysqli_fetch_array($fetch_role_query,MYSQLI_ASSOC);
                                            $role_id = $role_data['ROLE_ID'];
                                            $conn = connect();
                                            $test_id=mysqli_query($conn, "SELECT count(*) as role_id_count FROM ROLE_USER WHERE USER_ID ='$agent_user_id' ");
                                            close($conn);
                                            $role_id_count = mysqli_fetch_array($test_id,MYSQLI_ASSOC);
                                            if ($role_id_count['role_id_count']>=1) {
                                                echo "<div class='alert alert-danger' role='alert'>
                                                    Login Id is already existed in ROLE_USER table Please modify this Id-> $user_id
                                                </div>";
                                            }else{
                                                $conn = connect();
                                                $role_agent = mysqli_query($conn,"INSERT INTO ROLE_USER(USER_ID, PASSWORD, ASSIGNED_ROLE, AGENT_ID, USER_TYPE,Operator_id)VALUE('$agent_user_id','$agent_user_pass','$role_id','$agent_id','M','$Operator_id')");
                                                close($conn);
                                                echo "<div class='alert alert-success' role='alert'>
                                                    Operator Maigretted successfully...!
                                                </div>";
                                            }
                                        }
                                    }
                                }else{
                                    echo "<div class='alert alert-danger' role='alert'>
                                        Something went wrong please contact development team...!
                                    </div>";
                                }
                            }else{
                                $insert_role_query = mysqli_query($conn,"INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME,ROLE_PERMISSION)VALUE('$Operator_id','Admin','$permission')");
                                $insert_role_query = mysqli_query($conn,"INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME)VALUE('$Operator_id','Mobile')");
                                $insert_role_query = mysqli_query($conn,"INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME,ROLE_PERMISSION)VALUE('$Operator_id','Supervisor','$permission1')");
                                close($conn);
                                if ($insert_agent_query) {
                                    $conn = connect();
                                    $fetch_agent_query = mysqli_query($conn, "SELECT Agent_Id,USER_TYPE,AGENT_PASSWD,AGENT_LOGIN_ID FROM AGENT WHERE OPERATOR_ID ='$Operator_id'");
                                    close($conn);
                                    while ($agent_data = mysqli_fetch_array($fetch_agent_query,MYSQLI_ASSOC)) {
                                        $agent_id = $agent_data['Agent_Id'];
                                        $agent_user_id = $agent_data['AGENT_LOGIN_ID'];
                                        $agent_user_pass = $agent_data['AGENT_PASSWD'];
                                        $user_type = $agent_data['USER_TYPE'];

                                        if ($user_type == 'webadmin') {
                                            $conn = connect();
                                            $fetch_role_query = mysqli_query($conn, "SELECT ROLE_ID FROM ROLES WHERE OPERATOR_ID ='$Operator_id' AND ROLE_NAME ='Admin'");
                                            close($conn);
                                            $role_data = mysqli_fetch_array($fetch_role_query,MYSQLI_ASSOC);
                                            $role_id = $role_data['ROLE_ID'];
                                            $conn = connect();
                                            $test_id=mysqli_query($conn, "SELECT count(*) as role_id_count FROM ROLE_USER WHERE USER_ID ='$user_id' ");
                                            close($conn);
                                            $role_id_count = mysqli_fetch_array($test_id,MYSQLI_ASSOC);
                                            if ($role_id_count['role_id_count']>=1) {
                                                echo "<div class='alert alert-danger' role='alert'>
                                                    Login Id is already existed in ROLE_USER table Please modify this Id-> $user_id
                                                </div>";
                                            }else{
                                                $conn = connect();
                                                $admin = mysqli_query($conn,"INSERT INTO ROLE_USER(USER_ID, PASSWORD, ASSIGNED_ROLE, AGENT_ID, USER_TYPE,Operator_id)VALUE('$user_id','$user_pass','$role_id','$agent_id','W','$Operator_id')");
                                                close($conn);
                                                echo "<div class='alert alert-success' role='alert'>
                                                    Operator Maigretted successfully...!
                                                </div>";
                                            }
                                            
                                        }else if($user_type == 'webuser'){
                                            $conn = connect();
                                            $fetch_role_query = mysqli_query($conn, "SELECT ROLE_ID FROM ROLES WHERE OPERATOR_ID ='$Operator_id' AND ROLE_NAME ='Supervisor'");
                                            close($conn);
                                            $role_data = mysqli_fetch_array($fetch_role_query,MYSQLI_ASSOC);
                                            $role_id = $role_data['ROLE_ID'];
                                            $conn = connect();
                                            $test_id=mysqli_query($conn, "SELECT count(*) as role_id_count FROM ROLE_USER WHERE USER_ID ='$agent_user_id' ");
                                            close($conn);
                                            $role_id_count = mysqli_fetch_array($test_id,MYSQLI_ASSOC);
                                            if ($role_id_count['role_id_count']>=1) {
                                                echo "<div class='alert alert-danger' role='alert'>
                                                    Login Id is already existed in ROLE_USER table Please modify this Id-> $user_id
                                                </div>";
                                            }else{
                                                $conn = connect();
                                                $superuser = mysqli_query($conn,"INSERT INTO ROLE_USER(USER_ID, PASSWORD, ASSIGNED_ROLE, AGENT_ID, USER_TYPE,Operator_id)VALUE('$agent_user_id','$agent_user_pass','$role_id','$agent_id','W','$Operator_id')");
                                                close($conn);
                                                echo "<div class='alert alert-success' role='alert'>
                                                    Operator Maigretted successfully...!
                                                </div>";
                                            }
                                        }else if($user_type == 'Mobileuser'){
                                            $conn = connect();
                                            $fetch_role_query = mysqli_query($conn, "SELECT ROLE_ID FROM ROLES WHERE OPERATOR_ID ='$Operator_id' AND ROLE_NAME ='Mobile'");
                                            close($conn);
                                            $role_data = mysqli_fetch_array($fetch_role_query,MYSQLI_ASSOC);
                                            $role_id = $role_data['ROLE_ID'];
                                            $conn = connect();
                                            $test_id=mysqli_query($conn, "SELECT count(*) as role_id_count FROM ROLE_USER WHERE USER_ID ='$agent_user_id' ");
                                            close($conn);
                                            $role_id_count = mysqli_fetch_array($test_id,MYSQLI_ASSOC);
                                            if ($role_id_count['role_id_count']>=1) {
                                                echo "<div class='alert alert-danger' role='alert'>
                                                    Login Id is already existed in ROLE_USER table Please modify this Id-> $user_id
                                                </div>";
                                            }else{
                                                $conn = connect();
                                                $agent = mysqli_query($conn,"INSERT INTO ROLE_USER(USER_ID, PASSWORD, ASSIGNED_ROLE, AGENT_ID, USER_TYPE,Operator_id)VALUE('$agent_user_id','$agent_user_pass','$role_id','$agent_id','M','$Operator_id')");
                                                close($conn);
                                                echo "<div class='alert alert-success' role='alert'>
                                                    Operator Maigretted successfully...!
                                                </div>";
                                            }
                                        }
                                    }
                                }else{
                                    echo "<div class='alert alert-danger' role='alert'>
                                        Something went wrong please contact development team...!
                                    </div>";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("footer.php"); ?>
<script>
  $(document).ready(function() {
      waitingDialog.show('Loading Please wait ...');
      setTimeout(function () {
        waitingDialog.hide();
      }, 4000);
  });
</script>