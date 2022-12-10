<?php include("header.php");
   	$id = $_GET['id'];
    $conn =connect();
    $query1 = mysqli_query($conn, "SELECT count(*) AS register FROM complaint_to_mobiezy WHERE complaint_status = 'registered' ");
    $data1 = mysqli_fetch_array($query1);
    $query2 = mysqli_query($conn, "SELECT count(*) AS view FROM complaint_to_mobiezy WHERE complaint_status = 'viewed' OR complaint_status = 'pending' ");
    $data2 = mysqli_fetch_array($query2);
    $query3 = mysqli_query($conn, "SELECT count(*) AS complete FROM complaint_to_mobiezy WHERE complaint_status = 'completed' ");
    $data3 = mysqli_fetch_array($query3);
?>
<link href="include/css/fixedHeader.dataTables.min.css" rel="stylesheet">
<link href="include/css/jquery.dataTables.min.css" rel="stylesheet">
<body id="page-top">
    <div id="wrapper">
    	<?php include("sidemenu.php");?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <div class="card text-dark bg-light mb-1">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        View Complaints 
                    </div>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-danger active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Register <?php echo $data1['register']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Viewed <?php echo $data2['view']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Completed <?php echo $data3['complete']; ?></a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Complaint ID</th>
                                            <th>Status</th>
                                            <th>Operator ID</th>
                                            <th>Complaint Date</th>
                                            <th>System Type</th>
                                            <th>Complaint Type</th>
                                            <th>Assigned to</th>
                                            <th>View Complaint</th>
                                            <th>Source</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $conn = connect();
                                            $query = mysqli_query($conn, "SELECT * FROM complaint_to_mobiezy inner join crm_handel on id = assigned_to inner join system_complaint sc on sc.sys_complaint_id = complaint_of WHERE complaint_status = 'registered' ORDER BY complaint_date DESC");
                                            close($conn); 
                                            while ($data = mysqli_fetch_array($query)) {
                                                echo '<tr>
                                                        <td>'.$data['complaint_id'].'</td>
                                                        <td class="text-danger font-weight-bold">'.$data['complaint_status'].'</td>
                                                        <td>'.$data['operator_id'].'</td>
                                                        <td>'.$data['complaint_date'].'</td>
                                                        <td>'.$data['system_name'].'</td>
                                                        <td>'.$data['complaint_type'].'</td>
                                                        <td>'.$data['employee_name'].'</td>
                                                        <td>
                                                            <a class="btn btn-primary dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Actions
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="view_complaint.php?id='.$data['complaint_id'].'">View Complaint</a>
                                                                <a class="dropdown-item" href="assign.php?id='.$data['complaint_id'].'">Assign Complaint</a>
                                                            </div>
                                                        </td>
                                                        <td>'.$data['source'].'</td>
                                                    </tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Complaint ID</th>
                                            <th>Status</th>
                                            <th>Operator ID</th>
                                            <th>Complaint Date</th>
                                            <th>Assigned to</th>
                                            <th>View Complaint</th>
                                            <th>Source</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $conn = connect();
                                            $query = mysqli_query($conn, "SELECT * FROM complaint_to_mobiezy inner join crm_handel on id = assigned_to WHERE complaint_status = 'viewed' OR complaint_status = 'pending'");
                                            close($conn); 
                                            while ($data = mysqli_fetch_array($query)) {
                                                echo '<tr>
                                                        <td>'.$data['complaint_id'].'</td>
                                                        <td class="text-warning font-weight-bold">'.$data['complaint_status'].'</td>
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
                                                        <td>'.$data['source'].'</td>
                                                    </tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Complaint ID</th>
                                            <th>Status</th>
                                            <th>Operator ID</th>
                                            <th>Complaint Date</th>
                                            <th>Complaint</th>
                                            <th>Response Date</th>
                                            <th>Response</th>
                                            <th>Assigned to</th>
                                            <th>Source</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $conn = connect();
                                            $query = mysqli_query($conn, "SELECT * FROM complaint_to_mobiezy inner join crm_handel on id = assigned_to WHERE complaint_status = 'completed' ORDER BY closuredate DESC ");
                                            close($conn); 
                                            while ($data = mysqli_fetch_array($query)) {
                                                echo '<tr>
                                                        <td>'.$data['complaint_id'].'</td>
                                                        <td class="text-success font-weight-bold">'.$data['complaint_status'].'</td>
                                                        <td>'.$data['operator_id'].'</td>
                                                        <td>'.$data['created_date'].'</td>
                                                        <td>'.$data['complaint_description'].'</td>
                                                        <td>'.$data['modified_date'].'</td>
                                                        <td>'.$data['mobiezy_comment'].'</td>
                                                        <td>'.$data['employee_name'].'</td>
                                                        <td>'.$data['source'].'</td>
                                                    </tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("footer.php");?>
<script>
$(document).ready(function() {
    $('table.display').DataTable( {
        fixedHeader: {
            header: true,
            footer: true
        }
    } );
} );
</script>