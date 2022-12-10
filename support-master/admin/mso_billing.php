<?php include("header.php");?>
<script src="assets/js/table2excel.js"></script>

<body id="page-top">
    <div id="wrapper">
    <?php include("sidemenu.php");?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- DataTables Example -->
                <div class="card text-dark bg-light mb-3">
                    <div class="card-header">
                        <i class=""></i>
                        MAIN LCO BILLING
                        
                        <button type="button" class="btn btn-primary float-right" id="excel" >Export to Excel</button>
                    </div> 
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>MAIN OPERATOR ID</th>
                                        <th>COMPANY NAME</th>
                                        <th>NO. Active CUSTOMER</th>
                                        <th>TRANSACTION COUNT</th>
                                        <th>RENEWAL COUNT</th>
                                        <th>CREATED TIME</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $conn =connect();
                                    $query = mysqli_query($conn,"SELECT * from MAIN_LCO_BILL_SUMMARY");
                                    close($conn);
                                    while ($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                                        
                                           echo '<tr>
                                                  <td><center>'.$fetch['main_operator_id'].'</a></center></td>
                                                  <td>'.$fetch['Operator_Comp_name'].'</td>
                                            <td>'.$fetch['active_cust_number'].'</td>
                                            <td>'.$fetch['tran_count'].'</td>
                                                  <td>'.$fetch['renewal_count'].'</td>
                                                  <td>'.$fetch['created_time'].'</td>
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
</body>
<script>                         
$(document).on('click', '#excel', function() { 
	
    var table2excel = new Table2Excel();
      table2excel.export(document.querySelectorAll("#dataTable"));        
              
              
        });

</script>

<?php include("footer.php"); ?>