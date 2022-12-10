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
                        Register NXT Customer Using Upload
                    </div>
                </div>

                <div class="card mb-3">
                
               
                <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                             
 
                                 <form action="upload.php"  method="post" enctype="multipart/form-data" meta charset=UFT-8 > 
                                   <div class="row">
                                        <div class="col-md-3">
                                            <div class="card-header">
                                              UPLOAD CSV:  <input type="file" name="file" class="form-control" accept=".csv" onchange="readURL(this)">
                                            </div>
                                        </div>
                                        <textarea name="base64_"  id="base64_" readonly></textarea>
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
                                <form action="delete.php" method="post"  style="margin-top: 15px;">
                                 <div class="col-md-0" style="display:none;">
                                            <div class="card-header">
   <button type="delete" class="btn btn-danger"name="delete">CLEAR NXT TABLE</button>
 </div></div> </form>

   <?php
    if(isset($_GET['delete'])){
      echo "<h2 id='failed'>Deleted all records in nxt table</h2>";
    }else if(isset($_GET['Success'])){
      echo "<h2 id='success'>Data inserted successfully</h2>";
    }else if(isset($_GET['error'])){
      echo "<h2 id='failed'>Operator ID doesnt exist</h2>";
    }
    else if(isset($_GET['error1'])){
      echo "<h2 id='failed'>Something went wrong..</h2>";
    }
  ?>
                            </div>  </div>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
     <script>
  function readURL(input) {
    if (input.files && input.files[0]) {
    
      var reader = new FileReader();
      reader.onload = function (e) { 
        console.log(e.target.result);
        console.log(e.target.result.indexOf("base64,"))
       var a=e.target.result;
       console.log(a.substr(e.target.result.indexOf("base64,")+7));

      document.getElementById('base64_').value = a.substr(e.target.result.indexOf("base64,")+7);
      };

      reader.readAsDataURL(input.files[0]); 
    }
  }
  </script>


</body>
<?php include("footer.php"); ?>