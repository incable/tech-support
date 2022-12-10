<?php
     require 'db.php';
    // include("../dbConnect.php");
   
 ini_set('max_execution_time', '3600');
 
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else
  {
     

          if(isset($_GET["submit"])){

        $networkName = $_GET["networkName"];
        $operatorName = $_GET["operatorName"];
        $phoneNumber = $_GET["phoneNumber"];
        $email = $_GET["email"];
        $city = $_GET["city"];
        $state = $_GET["state"];
        $lco_code = $_GET["lco_code"];
        $lco_id = $_GET["lco_id"];
        $login_id = $_GET["login_id"];
        $password = $_GET["password"];
          $sales = $_GET["sales"];
        $gst = $_GET["gst"];
        $sub_main_eligible=$_GET['sub_main_eligible'];
        $sub_main=$_GET['sub_main'];
        $mainop=$_GET['mainop'];

           $permission = '{"permissions":{"dashboard":"dashboard","dashboard_collection_amount":"dashboard_collection_amount","dashboard_daily_collection":"dashboard_daily_collection","dashboard_due_amount":"dashboard_due_amount","dashboard_complaints":"dashboard_complaints","dashboard_expairy_report":"dashboard_expairy_report","dashboard_list_agent":"dashboard_list_agent","dashboard_collection_trends":"dashboard_collection_trends","add_customer":"add_customer","quick_view":"quick_view","add_subscription":"add_subscription","view_subscription":"view_subscription","view_a_la_carte_subscription":"view_a_la_carte_subscription","subscription_report":"subscription_report","prepaid_pack_request":"prepaid_pack_request","subscription_expiry":"subscription_expiry","current_month_renewed_report":"current_month_renewed_report","auto_renewal":"auto_renewal","add_area":"add_area","agent_area_mapping":"agent_area_mapping","technician_mapping":"technician_mapping","view_stb_details":"view_stb_details","stb_report":"stb_report","bill_generation":"bill_generation","complaints":"complaints","add_expenses":"add_expenses","view_expenses":"view_expenses","daily_collection_report":"daily_collection_report","monthly_collection_report":"monthly_collection_report","unpaid_customers_report":"unpaid_customers_report","gst_report":"gst_report","rebate_report":"rebate_report","excess_collection_report":"excess_collection_report","monthly_closure_report":"monthly_closure_report","counter_bill_report":"counter_bill_report","training_videos":"training_videos","tech_support":"tech_support","users":"users","activity_logs":"activity_logs","manage_roles":"manage_roles","transaction_delete":"transaction_delete","rebate_customer":"rebate_customer","view_cust":"view_cust","counter_item":"counter_item"}}';
           $permission1 = '{"permissions":{"dashboard":"dashboard","dashboard_collection_amount":"dashboard_collection_amount","dashboard_daily_collection":"dashboard_daily_collection","dashboard_due_amount":"dashboard_due_amount","dashboard_complaints":"dashboard_complaints","dashboard_expairy_report":"dashboard_expairy_report","dashboard_list_agent":"dashboard_list_agent","dashboard_collection_trends":"dashboard_collection_trends","add_customer":"add_customer","quick_view":"quick_view","add_subscription":"add_subscription","view_subscription":"view_subscription","view_a_la_carte_subscription":"view_a_la_carte_subscription","subscription_report":"subscription_report","prepaid_pack_request":"prepaid_pack_request","subscription_expiry":"subscription_expiry","current_month_renewed_report":"current_month_renewed_report","auto_renewal":"auto_renewal","add_area":"add_area","agent_area_mapping":"agent_area_mapping","technician_mapping":"technician_mapping","view_stb_details":"view_stb_details","stb_report":"stb_report","complaints":"complaints","add_expenses":"add_expenses","view_expenses":"view_expenses","daily_collection_report":"daily_collection_report","monthly_collection_report":"monthly_collection_report","unpaid_customers_report":"unpaid_customers_report","gst_report":"gst_report","rebate_report":"rebate_report","excess_collection_report":"excess_collection_report","monthly_closure_report":"monthly_closure_report","counter_bill_report":"counter_bill_report","training_videos":"training_videos","tech_support":"tech_support","activity_logs":"activity_logs"}}';


        //alter-auto-increment-commands
        $alterIncrementOp = "ALTER TABLE OPERATOR AUTO_INCREMENT = 1;";
        $alterIncrementAg = "ALTER TABLE AGENT AUTO_INCREMENT = 1;";
        $alterIncrementRu = "ALTER TABLE AGENT AUTO_INCREMENT = 1;";
        $rAlterOp = $conn->query($alterIncrementOp);
        $rAlterAg = $conn->query($alterIncrementOp);
        $rAlterRu = $conn->query($alterIncrementRu);

         
 
       $sql="SELECT * FROM ROLE_USER where USER_ID='$login_id'";

if ($result=mysqli_query($conn,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
   if($rowcount==0)
   {
         //insert into operator
        $ins = 'INSERT INTO OPERATOR (GSTIN,Sales_Person,Operator_Comp_name, Operator_Login_Id,Operator_Password, Contact_Name,  Contact_Number, City,  Active,  OP_STATE,  Num_of_subscription, Start_date,  Comments,  Merchant_Id,  Merchant_Salt,  OP_Email_Id,  MSO_ID,  SMS_ENABLE_FLAG,  Business_Type,  Operator_Bill_Type,  Display_Bill_Generation,  Reminder_SMS, Op_Support_Number,  Send_sms, subscription_cycle,MIGRATE_STATUS,  lock_pin,  SECURE_FLAG)
        VALUES("'.$gst.'","'.$sales.'","'.$networkName.'", "'.$login_id.'", "'.$password.'", "'.$operatorName.'", "'.$phoneNumber.'", "'.$city.'","Y","'.$state.'","1000",now(), "NXT Data load Tool", "'.$lco_id.'","'.$lco_code.'","'.$email.'","4","N","1","Prepaid","N","Y","'.$phoneNumber.'","Y","30","Y","N","N");';
        $r1 = $conn->query($ins);


        //get operator_id
        $operator_id = "SELECT Operator_id FROM OPERATOR WHERE Operator_id=(SELECT max(Operator_id) FROM OPERATOR);";
        $r2 = $conn->query($operator_id);
        if ($r2->num_rows > 0) {
            $row = $r2->fetch_assoc();
            $opID = $row["Operator_id"];

          } else {
            //this will never run
            echo "0 results";
        }
        
        if($sub_main_eligible=="Y")
        {
             if($sub_main=="Y")
             {
               
                $ins11 = "INSERT INTO OPERATOR_META(operator_id, sub_lco, main_operator_id, wallet_balance, updated_time, invoice_template, image_url, image_url1, is_sub_main_lco, ott_disabled, ott_wallet)
  Values('$opID','Y','$mainop','0.00',now(),1,null,null,'Y','N','0.00')";
   $r1 = $conn->query($ins11);

 

             }
             else
             {
                
                   $ins11 = "INSERT INTO OPERATOR_META(operator_id, sub_lco, main_operator_id, wallet_balance, updated_time, invoice_template, image_url, image_url1, is_sub_main_lco, ott_disabled, ott_wallet)
  Values('$opID','N','$opID','0.00',now(),1,null,null,'Y','N','0.00')";
   $r1 = $conn->query($ins11);
             }
        }
        else
        {
                 $ins11 = "INSERT INTO OPERATOR_META(operator_id, sub_lco, main_operator_id, wallet_balance, updated_time, invoice_template, image_url, image_url1, is_sub_main_lco, ott_disabled, ott_wallet)
  Values('$opID','N','$opID','0.00',now(),1,null,null,'N','N','0.00')";

           
   
        $r1 = $conn->query($ins11);
            
        }

           $update = "UPDATE  OPERATOR SET Master_Id='$opID' where OPERATOR_ID='$opID'";

          $r3=$conn->query($update);


        //insert into Agent
        $insAgent = 'INSERT INTO AGENT(Name, Contact_Number,  Operator_id, Active,  AGENT_PASSWD,  AGENT_LOGIN_ID, MAIN_AGENT,MASTER_AGENT, IMP_FLAG,  Privileges, Role,  profile_pic_url,  USER_TYPE, amount_modify, SMS_INTEGRATION, EDIT_PACK_FLAG, LOCK_PIN, SECURE_FLAG, commission,SHOW_LCO_PRICE)
                     VALUES("'.$networkName.'","'.$phoneNumber.'","'.$opID.'","Y","'.$password.'","'.$login_id.'","N","N","A","B","AGENT","https://cableguyprofile.s3-us-west-2.amazonaws.com/iconfinder_user_male2_172626.png","webadmin","Y","Y","Y","N","N",0,"Y")';
        $r3 = $conn->query($insAgent);
        


        //get agent_id
        $agent_id = "SELECT Agent_id FROM AGENT WHERE Agent_id=(SELECT max(Agent_id) FROM AGENT);";
        $rAgent = $conn->query($agent_id);
        if ($rAgent->num_rows > 0) {
            $row = $rAgent->fetch_assoc();
            $agID = $row["Agent_id"];
        } else {
            //this will never run
            echo "0 results";
        }

             $insert_role_query = mysqli_query($conn,"INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME,ROLE_PERMISSION)VALUE('$opID','Admin','$permission')");
              $insert_role_query = mysqli_query($conn,"INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME)VALUE('$opID','Mobile')");
                 $insert_role_query = mysqli_query($conn,"INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME,ROLE_PERMISSION)VALUE('$opID','Supervisor','$permission1')");
                        
         $role_id_ = "SELECT ROLE_ID from  ROLES where Operator_id='$opID' and ROLE_NAME='Admin'";
        $role_id_Agent = $conn->query($role_id_);
        if ($role_id_Agent->num_rows > 0) {
            $row = $role_id_Agent->fetch_assoc();
            $ROLE_ID_ = $row["ROLE_ID"];
        } else {
            //this will never run
            echo "0 results";
        }                     
        //insert into role_id table
         $insRole = 'INSERT INTO ROLE_USER(USER_ID,  PASSWORD, ASSIGNED_ROLE,  AGENT_ID,  USER_TYPE, Operator_id)
                    VALUES("'.$login_id.'","'.$password.'","'.$ROLE_ID_.'","'.$agID.'","W","'.$opID.'")';
        $r4 = $conn->query($insRole); 



        if($r1 && $r2 && $r3 && $r4&&$ins11){
            header("location:register_nxt_operator.php?success= Data added into tables successfully");
        }else{
          echo "error";
            echo $conn->error;
        }
   }
   else
   {
       header("location:register_nxt_operator.php?error=USER ID Already Exist");
   }
  }
 }
}

  
 
     
  
