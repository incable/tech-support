<?php 
include("../includes_wap/wap.php");
    include("../auth_admin.php");
    include("../dbConnect.php");
    use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

    $employee_name = $_SESSION['employee_name'];
  	$email = $_SESSION['email'];
  	$phone = $_SESSION['phone'];
  	$employeeid = $_SESSION['id'];
  	
    $start_date = date('Y-m-d');
    $active = "Y";
    if (isset($_POST['submit'])){
	  
			 $oid=$_POST['oid']; 
			   $conn = connect();
        $select_list = mysqli_query($conn,"SELECT * FROM OPERATOR WHERE Operator_id ='$oid' ");
        close($conn);
        $names = mysqli_fetch_assoc($select_list);
      
      $Operator_id=$names[Operator_id];
     
         $Contact_Number=$names[Contact_Number];
          $Contact_Name=$names[Contact_Name];
           $OP_Email_Id=$names[OP_Email_Id];
           $data = array();
	 
		$data['name']=$Contact_Name;
		$data['email']=$OP_Email_Id;
		$data['notification_type']="true";

		$data['udf1']="NEW";

           	 	$result = array("userId"=>$Operator_id,"phoneNumber"=>$Contact_Number,"countryCode"=>"+91","traits"=>$data,"tags"=>["NEW OPERATOR"]);
	 $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.interakt.ai/v1/public/track/users/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($result),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic M3VuOXYtWGRrdC1Pd0txWTdBNzNxb0YwMTBBVHZfak1GMnNxb2xqalk4bzo=',
    'Content-Type: application/json',
    'Cookie: ApplicationGatewayAffinity=a8f6ae06c0b3046487ae2c0ab287e175; ApplicationGatewayAffinityCORS=a8f6ae06c0b3046487ae2c0ab287e175'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
  header("Location:send_email.php");
/*
if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
    header("Location:full_nxt_details.php");
    close($conn);
} else {
  echo "Error updating record: " . $conn->error;
}*/

		     
		 
	}

   if (isset($_POST['submit1'])){
    
       
       $oid=$_POST['oid']; 
         $conn = connect();
        $select_list = mysqli_query($conn,"SELECT RO.USER_ID,RO.PASSWORD,O.Contact_Name,O.OPERATOR_ID,O.MSO_ID,O.OP_Email_Id,IF(O.OP_Email_Id is null,'E','S')isemailAvailable,
CASE
    WHEN O.MSO_ID = 0 THEN 'http://c2.mobiezy.in'
    WHEN O.MSO_ID = 3 THEN 'http://mc.mobiezy.in/'
     WHEN O.MSO_ID = 4 THEN 'http://nxt.mobiezy.in'
    WHEN O.MSO_ID = 5 THEN 'http://incable.mobiezy.in/'
    ELSE 'http://c2.mobiezy.in'
END as URL
FROM OPERATOR O,AGENT AG,ROLE_USER RO
 WHERE O.OPERATOR_ID='$oid' and AG.OPERATOR_ID=O.OPERATOR_ID and AG.user_type='webadmin'
 and AG.Agent_Id=RO.Agent_Id;
   ");
        close($conn);
        $names = mysqli_fetch_assoc($select_list);
        if($names['isemailAvailable']=="S")
        {
              $email = $names['OP_Email_Id'];
              $name=$names['Contact_Name'];
    $subject = 'Your Mobiezy Login Credentials';
    $message = $_POST['message'];
    $USER_ID=$names['USER_ID'];
    $PASSWORD=$names['PASSWORD'];
     $url=$names['URL'];

   
    //Load composer's autoloader

    $mail = new PHPMailer(true);                            
    try {
        //Server settings 
        $mail->isSMTP();            
           $pp =  san_sqli(1, 'yTPWufq0tb7f', $conn);
           $mail->SMTPDebug = "3";                          
        $mail->Host = 'smtp.zoho.com';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = 'info@mobiezy.com';     
        $mail->Password = $pp;             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                   

        //Send Email
        $mail->setFrom('info@mobiezy.com','Team Mobiezy');
        
        //Recipients
        $mail->addAddress($email);              
        $mail->addReplyTo('raghavendra@mobiezy.com');
        
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = "<p>Dear <b>$name</b>, Welcome to the Mobiezy family. We are delighted to have you as a customer. Our team has finished setting up your account. Your Login credentials are as below</p>
        <br><h3>Login: <b>$USER_ID</b><br>
Password: <b>$PASSWORD</b><br>
Web URL: <b>$url</b><br></h3><p><b>Below are the Mobile App Links:
</b></p><h3><p><b>Collection Agent Mobile App Link: https://play.google.com/store/search?q=mobicable&c=apps</b><br><b>Customer App Playstore Link: https://play.google.com/store/apps/details?id=com.mobiezy.cablecustomer<br>
Customer App AppStore Link: https://apps.apple.com/in/app/mobiezy/id1531512582</b><br></h3>
<h4>If you have any questions, please respond to this message or contact us at the numbers listed below. Please save our below mentioned phone numbers for future communication.<br>Mobiezy Support Team:<br>Phone: 8088835000 / 9071277800 / 9008923939</h4></p><br><p>
   <h4>Thanks & Regards<br><b>Raghavendra Ganiga</b><br>
<img height='38' width='85' src='https://banners-cableguy.s3.us-west-2.amazonaws.com/mobiezyLogo.png'></h4>#280, 3rd Floor, SLV Arcade, Kathriguppe Circle<br>
Outer Ring Road,  BSK 3rd Stage,<br>
Bengaluru-85<br>
Phone: +91 9886522612<br>
www.mobiezy.com
</p>";

        $mail->send();
    
       $_SESSION['result'] = 'Message has been sent';
     $_SESSION['status'] = 'ok';
     header("location: send_email.php");
    } catch (Exception $e) {
     $_SESSION['result'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
     $_SESSION['status'] = 'error';
    }
        }  
        else
        {
          echo "Email Not Available";
        }
     
  }
?>