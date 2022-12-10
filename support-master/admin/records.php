<?php include("header.php");
$id = $_GET['id']; 
?>

<body id="page-top">
    <div id="wrapper">
    	<?php include("sidemenu.php");?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <div class="card text-dark bg-light mb-1">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        View Records
                    </div>
                </div>
                <div class="card mb-3">
                	<div class="row">
                		<div class="col-md-4">
                            <?php
                                $conn = connect();
                                $query = mysqli_query($conn,"SELECT count(assigned_to) AS counts FROM complaint_to_mobiezy WHERE complaint_status = 'registerd' AND assigned_to = '".san_sqli(1, $id,$conn)."'");
                                close($conn);
                                $data = mysqli_fetch_array($query,MYSQLI_ASSOC);  
                            ?>
                			<label for="colFormLabelLg" class="col-form-label font-weight-bold col-form-label-md">Registerd Complaints:</label>
                			<label for="colFormLabelLg" class="btn col-form-label col-form-label-md btn-danger"><?php echo $data['counts'];?></label>

                		</div>
                        <div class="col-md-4">
                            <?php
                                $conn = connect();
                                $query = mysqli_query($conn,"SELECT count(assigned_to) AS counts FROM complaint_to_mobiezy WHERE complaint_status = 'viewed' AND assigned_to = '".san_sqli(1, $id, $conn)."'");
                                close($conn);
                                $data = mysqli_fetch_array($query,MYSQLI_ASSOC);  
                            ?>
                            <label for="colFormLabelLg" class="col-form-label font-weight-bold col-form-label-md">Pending Complaints:</label>
                            <label for="colFormLabelLg" class="btn col-form-label col-form-label-md btn-warning"><?php echo $data['counts'];?></label>

                        </div>
                		<div class="col-md-4">
                			<?php 
                    			$conn = connect();
    							$query = mysqli_query($conn,"SELECT count(assigned_to) AS counts FROM complaint_to_mobiezy WHERE (complaint_status = 'completed') AND assigned_to = '".san_sqli(1, $id,$conn)."'");
    							close($conn);
                                $data = mysqli_fetch_array($query,MYSQLI_ASSOC);
                			?>
                			<label for="colFormLabelLg" class="col-form-label font-weight-bold col-form-label-md">Completed Complaints:</label>
                			<label for="colFormLabelLg" class="btn col-form-label col-form-label-md btn-success"><?php echo $data['counts'];?></label>
                		</div>
                	</div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("footer.php"); ?>