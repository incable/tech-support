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
    header("location:nxt.php?error= Operator ID Doesnt Exist");
  }else{
 $set_global="set global local_infile = true";
  $conn->query($set_global);
 

  $result = array("operator_id"=>$operator_id,"pdfinvoice"=>$base64_);
  $str=json_encode($result);
  

 

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

      if(!empty($status))
      {
              $outpath='https://banners-cableguy.s3.us-west-2.amazonaws.com/1.csv';
  $sql="LOAD DATA LOCAL INFILE  '$status'
  INTO TABLE NXT_CHANNEL_DATA
  FIELDS TERMINATED BY ','            
  ENCLOSED BY '\"'
  LINES TERMINATED BY '\r\n'
  IGNORE 1 ROWS
  (productid, productname, category, tariff, channels, mrp,@OPERATOR_ID)

  SET  
  OPERATOR_ID = $operator_id";
   


  $before_start = "UPDATE NXT_CHANNEL_DATA SET category='Base Pack FTA',Genre='B' where category='Base Packs'";
  $before_start1 = "UPDATE NXT_CHANNEL_DATA SET category='MSO Bouquet',Genre='A' where category='Add-on'";
  $before_start2 = "UPDATE NXT_CHANNEL_DATA SET category='Pay Channel',Genre='C' where category='A-la-carte'";
 /* $before_start3 = "update NXT_CHANNEL_DATA SET category='MSO Bouquet',Genre='A' where category='StandAlone Add-on'";
  $before_start4 = "UPDATE NXT_CHANNEL_DATA SET category='Pay Channel',Genre='C' where category='StandAlone'";
   $before_start4_ = "UPDATE NXT_CHANNEL_DATA SET category='Pay Channel',Genre='C' where category='Hardware'"; */

   $before_start3 = "DELETE FROM NXT_CHANNEL_DATA where category='StandAlone Add-on'";
      $before_start4 = "DELETE FROM NXT_CHANNEL_DATA where category='StandAlone'";
          $before_start4_ = "DELETE FROM NXT_CHANNEL_DATA where category='Hardware'";
                $before_start4__ = "DELETE FROM NXT_CHANNEL_DATA where category='OTT standalone'";

  $base = "UPDATE NXT_CHANNEL_DATA set base=round(mrp/1.18,2)";
  $tax = "UPDATE NXT_CHANNEL_DATA set tax=Round(mrp-base,2)";

   $move="INSERT INTO SUBSCRIPTION(subs_desc,subs_prc,tax_amnt,subs_grnd_tot_prc,operator_id,crt_ts,subs_status,Customer_flag,pack_type,Genre,subscription_price_type,prod_id)
select productname as subs_desc,base as subs_prc,tax as tax_amnt,mrp as subs_grnd_tot_prc,operator_id as operator_id,now() as crt_ts,'Active' as subs_status,'Y' as Customer_flag,category as pack_type,Genre as Genre,'Total Price with GST' as subscription_price_type,productid as prod_id from NXT_CHANNEL_DATA";

$deleteMain = "DELETE FROM NXT_CHANNEL_DATA;";
  $r1=$conn->query($sql);
  $r2=$conn->query($before_start);

  $r3=$conn->query($before_start1);
  $r4=$conn->query($before_start2);
 $r5=$conn->query($before_start3);
  $r6=$conn->query($before_start4);

  $r6_=$conn->query($before_start4_); 
   $r6__=$conn->query($before_start4__); 

  $r7=$conn->query($base);
  $r8=$conn->query($tax);
  $r9=$conn->query($move);

  
 // $r8=$conn->query($deleteStaging);
  $r10=$conn->query($deleteMain);
  
  if($r1){
    header("location:nxt_subscription.php?Success= Data added into tables successfully");

  }else{
    //  header("location:nxt_subscription.php?error1=something went wrong");

      echo $conn->error;
  } 
  $conn->close(); 

 
  $conn->close(); 
      }
      else
      { echo $conn->error;
        
        //  header("location:register_nxt_customer.php?error1=error upload Try Again....");

      }

curl_close($curl); 



  

}

}
?>
