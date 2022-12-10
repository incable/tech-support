<?php
 
require 'db.php';


require_once 'PHPExcel-1.8.2/Classes/PHPExcel/IOFactory.php';
require_once 'PHPExcel-1.8.2/Classes/PHPExcel.php';

 ini_set('max_execution_time', '36000');



if(isset($_POST['submit'])) {

  $operator_id = $_POST['num'];
  $base64_ = $_POST['base64_'];

  $op = "SELECT Operator_id FROM OPERATOR WHERE Operator_id=$operator_id";
  $r2 = $conn->query($op);
  if ($r2->num_rows == 0) {
    header("location:register_nxt_customer.php?error= Operator ID Doesnt Exist");
  }else{
 $set_global="set global local_infile = true";
  $conn->query($set_global);
 

  $result = array("operator_id"=>$operator_id,"pdfinvoice"=>$base64_);
  $str=json_encode($result);
  
//echo $str;
 

 $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://ld3igodwbj.execute-api.us-west-2.amazonaws.com/prod/nxt_upload',
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
 
  $response = curl_exec($curl);
      $json = json_decode($response, true);
      $status = $json['link'];
  //    echo $status;

      if(!empty($status))
      {
              $outpath='https://banners-cableguy.s3.us-west-2.amazonaws.com/1.csv';
  $sql="LOAD DATA LOCAL INFILE  '$status'
  INTO TABLE NXT_STAGING
  FIELDS TERMINATED BY ','            
  ENCLOSED BY '\"'
  LINES TERMINATED BY '\r\n'
  IGNORE 1 ROWS
  (CUSTOMER_ID, @CUSTOMER_CREATED_DATE, FIRST_NAME, SURNAME, ADDRESS1, ADDRESS2, ADDRESS3, MOBILENO, 
  PINCODE, EMAIL, CUSTOMER_STATUS, CUSTOMER_CLASS, CUSTOMER_TYPE, STB, CPID, PACKAGE_NAME, CONTRACT_ID, 
  @CONTRACT_START_DATE, CONTRACT_STATUS, PACKAGE_TYPE,  @EXPIRY_DATE, LCO_ID, LCO_CODE, LCO_NAME, 
  LCO_DISTRICT, LCO_STATE, @OPERATOR_ID)

  SET 
  CUSTOMER_CREATED_DATE = STR_TO_DATE(@CUSTOMER_CREATED_DATE, '%m/%d/%Y %h:%i:%s %p'),
  CONTRACT_START_DATE = STR_TO_DATE(@CONTRACT_START_DATE, '%m/%d/%Y %h:%i:%s %p'),
  
  EXPIRY_DATE = DATE_FORMAT(STR_TO_DATE(@EXPIRY_DATE,'%m/%d/%Y'), '%Y-%m-%d'),
  
 
  OPERATOR_ID = $operator_id";
 
  
  $before_start = "DELETE from NXT_STAGING where FIRST_NAME='' OR FIRST_NAME IS NULL;";
  // EXPIRY_DATE = STR_TO_DATE(@EXPIRY_DATE, '%m/%d/%Y %h:%i:%s %p'),
 

  $insNXT="INSERT INTO NXT
  SELECT *
  FROM NXT_STAGING
  WHERE PACKAGE_TYPE = 'Base Packs' 
  GROUP BY CUSTOMER_ID having Max(EXPIRY_DATE) and PACKAGE_TYPE = 'Base Packs';";

 /* $insMissing="INSERT INTO NXT 
  SELECT  *
  FROM NXT_STAGING
  WHERE CUSTOMER_ID NOT IN (SELECT CUSTOMER_ID FROM NXT)
  GROUP BY CUSTOMER_ID having Max(EXPIRY_DATE);";*/


   $insMissing="INSERT INTO NXT 
  SELECT DISTINCT *
  FROM NXT_STAGING
  WHERE CUSTOMER_ID NOT IN (SELECT CUSTOMER_ID FROM NXT)
  GROUP BY CUSTOMER_ID;";
  /*$insert ="
  INSERT INTO AREA(area_name,pincode,city,state,operator_id) 
  SELECT DISTINCT ADDRESS1, PINCODE, LCO_DISTRICT, LCO_STATE, OPERATOR_ID
  FROM NXT
  WHERE ADDRESS1 NOT IN(SELECT area_name FROM AREA);
  "; */

    $nxtCustStatus="update rupayee.NXT A
  set A.CUSTOMER_STATUS = 'Suspended' where A.CUSTOMER_STATUS='Disconnected'";

    $insert ="
  INSERT INTO AREA(area_name,pincode,city,state,operator_id) 
  SELECT DISTINCT LCO_DISTRICT, PINCODE, LCO_DISTRICT, LCO_STATE, OPERATOR_ID
  FROM NXT
  ";
 /* $update = "update NXT A
  set A.AREA_ID = (SELECT id from rupayee.AREA where A.ADDRESS1 = area_name);";*/
  /*  $update = "update NXT A
  set A.AREA_ID = (SELECT id from AREA where A.LCO_DISTRICT = area_name AND operator_id=4);";*/
   $update = "UPDATE  NXT A,AREA B SET A.AREA_ID=B.id where A.LCO_DISTRICT=B.area_name and A.OPERATOR_ID=B.operator_id and B.OPERATOR_ID='$operator_id'";


  /*$custInsert = "INSERT INTO CUSTOMER(CUSTOMER_ID,AGREEMENT_NO,NAME,ADDRESS,PHONE,ZIPCODE,SERVICE_STATUS,STB,CITY,STATE,OPERATOR_ID,AREA_ID)
  SELECT DISTINCT CUSTOMER_ID,CUSTOMER_ID,CONCAT(`FIRST_NAME`, ' ', `SURNAME`) as NAME,ADDRESS1,MOBILENO,PINCODE,CUSTOMER_STATUS,STB,LCO_DISTRICT,LCO_STATE,OPERATOR_ID,AREA_ID
  FROM NXT
  ;";*/
  $custInsert = "INSERT INTO CUSTOMER(CUSTOMER_ID,AGREEMENT_NO,NAME,ADDRESS,PHONE,ZIPCODE,SERVICE_STATUS,STB,CITY,STATE,OPERATOR_ID,AREA_ID)
  SELECT DISTINCT CUSTOMER_ID,CUSTOMER_ID,CONCAT(`FIRST_NAME`, ' ', `SURNAME`) as NAME,CONCAT(`ADDRESS1`, ' ', `ADDRESS2`),MOBILENO,PINCODE,CUSTOMER_STATUS,STB,LCO_DISTRICT,LCO_STATE,OPERATOR_ID,AREA_ID
  FROM NXT
  ;";

 /* $custArea = "UPDATE CUSTOMER C
  SET C.AREA = (SELECT area_name FROM AREA WHERE C.AREA_ID=id);";


  $nxtCust="update rupayee.NXT A
  set A.CUST_NUM = (SELECT CUST_NUM from rupayee.CUSTOMER where A.CUSTOMER_ID = CUSTOMER_ID);";
*/


  $custArea = "UPDATE CUSTOMER C
  SET C.AREA = (SELECT area_name FROM AREA WHERE C.AREA_ID=id and C.operator_id = $operator_id) where C.operator_id = $operator_id;";


  $nxtCust="update rupayee.NXT A
  set A.CUST_NUM = (SELECT CUST_NUM from rupayee.CUSTOMER where operator_id = $operator_id AND A.CUSTOMER_ID = CUSTOMER_ID);";

  $stb_master = "INSERT INTO STB_MASTER(STB_NUMBER,VC_NUMBER,PRE_END_DATE,SERVICE_STATUS,OPERATOR_ID,CUST_NUM,DISABLE,SUBS_PLAN_ID)
  SELECT DISTINCT STB,STB,EXPIRY_DATE,CUSTOMER_STATUS,OPERATOR_ID,CUST_NUM,'N','1000268007'
  FROM NXT;";

  $package_master = "insert into PACKAGE_MASTER(PKG_ID, STB_ID, SUBS_PLAN_ID, CRTS_TS, PROD_ID, START_DATE, END_DATE, STATUS)
  select null, STB_ID, '1000268007',now(),'1',now(),now(), 'Active' from STB_MASTER
  where operator_id = $operator_id;";

    $cbd = "insert into cust_bill_detail
select 
null, cust_num, '0', '0', month(now()), '0', '0', '0', '0', '0', '0', '0', 
'initial load', '1', now(), 1, now(), 'N', 'N', null, '0'
from CUSTOMER
  where operator_id = $operator_id;";

  

$deleteStaging = "DELETE FROM NXT_STAGING;";
$deleteMain = "DELETE FROM NXT;";


  $r1=$conn->query($sql);
  $rr2=$conn->query($before_start);
  $rNXT=$conn->query($insNXT);

   $r11=$conn->query($nxtCustStatus);
  $rMissing=$conn->query($insMissing);
   $r2=$conn->query($insert);

   $r3=$conn->query($update);
   $r4=$conn->query($custInsert);
   $rArea = $conn->query($custArea);

   $r5=$conn->query($nxtCust);
   $r6=$conn->query($stb_master);
   $r7=$conn->query($package_master);

   $r9=$conn->query($cbd);

  $r8=$conn->query($deleteStaging);


$r10=$conn->query($deleteMain);
  
  if($r1 && $rNXT && $rMissing && $r2 && $r3 && $r4 && $r5 && $r6 && $r7 && $r8 && $rArea){
    header("location:register_nxt_customer.php?Success= Data added into tables successfully");

  }else{
      header("location:register_nxt_customer.php?error1=something went wrong");

      echo $conn->error;
  } 
  $conn->close(); 




   
 unlink($file);
unlink($outpath);
  
  $conn->close(); 
      }
      else
      {
          header("location:register_nxt_customer.php?error1=error upload Try Again....");

      }

curl_close($curl);
echo $response;
 




  

}

}
?>
