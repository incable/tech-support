<?php


session_start();
$name           = $_POST['name'];
$net_name       = $_POST['net_name'];
$phone          = $_POST['phone'];
$email_id       = $_POST['email_id'];
$email          ='';
if ($email_id=='') {
  $email='';
}else{
  $email=$email_id;
}
$city           = $_POST['city'];
$state          = $_POST['state'];
$lang_pre       = $_POST['lang_pre'];
$time           = $_POST['time'];
$sales_persons  = $_POST['sales_persons'];
 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.hubapi.com/contacts/v1/contact?hapikey=".$_SESSION['hubspot_key'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_SSL_VERIFYHOST=> false,
  CURLOPT_SSL_VERIFYPEER=>false,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\r\n  \"properties\": [\r\n  
  {\r\n      \"property\": \"email\",\r\n      \"value\": \"$email\"\r\n   
 },\r\n    {\r\n      \"property\": \"firstname\",\r\n      \"value\": \"$name\"\r\n  
  },\r\n    {\r\n      \"property\": \"hubspot_owner_id\",\r\n      \"value\": \"$sales_persons\"\r\n    
},\r\n    {\r\n      \"property\": \"website\",\r\n      \"value\": \"\"\r\n 
   },\r\n    {\r\n      \"property\": \"company\",\r\n      \"value\": \"$net_name\"\r\n    },\r\n  
  {\r\n      \"property\": \"phone\",\r\n      \"value\": \"$phone\"\r\n    },\r\n    {\r\n   
   \"property\": \"address\",\r\n      \"value\": \"\"\r\n    },\r\n    {\r\n     
 \"property\": \"city\",\r\n      \"value\": \"$city\"\r\n    },\r\n    {\r\n     
 \"property\": \"state\",\r\n      \"value\": \"$state\"\r\n    },\r\n    {\r\n   
   \"property\": \"zip\",\r\n      \"value\": \"\"\r\n    }\r\n  ]\r\n}",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}