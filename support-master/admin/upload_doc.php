<?php
//upload.php
include 'functions_doc.php';

error_reporting(E_ERROR | E_PARSE);
if($_FILES["file"]["name"] != ''){
        $oid=$_POST['oid'];
		$file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $tmp_file = $_FILES['file']['tmp_name'];
        $valid_file_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
        $file_extension = getFileExtension($file_name);
        if($file_name) {
            if(in_array($file_extension,$valid_file_formats)) { 
                if($file_size < (1024*1024)) {  
                    include('config_doc.php');              
                    $new_image_name = time().".".$file_extension;
                    if($s3->putObjectFile($tmp_file, $bucket , $new_image_name, S3::ACL_PUBLIC_READ)) {
                        $uploaded_file_path='http://'.$bucket.'.s3.amazonaws.com/'.$oid.'document';
                        echo $uploaded_file_path;
                    }else { 
                        echo $file_upload_message = "<br>File upload to amazon s3 failed!. Please try again.";               
                    }
                }else{
                    echo $file_upload_message = "<br>Maximum allowed image upload size is 1 MB.";
                }
            }else{
                echo $file_upload_message = "<br>This file format is not allowed, please upload only image file.";
            }               
        }
	}
if($_FILES["agent_file"]["name"] != '') {
        $file_name = $_FILES['agent_file']['name'];
                        $file_size = $_FILES['agent_file']['size'];
                        $tmp_file = $_FILES['agent_file']['tmp_name'];
                        $valid_file_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
                        $file_extension = getFileExtension($file_name);
                        if($file_name) {
                            if(in_array($file_extension,$valid_file_formats)) { 
                                if($file_size < (1024*1024)) {  
                                    include('config_doc.php');              
                                    $new_image_name = time().".".$file_extension;
                                    if($s3->putObjectFile($tmp_file, $bucket , $new_image_name, S3::ACL_PUBLIC_READ)) {
                                        $uploaded_file_path='http://'.$bucket.'.s3.amazonaws.com/'.$new_image_name;
                                        echo $uploaded_file_path;
                                        // $file_upload_message .= '<b>Upload File URL:</b>'.$uploaded_file_path."<br/>";
                                        // $file_upload_message .= "<img src='$uploaded_file_path'/>";
                                    } else { 
                                        echo $file_upload_message = "<br>File upload to amazon s3 failed!. Please try again.";               
                                    }   
                                } else {
                                    echo $file_upload_message = "<br>Maximum allowed image upload size is 1 MB.";
                                }
                            } else {
                                echo $file_upload_message = "<br>This file format is not allowed, please upload only image file.";
                            }
                        }
}


?>