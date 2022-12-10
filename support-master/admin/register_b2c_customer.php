<?php include("header.php");
header("Content-Type:text/html;charset=utf-8");
    // include("../auth_admin.php");
    // include("../dbConnect.php");
    // $employee_name = $_SESSION['employee_name'];
    // $email = $_SESSION['email'];
    // $phone = $_SESSION['phone'];
    // $employeeid = $_SESSION['id'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<body id="page-top">
    <div id="wrapper">
    <?php include("sidemenu.php");?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- DataTables Example -->
                <div class="card text-dark bg-light mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                     Upload Customer Information to B2C
                    </div>
                </div>

                <div class="card mb-3">
                
               
                <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                             
 
                                 <form action="moveb2c.php"  method="post" enctype="multipart/form-data" meta charset=UFT-8 > 
                                   <div class="row">
                                        
                                         <div class="col-md-3">
                                            <div class="card-header">
                                            ENTER OPERATOR ID:
                                                <input type="type" class="form-control"  name="num" placeholder="Enter Operator Id" title="OPERATOR ID"required> 
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="margin-top: 15px;">
                                             <button type="submit" name="submit" class="btn btn-secondary btn-block btn-lg float-right" style="margin-top:1%;">Upload  Data</button>
                                            </div>
                                  
                                </form>
                              

    
                            </div>
                              <?php
    if(isset($_GET['delete'])){
      echo "<h2 id='failed'>Deleted all records in nxt table</h2>";
    }else if(isset($_GET['Success'])){
      echo "<h2 id='Success'>Data inserted successfully</h2>";
    }else if(isset($_GET['error'])){
      echo "<h2 id='failed'>Operator ID doesnt exist</h2>";
    }
    else if(isset($_GET['error1'])){
      echo "<h2 id='failed'>Something went wrong..</h2>";
    }
  ?>  </div>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
   


</body>
<?php include("footer.php"); ?>