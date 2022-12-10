<?php
 
require 'db.php';


require_once 'PHPExcel-1.8.2/Classes/PHPExcel/IOFactory.php';
require_once 'PHPExcel-1.8.2/Classes/PHPExcel.php';

 ini_set('max_execution_time', '36000');



if(isset($_POST['submit'])) {

  $operator_id = $_POST['num']; 

  $op = "SELECT Operator_id FROM OPERATOR WHERE Operator_id=$operator_id";
  $r2 = $conn->query($op);
  if ($r2->num_rows == 0) {
    header("location:register_b2c_customer.php?error= Operator ID Doesnt Exist");
  }else{
 

  $result = array("operatorId"=>$operator_id,"dmlFlag"=>"GET");
  $str=json_encode($result);
  

 

 $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://ld3igodwbj.execute-api.us-west-2.amazonaws.com/prod/upload_b2c_customer_info',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $str,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));
 // 
  $response = curl_exec($curl);
  $b=json_decode($response);
   curl_close($curl);
    $result = array("operatorId"=>$operator_id,"dmlFlag"=>"POST","cust_info"=>$b);
     $str1=json_encode($result);
     $curl1 = curl_init();

curl_setopt_array($curl1, array(
  CURLOPT_URL => 'https://ld3igodwbj.execute-api.us-west-2.amazonaws.com/prod/copy_b2b_to_b2c',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $str1,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));
 // https://ld3igodwbj.execute-api.us-west-2.amazonaws.com/prod/copy_b2b_to_b2c
  $response1 = curl_exec($curl1);
   curl_close($curl1);
  //  header("location:register_nxt_customer.php?error1=something went wrong");
       $json = json_decode($response1, true);
      $status = $json['p_out_mssg_flg'];

     if($status=="E")
     {
 header("location:register_b2c_customer.php?error1=something went wrong");
     }
     else
     {
       header("location:register_b2c_customer.php?Success=something went wrong");
     } 


      
  
   
 




  

}

}
?>
