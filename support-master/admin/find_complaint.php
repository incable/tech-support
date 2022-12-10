<?php include("header.php");
   	$id = $_GET['id'];
    $conn = connect();
    $query = mysqli_query($conn, "SELECT * FROM complaint_to_mobiezy inner join crm_handel on id = assigned_to WHERE assigned_to = '".san_sqli(1, $id,$conn)."' AND (complaint_status = 'registered' OR complaint_status = 'viewed' )");
    close($conn);
?>
<body id="page-top">
    <div id="wrapper">
    	<?php include("sidemenu.php");?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- DataTables Example -->
                <div class="card text-dark bg-light mb-1">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        View Complaints 
                    </div>
                </div>
                <div class="card border-dark mb-1">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                	<tr>
                                		<th>Complait ID</th>
                                		<th>Status</th>
                                		<th>Operator ID</th>
                                		<th>Compalint Date</th>
                                		<th>Assigned to</th>
                                		<th>View Complaint</th>
                                	</tr>
                                </thead>
                                <tbody>
                                	<?php 
                                	$emp = $data['assigned_to'];
                                	$conn = connect();
                                	while ($data = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                                	echo '<tr>
	                                		<td>'.$data['complaint_id'].'</td>
	                                		<td>'.$data['complaint_status'].'</td>
	                                		<td>'.$data['operator_id'].'</td>
	                                		<td>'.$data['complaint_date'].'</td>
	                                		<td>'.$data['employee_name'].'</td>
	                                		<td>
	                                            <a class="btn btn-primary dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                                                Actions
	                                            </a>
	                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
	                                                <a class="dropdown-item" href="view_complaint.php?id='.$data['complaint_id'].'">View Complaint</a>
	                                            </div>
	                                        </td>
                                		</tr>';
                                	} close($conn);?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("footer.php");?>