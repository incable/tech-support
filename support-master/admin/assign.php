<?php include 'header.php';
$id = $_GET['id'];
?>
<body id="page-top">
    <div id="wrapper">
    	<?php include("sidemenu.php");?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <div class="card mb-1">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Assign Complaint
                    </div>
                    <?php 
		                if (isset($_POST['assignsubmit'])) {
		                    $assigned = $_POST['assigned'];
		                    $complaint = $id;
		                    $conn = connect();
		                    $update = mysqli_query($conn,"UPDATE complaint_to_mobiezy SET assigned_to ='".san_sqli(1, $assigned,$conn)."'WHERE complaint_id = '".san_sqli(1, $complaint,$conn)."'");
		                    close($conn);
		                    if ($update) {
		                        echo '<div class="alert alert-success" role="alert">
		                                 Assigned Successfuly..!
		                              </div>';
		                    }else{
		                        echo '<div class="alert alert-danger" role="alert">
		                                 Not Assigned Please Try Again!
		                              </div>';
		                    }
		                }
		            ?>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="POST" class="login-form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm">
                                            <label for="colFormLabelLg" class="col-form-label col-form-label-md">Select Assign Too</label>
                                            <div class="form-group input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <img src="assets/img/complaint1.png" width="20px"> </span>
                                                </div>
                                                <select class="form-control border-primary" name="assigned" id="assigned" required="">
                                                    <option value="" selected>--select--</option>
                                                    <?php
                                                        try { 
                                                            $conn = connect(); 
                                                            $sql_owner = mysqli_query($conn,"SELECT employee_name,id FROM `crm_handel`");
                                                            close($conn);
                                                        } catch (Exception $e){ 
                                                            close($conn);
                                                            errorPage();
                                                        }
                                                        while($row = mysqli_fetch_array($sql_owner,MYSQLI_ASSOC)){       
                                                            echo "<option ";
                                                            if($_REQUEST["employee_name"] == $row["employee_name"])
                                                            echo ' selected = "selected" ';
                                                            echo " value=\"".$row["id"]."\">".$row["employee_name"]."</option>";
                                                        }  
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-block" name="assignsubmit" id="assignsubmit"> Assign Complaint  </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include 'footer.php';?>