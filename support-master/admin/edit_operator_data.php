<?php
include("../auth_admin.php");
include("../dbConnect.php");
$employee_name = $_SESSION['employee_name'];
    $email = $_SESSION['email'];
    $phone = $_SESSION['phone'];
    $employeeid = $_SESSION['id'];

if (isset($_POST['submit']) && isset($_POST['sms_enable']) && isset($_POST['sms_reminder'])) {
   $id = $_GET['id'];
    $c_name = $_POST['c_name'];
    $user_id = $_POST['user_id'];
    $user_pass = $_POST['user_pass'];
    $o_name = $_POST['o_name'];
    $mobile = $_POST['mobile'];
    $city = $_POST['city'];
    $pin = $_POST['pin'];
    $state = $_POST['state'];
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
$update = mysqli_query($conn, "UPDATE OPERATOR SET Operator_Comp_name = '".san_sqli(1, $c_name,$conn)."', Operator_Login_Id='".san_sqli(1, $user_id,$conn)."', Operator_Password='".san_sqli(1, $user_pass,$conn)."', Contact_Name='".san_sqli(1, $o_name,$conn)."', Contact_Number='".san_sqli(1, $mobile,$conn)."', City='".san_sqli(1, $city,$conn)."', Pin_code='".san_sqli(1, $pin,$conn)."', OP_STATE='".san_sqli(1, $state,$conn)."', Operator_Addr='".san_sqli(1, $address,$conn)."', OP_Email_Id='".san_sqli(1, $email,$conn)."', State='".san_sqli(1, $sms_enable,$conn)."', OP_AREA='".san_sqli(1, $area,$conn)."', Reminder_SMS='".san_sqli(1, $sms_reminder,$conn)."', Operator_Bill_Type='".san_sqli(1, $type_bill,$conn)."', subscription_cycle='".san_sqli(1, $type_cycle,$conn)."', GSTIN='".san_sqli(1, $gstno,$conn)."', COMPAINT_NUMBER='".san_sqli(1, $com_number,$conn)."' WHERE Operator_id = '".san_sqli(1, $id,$conn)."'");
                                   
    header("Location:full_operator_details.php");
    close($conn);
}elseif (isset($_POST['submit']) && isset($_POST['sms_enable'])) {
    $id = $_GET['id'];
    $c_name = $_POST['c_name'];
    $user_id = $_POST['user_id'];
    $user_pass = $_POST['user_pass'];
    $o_name = $_POST['o_name'];
    $mobile = $_POST['mobile'];
    $city = $_POST['city'];
    $pin = $_POST['pin'];
    $state = $_POST['state'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $sms_enable = $_POST['sms_enable'];
    $area = $_POST['area'];
    $type_bill = $_POST['type_bill'];
    $gstno = $_POST['gstno'];
    $com_number = $_POST['com_number'];
    $type_cycle = $_POST['type_cycle'];
    $conn = connect();
$update = mysqli_query($conn, "UPDATE OPERATOR SET Operator_Comp_name = '".san_sqli(1, $c_name,$conn)."', Operator_Login_Id='".san_sqli(1, $user_id,$conn)."', Operator_Password='".san_sqli(1, $user_pass,$conn)."', Contact_Name='".san_sqli(1, $o_name,$conn)."', Contact_Number='".san_sqli(1, $mobile,$conn)."', City='".san_sqli(1, $city,$conn)."', Pin_code='".san_sqli(1, $pin,$conn)."', OP_STATE='".san_sqli(1, $state,$conn)."', Operator_Addr='".san_sqli(1, $address,$conn)."', OP_Email_Id='".san_sqli(1, $email,$conn)."', State='".san_sqli(1, $sms_enable,$conn)."', OP_AREA='".san_sqli(1, $area,$conn)."', Operator_Bill_Type='".san_sqli(1, $type_bill,$conn)."', subscription_cycle='".san_sqli(1, $type_cycle,$conn)."', GSTIN='".san_sqli(1, $gstno,$conn)."', COMPAINT_NUMBER='".san_sqli(1, $com_number,$conn)."' WHERE Operator_id = '".san_sqli(1, $id,$conn)."'");
                                   
    header("Location:full_operator_details.php");
    close($conn);
}elseif (isset($_POST['submit']) && isset($_POST['sms_reminder'])) {
    $id = $_GET['id'];
    $c_name = $_POST['c_name'];
    $user_id = $_POST['user_id'];
    $user_pass = $_POST['user_pass'];
    $o_name = $_POST['o_name'];
    $mobile = $_POST['mobile'];
    $city = $_POST['city'];
    $pin = $_POST['pin'];
    $state = $_POST['state'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $area = $_POST['area'];
    $sms_reminder = $_POST['sms_reminder'];
    $type_bill = $_POST['type_bill'];
    $gstno = $_POST['gstno'];
    $com_number = $_POST['com_number'];
    $type_cycle = $_POST['type_cycle'];
    $conn = connect();
$update = mysqli_query($conn, "UPDATE OPERATOR SET Operator_Comp_name = '".san_sqli(1, $c_name,$conn)."', Operator_Login_Id='".san_sqli(1, $user_id,$conn)."', Operator_Password='".san_sqli(1, $user_pass)."', Contact_Name='".san_sqli(1, $o_name,$conn)."', Contact_Number='".san_sqli(1, $mobile,$conn)."', City='".san_sqli(1, $city,$conn)."', Pin_code='".san_sqli(1, $pin,$conn)."', OP_STATE='".san_sqli(1, $state,$conn)."', Operator_Addr='".san_sqli(1, $address,$conn)."', OP_Email_Id='".san_sqli(1, $email,$conn)."', OP_AREA='".san_sqli(1, $area,$conn)."', Reminder_SMS='".san_sqli(1, $sms_reminder,$conn)."', Operator_Bill_Type='".san_sqli(1, $type_bill,$conn)."', subscription_cycle='".san_sqli(1, $type_cycle,$conn)."', GSTIN='".san_sqli(1, $gstno,$conn)."', COMPAINT_NUMBER='".san_sqli(1, $com_number,$conn)."' WHERE Operator_id = '".san_sqli(1, $id,$conn)."'");
                                  
    header("Location:full_operator_details.php");
    close($conn);
}else{
    $id = $_GET['id'];
    $c_name = $_POST['c_name'];
    $user_id = $_POST['user_id'];
    $user_pass = $_POST['user_pass'];
    $o_name = $_POST['o_name'];
    $mobile = $_POST['mobile'];
    $city = $_POST['city'];
    $pin = $_POST['pin'];
    $state = $_POST['state'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $area = $_POST['area'];
    $sale_person = $_POST['sale_person'];
    $type_bill = $_POST['type_bill'];
    $gstno = $_POST['gstno'];
    $com_number = $_POST['com_number'];
    $type_cycle = $_POST['type_cycle'];
    $conn = connect();
$update = mysqli_query($conn, "UPDATE OPERATOR SET Operator_Comp_name = '".san_sqli(1, $c_name,$conn)."', Operator_Login_Id='".san_sqli(1, $user_id,$conn)."', Operator_Password='".san_sqli(1, $user_pass,$conn)."', Contact_Name='".san_sqli(1, $o_name,$conn)."', Contact_Number='".san_sqli(1, $mobile,$conn)."', City='".san_sqli(1, $city,$conn)."', Pin_code='".san_sqli(1, $pin,$conn)."', OP_STATE='".san_sqli(1, $state,$conn)."', Operator_Addr='".san_sqli(1, $address,$conn)."', OP_Email_Id='".san_sqli(1, $email,$conn)."', OP_AREA='".san_sqli(1, $area,$conn)."', Operator_Bill_Type='".san_sqli(1, $type_bill,$conn)."', subscription_cycle='".san_sqli(1, $type_cycle,$conn)."', GSTIN='".san_sqli(1, $gstno,$conn)."', COMPAINT_NUMBER='".san_sqli(1, $com_number,$conn)."' WHERE Operator_id = '".san_sqli(1, $id,$conn)."'");
                                   
    header("Location:full_operator_details.php");
    close($conn);
}  
?>
