 <?php

$curl = curl_init();
$data = array();  
     $data['pkgtype']=$_POST['p_name'];

    $data['sms_lcocode']=$_POST['c_name'];
  
    $data['client']='MOBIEZY';
    $data['apikey']='805bfdbf-62cf-493a-8aa9-6a61090ddff7';
    $str = json_encode($data);
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://mobiezy-api.cableguy.in/sms_client_service/Service1.svc/packagelist',
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
      $results = $json['data'];
//echo json_encode($status); 
      $str=$_POST['c_name']."_".$_POST['p_name'];
 $filename = $str.'.csv';       
      header("Content-type: text/csv");       
      header("Content-Disposition: attachment; filename=$filename");       
      $output = fopen("php://output", "w");       
      $header = array_keys($results[0]);       
      fputcsv($output, $header);       
      foreach($results as $row)       
      {  
           fputcsv($output, $row);  
      }       
      fclose($output);
  //   header("Location: brds_sub.php");
  //exit();    


?>