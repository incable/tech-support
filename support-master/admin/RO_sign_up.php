<?php 
    include("../auth_admin.php");
    include("../dbConnect.php");
    $employee_name = $_SESSION['employee_name'];
  	$email = $_SESSION['email'];
  	$phone = $_SESSION['phone'];
  	$employeeid = $_SESSION['id'];
  	
    $start_date = date('Y-m-d');
    $active = "Y";
    if (isset($_POST['submit'])){
	    $user_id = $_POST['user_id'];
	    $conn = connect();
	    $query = mysqli_query($conn,"SELECT Login_ID FROM user_authentication where Login_ID = '".san_sqli(1, $user_id,$conn)."'");
	    close($conn);
	    $data = mysqli_fetch_array($query,MYSQLI_ASSOC);
	    if ($user_id == $data['Login_ID']) {
	    	echo "<script>
	    			window.alert('USER ID is already associated with the another account please create New.');
					window.location.href = 'register_operator.php';</script>"; 
	    }else{
		    if (isset($_POST['submit']) && isset($_POST['sms_enable']) && isset($_POST['sms_reminder'])) {
		    	$c_name = $_POST['c_name'];
		    	$user_id = $_POST['user_id'];
			    $user_pass = $_POST['user_pass'];
			    $o_name = $_POST['o_name'];
			    $mobile = $_POST['mobile'];
			    $city = $_POST['city'];
			    $pin = $_POST['pin'];
			    $state = $_POST['state'];
			    $start_date;
			    $address = $_POST['address'];
			    $email = $_POST['email'];
			    $sms_enable = $_POST['sms_enable'];
			    $area = $_POST['area'];
			    $sale_person = $_POST['sale_person'];
			    $sms_reminder = $_POST['sms_reminder'];
			    $type_bill = $_POST['type_bill'];
			    $gstno = $_POST['gstno'];
			    $com_number = $_POST['com_number'];
			    $type_cycle = $_POST['type_cycle'];

			    $conn = connect();
				$query = mysqli_query($conn, "INSERT INTO `OPERATOR`(Operator_Comp_name,Operator_Login_Id,Operator_Password,Contact_Name,Contact_Number,City,Pin_code,OP_STATE,Start_date,Operator_Addr,OP_Email_Id,Operator_Bill_Type,Sales_Person,OP_AREA,State,Reminder_SMS,GSTIN,COMPAINT_NUMBER,subscription_cycle) VALUES('".san_sqli(1, $c_name,$conn)."','".san_sqli(1, $user_id,$conn)."','".san_sqli(1, $user_pass,$conn)."','".san_sqli(1, $o_name,$conn)."','".san_sqli(1, $mobile,$conn)."','".san_sqli(1, $city,$conn)."','".san_sqli(1, $pin,$conn)."','".san_sqli(1, $state,$conn)."','$start_date','".san_sqli(1, $address,$conn)."','".san_sqli(1, $email,$conn)."','".san_sqli(1, $type_bill,$conn)."','".san_sqli(1, $sale_person,$conn)."','".san_sqli(1, $area,$conn)."','".san_sqli(1, $sms_enable,$conn)."','".san_sqli(1, $sms_reminder,$conn)."','".san_sqli(1, $gstno,$conn)."','".san_sqli(1, $com_number,$conn)."','".san_sqli(1, $type_cycle,$conn)."'");
				close($conn);
				   $conn = connect();
				$query12 = mysqli_query($conn, "INSERT INTO OPERATOR_META(
 operator_id,wallet_balance, updated_time, invoice_template)
select OPERATOR_ID,0.00,now(),1 from OPERATOR WHERE Operator_id NOT IN(select OPERATOR_ID FROM OPERATOR_META)");
				close($conn);
				  $conn = connect();
				$query13= mysqli_query($conn, "INSERT INTO customer_invoice_no (OPERATOR_ID)
select OPERATOR_ID from OPERATOR WHERE OPERATOR_ID NOT IN(select OPERATOR_ID from customer_invoice_no)");
				close($conn);
				// if ($query) {
				// 	$conn = connect();
				// 	$query1 = mysqli_query($conn, 'SELECT Contact_Name,Operator_id FROM OPERATOR order by Operator_id DESC limit 1');
				// 	close($conn);
				// 	$data1 = mysqli_fetch_array($query1,MYSQLI_ASSOC);
				// 	print_r($data1);
				// 	$name = $data1['Contact_Name'];
				// 	$operator_id = $data1['Operator_id'];
				// 	$type ="webadmin";
				// 	$pre ='{"permissions":{"dashboard":"dashboard","dashboard_collection_amount":"dashboard_collection_amount","dashboard_daily_collection":"dashboard_daily_collection","dashboard_due_amount":"dashboard_due_amount","dashboard_complaints":"dashboard_complaints","dashboard_expairy_report":"dashboard_expairy_report","dashboard_list_agent":"dashboard_list_agent","dashboard_collection_trends":"dashboard_collection_trends","add_customer":"add_customer","quick_view":"quick_view","add_subscription":"add_subscription","view_subscription":"view_subscription","view_a_la_carte_subscription":"view_a_la_carte_subscription","subscription_report":"subscription_report","prepaid_pack_request":"prepaid_pack_request","subscription_expiry":"subscription_expiry","current_month_renewed_report":"current_month_renewed_report","auto_renewal":"auto_renewal","add_area":"add_area","agent_area_mapping":"agent_area_mapping","technician_mapping":"technician_mapping","view_stb_details":"view_stb_details","stb_report":"stb_report","bill_generation":"bill_generation","complaints":"complaints","add_expenses":"add_expenses","view_expenses":"view_expenses","daily_collection_report":"daily_collection_report","monthly_collection_report":"monthly_collection_report","unpaid_customers_report":"unpaid_customers_report","gst_report":"gst_report","rebate_report":"rebate_report","excess_collection_report":"excess_collection_report","monthly_closure_report":"monthly_closure_report","counter_bill_report":"counter_bill_report","training_videos":"training_videos","tech_support":"tech_support","users":"users","activity_logs":"activity_logs","manage_roles":"manage_roles","transaction_delete":"transaction_delete","rebate_customer":"rebate_customer","counter_item":"counter_item"}}';
				// 	$pre1='{"permissions": {"dashboard": "dashboard","dashboard_collection_amount": "dashboard_collection_amount","dashboard_daily_collection": "dashboard_daily_collection","dashboard_due_amount": "dashboard_due_amount","dashboard_complaints": "dashboard_complaints","dashboard_expairy_report": "dashboard_expairy_report","dashboard_list_agent": "dashboard_list_agent","dashboard_collection_trends": "dashboard_collection_trends","add_customer": "add_customer","quick_view": "quick_view","add_subscription": "add_subscription","view_subscription": "view_subscription","view_a_la_carte_subscription": "view_a_la_carte_subscription","subscription_report": "subscription_report","prepaid_pack_request": "prepaid_pack_request","subscription_expiry": "subscription_expiry","current_month_renewed_report": "current_month_renewed_report","auto_renewal": "auto_renewal","add_area": "add_area","agent_area_mapping": "agent_area_mapping","technician_mapping": "technician_mapping","view_stb_details": "view_stb_details","stb_report": "stb_report","bill_generation": "bill_generation","complaints": "complaints","add_expenses": "add_expenses","view_expenses": "view_expenses","daily_collection_report": "daily_collection_report","monthly_collection_report": "monthly_collection_report","unpaid_customers_report": "unpaid_customers_report","gst_report": "gst_report","rebate_report": "rebate_report","excess_collection_report": "excess_collection_report","monthly_closure_report": "monthly_closure_report","counter_bill_report": "counter_bill_report","training_videos": "training_videos","tech_support": "tech_support","activity_logs": "activity_logs","counter_item": "counter_item"}}';
				// 	$conn = connect();
				// 	$query2 = mysqli_query($conn, "INSERT INTO AGENT(Name,Operator_id,USER_TYPE,AGENT_LOGIN_ID,AGENT_PASSWD)VALUE('$name','$operator_id','$type','$user_id','$user_pass')");
				// 	$query3 = mysqli_query($conn, "INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME,ROLE_PERMISSION)VALUE('$operator_id','Admin','$pre')");
				// 	$query4 = mysqli_query($conn, "INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME)VALUE('$operator_id','Mobile')");
				// 	$query5 = mysqli_query($conn, "INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME,ROLE_PERMISSION)VALUE('$operator_id','Admin','$pre1')");
				// 	close($conn);
				// 	if ($query) {
				// 		$conn = connect();
				// 		$query4 = mysqli_query($conn, "SELECT Agent_Id FROM AGENT WHERE OPERATOR_ID ='$operator_id' AND USER_TYPE='webadmin'");
				// 		close($conn);
				// 		$data2 = mysqli_fetch_array($query4,MYSQLI_ASSOC);
				// 		$agent_id = $data2['Agent_Id'];
				// 		$conn = connect();

				// 		$query5 = mysqli_query($conn, "SELECT ROLE_ID FROM ROLES WHERE OPERATOR_ID ='$operator_id' and ROLE_NAME='Admin'");
				// 		close($conn);
				// 		$data3 = mysqli_fetch_array($query5,MYSQLI_ASSOC);
				// 		$role_id = $data3['ROLE_ID'];
				// 		$conn = connect();
				// 		$query6 = mysqli_query($conn,"INSERT INTO ROLE_USER(USER_ID, PASSWORD, ASSIGNED_ROLE, AGENT_ID, USER_TYPE,'Operator_id') VALUE('$user_id','$user_pass','$role_id','$agent_id','W','$operator_id');");
				// 		close($conn);
				// 	}
				// }
				close($conn);
				header("Location:full_operator_details.php");
		    }elseif (isset($_POST['submit']) && isset($_POST['sms_enable'])) {
		    	$c_name = $_POST['c_name'];
		    	$user_id = $_POST['user_id'];
			    $user_pass = $_POST['user_pass'];
			    $o_name = $_POST['o_name'];
			    $mobile = $_POST['mobile'];
			    $city = $_POST['city'];
			    $pin = $_POST['pin'];
			    $state = $_POST['state'];
			    $start_date;
			    $address = $_POST['address'];
			    $email = $_POST['email'];
			    $sms_enable = $_POST['sms_enable'];
			    $area = $_POST['area'];
			    $sale_person = $_POST['sale_person'];
			    $type_bill = $_POST['type_bill'];
			    $gstno = $_POST['gstno'];
			    $com_number = $_POST['com_number'];
			    $type_cycle = $_POST['type_cycle'];

			    $conn = connect();
				$query = mysqli_query($conn, "INSERT INTO `OPERATOR`(Operator_Comp_name,Operator_Login_Id,Operator_Password,Contact_Name,Contact_Number,City,Pin_code,OP_STATE,Start_date,Operator_Addr,OP_Email_Id,Operator_Bill_Type,Sales_Person,OP_AREA,State,GSTIN,COMPAINT_NUMBER,subscription_cycle) VALUES('".san_sqli(1, $c_name,$conn)."','".san_sqli(1, $user_id,$conn)."','".san_sqli(1, $user_pass,$conn)."','".san_sqli(1, $o_name,$conn)."','".san_sqli(1, $mobile,$conn)."','".san_sqli(1, $city,$conn)."','".san_sqli(1, $pin,$conn)."','".san_sqli(1, $state,$conn)."','$start_date','".san_sqli(1, $address,$conn)."','".san_sqli(1, $email,$conn)."','".san_sqli(1, $type_bill,$conn)."','".san_sqli(1, $sale_person,$conn)."','".san_sqli(1, $area,$conn)."','".san_sqli(1, $sms_enable,$conn)."','".san_sqli(1, $gstno,$conn)."','".san_sqli(1, $com_number,$conn)."','".san_sqli(1, $type_cycle,$conn)."'");
				close($conn);
				 $conn = connect();
				$query12 = mysqli_query($conn, "INSERT INTO OPERATOR_META(
 operator_id,wallet_balance, updated_time, invoice_template)
select OPERATOR_ID,0.00,now(),1 from OPERATOR WHERE Operator_id NOT IN(select OPERATOR_ID FROM OPERATOR_META)");
				close($conn);
				  $conn = connect();
				$query13= mysqli_query($conn, "INSERT INTO customer_invoice_no (OPERATOR_ID)
select OPERATOR_ID from OPERATOR WHERE OPERATOR_ID NOT IN(select OPERATOR_ID from customer_invoice_no)");
				close($conn);
				// if ($query) {
				// 	$conn = connect();
				// 	$query1 = mysqli_query($conn, 'SELECT Contact_Name,Operator_id FROM OPERATOR order by Operator_id DESC limit 1');
				// 	close($conn);
				// 	$data1 = mysqli_fetch_array($query1,MYSQLI_ASSOC);
				// 	print_r($data1);
				// 	$name = $data1['Contact_Name'];
				// 	$operator_id = $data1['Operator_id'];
				// 	$type ="webadmin";
				// 	$pre ='{"permissions":{"dashboard":"dashboard","dashboard_collection_amount":"dashboard_collection_amount","dashboard_daily_collection":"dashboard_daily_collection","dashboard_due_amount":"dashboard_due_amount","dashboard_complaints":"dashboard_complaints","dashboard_expairy_report":"dashboard_expairy_report","dashboard_list_agent":"dashboard_list_agent","dashboard_collection_trends":"dashboard_collection_trends","add_customer":"add_customer","quick_view":"quick_view","add_subscription":"add_subscription","view_subscription":"view_subscription","view_a_la_carte_subscription":"view_a_la_carte_subscription","subscription_report":"subscription_report","prepaid_pack_request":"prepaid_pack_request","subscription_expiry":"subscription_expiry","current_month_renewed_report":"current_month_renewed_report","auto_renewal":"auto_renewal","add_area":"add_area","agent_area_mapping":"agent_area_mapping","technician_mapping":"technician_mapping","view_stb_details":"view_stb_details","stb_report":"stb_report","bill_generation":"bill_generation","complaints":"complaints","add_expenses":"add_expenses","view_expenses":"view_expenses","daily_collection_report":"daily_collection_report","monthly_collection_report":"monthly_collection_report","unpaid_customers_report":"unpaid_customers_report","gst_report":"gst_report","rebate_report":"rebate_report","excess_collection_report":"excess_collection_report","monthly_closure_report":"monthly_closure_report","counter_bill_report":"counter_bill_report","training_videos":"training_videos","tech_support":"tech_support","users":"users","activity_logs":"activity_logs","manage_roles":"manage_roles"}}';
				// 	$pre1='{"permissions": {"dashboard": "dashboard","dashboard_collection_amount": "dashboard_collection_amount","dashboard_daily_collection": "dashboard_daily_collection","dashboard_due_amount": "dashboard_due_amount","dashboard_complaints": "dashboard_complaints","dashboard_expairy_report": "dashboard_expairy_report","dashboard_list_agent": "dashboard_list_agent","dashboard_collection_trends": "dashboard_collection_trends","add_customer": "add_customer","quick_view": "quick_view","add_subscription": "add_subscription","view_subscription": "view_subscription","view_a_la_carte_subscription": "view_a_la_carte_subscription","subscription_report": "subscription_report","prepaid_pack_request": "prepaid_pack_request","subscription_expiry": "subscription_expiry","current_month_renewed_report": "current_month_renewed_report","auto_renewal": "auto_renewal","add_area": "add_area","agent_area_mapping": "agent_area_mapping","technician_mapping": "technician_mapping","view_stb_details": "view_stb_details","stb_report": "stb_report","bill_generation": "bill_generation","complaints": "complaints","add_expenses": "add_expenses","view_expenses": "view_expenses","daily_collection_report": "daily_collection_report","monthly_collection_report": "monthly_collection_report","unpaid_customers_report": "unpaid_customers_report","gst_report": "gst_report","rebate_report": "rebate_report","excess_collection_report": "excess_collection_report","monthly_closure_report": "monthly_closure_report","counter_bill_report": "counter_bill_report","training_videos": "training_videos","tech_support": "tech_support","activity_logs": "activity_logs","counter_item": "counter_item"}}';
				// 	$conn = connect();
				// 	$query2 = mysqli_query($conn, "INSERT INTO AGENT(Name,Operator_id,USER_TYPE,AGENT_LOGIN_ID,AGENT_PASSWD)VALUE('$name','$operator_id','$type','$user_id','$user_pass')");
				// 	$query3 = mysqli_query($conn, "INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME,ROLE_PERMISSION)VALUE('$operator_id','Admin','$pre')");
				// 	$query4 = mysqli_query($conn, "INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME)VALUE('$operator_id','Mobile')");
				// 	$query5 = mysqli_query($conn, "INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME,ROLE_PERMISSION)VALUE('$operator_id','Admin','$pre1')");
				// 	close($conn);
				// 	if ($query) {
				// 		$conn = connect();
				// 		$query4 = mysqli_query($conn, "SELECT Agent_Id FROM AGENT WHERE OPERATOR_ID ='$operator_id' AND USER_TYPE='webadmin'");
				// 		close($conn);
				// 		$data2 = mysqli_fetch_array($query4,MYSQLI_ASSOC);
				// 		$agent_id = $data2['Agent_Id'];
				// 		$conn = connect();

				// 		$query5 = mysqli_query($conn, "SELECT ROLE_ID FROM ROLES WHERE OPERATOR_ID ='$operator_id' and ROLE_NAME='Admin'");
				// 		close($conn);
				// 		$data3 = mysqli_fetch_array($query5,MYSQLI_ASSOC);
				// 		$role_id = $data3['ROLE_ID'];
				// 		$conn = connect();
				// 		$query6 = mysqli_query($conn,"INSERT INTO ROLE_USER(USER_ID, PASSWORD, ASSIGNED_ROLE, AGENT_ID, USER_TYPE,'Operator_id') VALUE('$user_id','$user_pass','$role_id','$agent_id','W','$operator_id');");
				// 		close($conn);
				// 	}
				// }
				header("Location:full_operator_details.php");
		    }elseif (isset($_POST['submit']) && isset($_POST['sms_reminder'])) {
		    	$c_name = $_POST['c_name'];
		    	$user_id = $_POST['user_id'];
			    $user_pass = $_POST['user_pass'];
			    $o_name = $_POST['o_name'];
			    $mobile = $_POST['mobile'];
			    $city = $_POST['city'];
			    $pin = $_POST['pin'];
			    $state = $_POST['state'];
			    $start_date;
			    $address = $_POST['address'];
			    $email = $_POST['email'];
			    $area = $_POST['area'];
			    $sale_person = $_POST['sale_person'];
			    $sms_reminder = $_POST['sms_reminder'];
			    $type_bill = $_POST['type_bill'];
			    $gstno = $_POST['gstno'];
			    $com_number = $_POST['com_number'];
			    $type_cycle = $_POST['type_cycle'];

			    $conn = connect();
				$query = mysqli_query($conn, "INSERT INTO `OPERATOR`(Operator_Comp_name,Operator_Login_Id,Operator_Password,Contact_Name,Contact_Number,City,Pin_code,OP_STATE,Start_date,Operator_Addr,OP_Email_Id,Operator_Bill_Type,Sales_Person,OP_AREA,Reminder_SMS,GSTIN,COMPAINT_NUMBER,subscription_cycle) VALUES('".san_sqli(1, $c_name,$conn)."','".san_sqli(1, $user_id,$conn)."','".san_sqli(1, $user_pass,$conn)."','".san_sqli(1, $o_name,$conn)."','".san_sqli(1, $mobile,$conn)."','".san_sqli(1, $city,$conn)."','".san_sqli(1, $pin,$conn)."','".san_sqli(1, $state,$conn)."','$start_date','".san_sqli(1, $address,$conn)."','".san_sqli(1, $email,$conn)."','".san_sqli(1, $type_bill,$conn)."','".san_sqli(1, $sale_person,$conn)."','".san_sqli(1, $area,$conn)."','".san_sqli(1, $sms_reminder,$conn)."','".san_sqli(1, $gstno,$conn)."','".san_sqli(1, $com_number,$conn)."','".san_sqli(1, $type_cycle,$conn)."'");
				close($conn);
				 $conn = connect();
				$query12 = mysqli_query($conn, "INSERT INTO OPERATOR_META(
 operator_id,wallet_balance, updated_time, invoice_template)
select OPERATOR_ID,0.00,now(),1 from OPERATOR WHERE Operator_id NOT IN(select OPERATOR_ID FROM OPERATOR_META)");
				close($conn);
				  $conn = connect();
				$query13= mysqli_query($conn, "INSERT INTO customer_invoice_no (OPERATOR_ID)
select OPERATOR_ID from OPERATOR WHERE OPERATOR_ID NOT IN(select OPERATOR_ID from customer_invoice_no)");
				close($conn);
				// if ($query) {
				// 	$conn = connect();
				// 	$query1 = mysqli_query($conn, 'SELECT Contact_Name,Operator_id FROM OPERATOR order by Operator_id DESC limit 1');
				// 	close($conn);
				// 	$data1 = mysqli_fetch_array($query1,MYSQLI_ASSOC);
				// 	print_r($data1);
				// 	$name = $data1['Contact_Name'];
				// 	$operator_id = $data1['Operator_id'];
				// 	$type ="webadmin";
				// 	$pre ='{"permissions":{"dashboard":"dashboard","dashboard_collection_amount":"dashboard_collection_amount","dashboard_daily_collection":"dashboard_daily_collection","dashboard_due_amount":"dashboard_due_amount","dashboard_complaints":"dashboard_complaints","dashboard_expairy_report":"dashboard_expairy_report","dashboard_list_agent":"dashboard_list_agent","dashboard_collection_trends":"dashboard_collection_trends","add_customer":"add_customer","quick_view":"quick_view","add_subscription":"add_subscription","view_subscription":"view_subscription","view_a_la_carte_subscription":"view_a_la_carte_subscription","subscription_report":"subscription_report","prepaid_pack_request":"prepaid_pack_request","subscription_expiry":"subscription_expiry","current_month_renewed_report":"current_month_renewed_report","auto_renewal":"auto_renewal","add_area":"add_area","agent_area_mapping":"agent_area_mapping","technician_mapping":"technician_mapping","view_stb_details":"view_stb_details","stb_report":"stb_report","bill_generation":"bill_generation","complaints":"complaints","add_expenses":"add_expenses","view_expenses":"view_expenses","daily_collection_report":"daily_collection_report","monthly_collection_report":"monthly_collection_report","unpaid_customers_report":"unpaid_customers_report","gst_report":"gst_report","rebate_report":"rebate_report","excess_collection_report":"excess_collection_report","monthly_closure_report":"monthly_closure_report","counter_bill_report":"counter_bill_report","training_videos":"training_videos","tech_support":"tech_support","users":"users","activity_logs":"activity_logs","manage_roles":"manage_roles"}}';
				// 	$pre1='{"permissions": {"dashboard": "dashboard","dashboard_collection_amount": "dashboard_collection_amount","dashboard_daily_collection": "dashboard_daily_collection","dashboard_due_amount": "dashboard_due_amount","dashboard_complaints": "dashboard_complaints","dashboard_expairy_report": "dashboard_expairy_report","dashboard_list_agent": "dashboard_list_agent","dashboard_collection_trends": "dashboard_collection_trends","add_customer": "add_customer","quick_view": "quick_view","add_subscription": "add_subscription","view_subscription": "view_subscription","view_a_la_carte_subscription": "view_a_la_carte_subscription","subscription_report": "subscription_report","prepaid_pack_request": "prepaid_pack_request","subscription_expiry": "subscription_expiry","current_month_renewed_report": "current_month_renewed_report","auto_renewal": "auto_renewal","add_area": "add_area","agent_area_mapping": "agent_area_mapping","technician_mapping": "technician_mapping","view_stb_details": "view_stb_details","stb_report": "stb_report","bill_generation": "bill_generation","complaints": "complaints","add_expenses": "add_expenses","view_expenses": "view_expenses","daily_collection_report": "daily_collection_report","monthly_collection_report": "monthly_collection_report","unpaid_customers_report": "unpaid_customers_report","gst_report": "gst_report","rebate_report": "rebate_report","excess_collection_report": "excess_collection_report","monthly_closure_report": "monthly_closure_report","counter_bill_report": "counter_bill_report","training_videos": "training_videos","tech_support": "tech_support","activity_logs": "activity_logs","counter_item": "counter_item"}}';
				// 	$conn = connect();
				// 	$query2 = mysqli_query($conn, "INSERT INTO AGENT(Name,Operator_id,USER_TYPE,AGENT_LOGIN_ID,AGENT_PASSWD)VALUE('$name','$operator_id','$type','$user_id','$user_pass')");
				// 	$query3 = mysqli_query($conn, "INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME,ROLE_PERMISSION)VALUE('$operator_id','Admin','$pre')");
				// 	$query4 = mysqli_query($conn, "INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME)VALUE('$operator_id','Mobile')");
				// 	$query5 = mysqli_query($conn, "INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME,ROLE_PERMISSION)VALUE('$operator_id','Admin','$pre1')");
				// 	close($conn);
				// 	if ($query) {
				// 		$conn = connect();
				// 		$query4 = mysqli_query($conn, "SELECT Agent_Id FROM AGENT WHERE OPERATOR_ID ='$operator_id' AND USER_TYPE='webadmin'");
				// 		close($conn);
				// 		$data2 = mysqli_fetch_array($query4,MYSQLI_ASSOC);
				// 		$agent_id = $data2['Agent_Id'];
				// 		$conn = connect();

				// 		$query5 = mysqli_query($conn, "SELECT ROLE_ID FROM ROLES WHERE OPERATOR_ID ='$operator_id' and ROLE_NAME='Admin'");
				// 		close($conn);
				// 		$data3 = mysqli_fetch_array($query5,MYSQLI_ASSOC);
				// 		$role_id = $data3['ROLE_ID'];
				// 		$conn = connect();
				// 		$query6 = mysqli_query($conn,"INSERT INTO ROLE_USER(USER_ID, PASSWORD, ASSIGNED_ROLE, AGENT_ID, USER_TYPE,'Operator_id') VALUE('$user_id','$user_pass','$role_id','$agent_id','W','$operator_id');");
				// 		close($conn);
				// 	}
				// }
				header("Location:full_operator_details.php");
		    }else{
		    	$c_name = $_POST['c_name'];
		    	$user_id = $_POST['user_id'];
			    $user_pass = $_POST['user_pass'];
			    $o_name = $_POST['o_name'];
			    $mobile = $_POST['mobile'];
			    $city = $_POST['city'];
			    $pin = $_POST['pin'];
			    $state = $_POST['state'];
			    $start_date;
			    $address = $_POST['address'];
			    $email = $_POST['email'];
			    $area = $_POST['area'];
			    $sale_person = $_POST['sale_person'];
			    $type_bill = $_POST['type_bill'];
			    $gstno = $_POST['gstno'];
			    $com_number = $_POST['com_number'];
			    $type_cycle = $_POST['type_cycle'];

			    $conn = connect();
				$query = mysqli_query($conn, "INSERT INTO `OPERATOR`(Operator_Comp_name,Operator_Login_Id,Operator_Password,Contact_Name,Contact_Number,City,Pin_code,OP_STATE,Start_date,Operator_Addr,OP_Email_Id,Operator_Bill_Type,Sales_Person,OP_AREA,GSTIN,COMPAINT_NUMBER,subscription_cycle) VALUES('".san_sqli(1, $c_name,$conn)."','".san_sqli(1, $user_id,$conn)."','".san_sqli(1, $user_pass,$conn)."','".san_sqli(1, $o_name,$conn)."','".san_sqli(1, $mobile,$conn)."','".san_sqli(1, $city,$conn)."','".san_sqli(1, $pin,$conn)."','".san_sqli(1, $state,$conn)."','$start_date','".san_sqli(1, $address,$conn)."','".san_sqli(1, $email,$conn)."','".san_sqli(1, $type_bill,$conn)."','".san_sqli(1, $sale_person,$conn)."','".san_sqli(1, $area,$conn)."','".san_sqli(1, $gstno,$conn)."','".san_sqli(1, $com_number,$conn)."','".san_sqli(1, $type_cycle,$conn)."'");
				close($conn);
				 $conn = connect();
				$query12 = mysqli_query($conn, "INSERT INTO OPERATOR_META(
 operator_id,wallet_balance, updated_time, invoice_template)
select OPERATOR_ID,0.00,now(),1 from OPERATOR WHERE Operator_id NOT IN(select OPERATOR_ID FROM OPERATOR_META)");
				close($conn);
				  $conn = connect();
				$query13= mysqli_query($conn, "INSERT INTO customer_invoice_no (OPERATOR_ID)
select OPERATOR_ID from OPERATOR WHERE OPERATOR_ID NOT IN(select OPERATOR_ID from customer_invoice_no)");
				close($conn);
				// if ($query) {
				// 	$conn = connect();
				// 	$query1 = mysqli_query($conn, 'SELECT Contact_Name,Operator_id FROM OPERATOR order by Operator_id DESC limit 1');
				// 	close($conn);
				// 	$data1 = mysqli_fetch_array($query1,MYSQLI_ASSOC);
				// 	print_r($data1);
				// 	$name = $data1['Contact_Name'];
				// 	$operator_id = $data1['Operator_id'];
				// 	$type ="webadmin";
				// 	$pre ='{"permissions":{"dashboard":"dashboard","dashboard_collection_amount":"dashboard_collection_amount","dashboard_daily_collection":"dashboard_daily_collection","dashboard_due_amount":"dashboard_due_amount","dashboard_complaints":"dashboard_complaints","dashboard_expairy_report":"dashboard_expairy_report","dashboard_list_agent":"dashboard_list_agent","dashboard_collection_trends":"dashboard_collection_trends","add_customer":"add_customer","quick_view":"quick_view","add_subscription":"add_subscription","view_subscription":"view_subscription","view_a_la_carte_subscription":"view_a_la_carte_subscription","subscription_report":"subscription_report","prepaid_pack_request":"prepaid_pack_request","subscription_expiry":"subscription_expiry","current_month_renewed_report":"current_month_renewed_report","auto_renewal":"auto_renewal","add_area":"add_area","agent_area_mapping":"agent_area_mapping","technician_mapping":"technician_mapping","view_stb_details":"view_stb_details","stb_report":"stb_report","bill_generation":"bill_generation","complaints":"complaints","add_expenses":"add_expenses","view_expenses":"view_expenses","daily_collection_report":"daily_collection_report","monthly_collection_report":"monthly_collection_report","unpaid_customers_report":"unpaid_customers_report","gst_report":"gst_report","rebate_report":"rebate_report","excess_collection_report":"excess_collection_report","monthly_closure_report":"monthly_closure_report","counter_bill_report":"counter_bill_report","training_videos":"training_videos","tech_support":"tech_support","users":"users","activity_logs":"activity_logs","manage_roles":"manage_roles"}}';
				// 	$pre1='{"permissions": {"dashboard": "dashboard","dashboard_collection_amount": "dashboard_collection_amount","dashboard_daily_collection": "dashboard_daily_collection","dashboard_due_amount": "dashboard_due_amount","dashboard_complaints": "dashboard_complaints","dashboard_expairy_report": "dashboard_expairy_report","dashboard_list_agent": "dashboard_list_agent","dashboard_collection_trends": "dashboard_collection_trends","add_customer": "add_customer","quick_view": "quick_view","add_subscription": "add_subscription","view_subscription": "view_subscription","view_a_la_carte_subscription": "view_a_la_carte_subscription","subscription_report": "subscription_report","prepaid_pack_request": "prepaid_pack_request","subscription_expiry": "subscription_expiry","current_month_renewed_report": "current_month_renewed_report","auto_renewal": "auto_renewal","add_area": "add_area","agent_area_mapping": "agent_area_mapping","technician_mapping": "technician_mapping","view_stb_details": "view_stb_details","stb_report": "stb_report","bill_generation": "bill_generation","complaints": "complaints","add_expenses": "add_expenses","view_expenses": "view_expenses","daily_collection_report": "daily_collection_report","monthly_collection_report": "monthly_collection_report","unpaid_customers_report": "unpaid_customers_report","gst_report": "gst_report","rebate_report": "rebate_report","excess_collection_report": "excess_collection_report","monthly_closure_report": "monthly_closure_report","counter_bill_report": "counter_bill_report","training_videos": "training_videos","tech_support": "tech_support","activity_logs": "activity_logs","counter_item": "counter_item"}}';
				// 	$conn = connect();
				// 	$query2 = mysqli_query($conn, "INSERT INTO AGENT(Name,Operator_id,USER_TYPE,AGENT_LOGIN_ID,AGENT_PASSWD)VALUE('$name','$operator_id','$type','$user_id','$user_pass')");
				// 	$query3 = mysqli_query($conn, "INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME,ROLE_PERMISSION)VALUE('$operator_id','Admin','$pre')");
				// 	$query4 = mysqli_query($conn, "INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME)VALUE('$operator_id','Mobile')");
				// 	$query5 = mysqli_query($conn, "INSERT INTO ROLES(OPERATOR_ID,ROLE_NAME,ROLE_PERMISSION)VALUE('$operator_id','Admin','$pre1')");
				// 	close($conn);
				// 	if ($query) {
				// 		$conn = connect();
				// 		$query4 = mysqli_query($conn, "SELECT Agent_Id FROM AGENT WHERE OPERATOR_ID ='$operator_id' AND USER_TYPE='webadmin'");
				// 		close($conn);
				// 		$data2 = mysqli_fetch_array($query4,MYSQLI_ASSOC);
				// 		$agent_id = $data2['Agent_Id'];
				// 		$conn = connect();

				// 		$query5 = mysqli_query($conn, "SELECT ROLE_ID FROM ROLES WHERE OPERATOR_ID ='$operator_id' and ROLE_NAME='Admin'");
				// 		close($conn);
				// 		$data3 = mysqli_fetch_array($query5,MYSQLI_ASSOC);
				// 		$role_id = $data3['ROLE_ID'];
				// 		$conn = connect();
				// 		$query6 = mysqli_query($conn,"INSERT INTO ROLE_USER(USER_ID, PASSWORD, ASSIGNED_ROLE, AGENT_ID, USER_TYPE,'Operator_id') VALUE('$user_id','$user_pass','$role_id','$agent_id','W','$operator_id');");
				// 		close($conn);
				// 	}
				// }
				header("Location:full_operator_details.php");
		    }
		}
	}
?>