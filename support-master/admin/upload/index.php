<?php 
error_reporting(0);
include('header.php');
include('functions.php');
$file_upload_message = '';
if(isset($_POST["upload_files"])) {
	$file_name = $_FILES['upload_file']['name'];
	$file_size = $_FILES['upload_file']['size'];
	$tmp_file = $_FILES['upload_file']['tmp_name'];
	$valid_file_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
	$file_extension = getFileExtension($file_name);
	if($file_name) {
		if(in_array($file_extension,$valid_file_formats)) { 
			if($file_size < (1024*1024)) {	
				include('config.php');				
				$new_image_name = time().".".$file_extension;
				if($s3->putObjectFile($tmp_file, $bucket , $new_image_name, S3::ACL_PUBLIC_READ)) {
					$file_upload_message = "File Uploaded Successfully to amazon S3.<br><br>";	
					$uploaded_file_path='http://'.$bucket.'.s3.amazonaws.com/'.$new_image_name;
					$file_upload_message .= '<b>Upload File URL:</b>'.$uploaded_file_path."<br/>";
					$file_upload_message .= "<img src='$uploaded_file_path'/>";
				} else { 
					$file_upload_message = "<br>File upload to amazon s3 failed!. Please try again.";				
				} 	
			} else {
				$file_upload_message = "<br>Maximum allowed image upload size is 1 MB.";
			}
		} else {
			$file_upload_message = "<br>This file format is not allowed, please upload only image file.";
		}
	} else {
		$file_upload_message = "<br>Please select image file to upload.";
	}
}
?>
<title>phpzag.com : Demo Amazon S3 File Upload using PHP</title>
<?php include('container.php');?>
<div class="container">	
	<h2>Amazon S3 File Upload using PHP</h2>	
	<br>		
	<form action="" method='post' enctype="multipart/form-data">
		<h3>Upload Image</h3><br/>
		<input type='file' name='upload_file'/> 
		<br>
		<input type='submit' name="upload_files" value='Upload'/>	
	</form>
	<?php 
	if($file_upload_message) {
		echo $file_upload_message;
	}
	?>	
	<div style="margin:50px 0px 0px 0px;">
		<a class="btn btn-default read-more" style="background:#3399ff;color:white" href="http://www.phpzag.com/amazon-s3-file-upload-using-php">Back to Tutorial</a>		
	</div>
	
</div>
<?php include('footer.php');?>
