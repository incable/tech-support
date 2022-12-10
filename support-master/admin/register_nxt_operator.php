<?php include("header.php");
    // include("../auth_admin.php");
    // include("../dbConnect.php");
    // $employee_name = $_SESSION['employee_name'];
    // $email = $_SESSION['email'];
    // $phone = $_SESSION['phone'];
    // $employeeid = $_SESSION['id'];
?>

<body id="page-top">
    <div id="wrapper">
    <?php include("sidemenu.php");?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- DataTables Example -->
                <div class="card text-dark bg-light mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Register NXT Operator
                    </div>
                    <div class="card-body">
                        <form action="action.php" method="GET" class="login-form">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Enter Network name</label>
                                        <div class="col-md-9">
                                            <input type="type" class="form-control"  name="networkName" id="networkName" required> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Owner Name</label>
                                        <div class="col-md-9">
                                            <input type="type" class="form-control"  name="operatorName" id="operatorName" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile No</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control"  name="phoneNumber" id="phoneNumber" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Enter Email</label>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control"  name="email" id="email" required> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <div class="col-md-9">
                                            <input type="type" class="form-control"  name="city" id="city" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"  name="state" id="state" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>LCO Code</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"  name="lco_code" id="lco_code" title="LCO200011702.01" required> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>LCO ID </label>
                                        <div class="col-md-9">
                                            <input type="type" class="form-control"  name="lco_id" id="lco_id" title="LCO200011702"required>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Login ID  </label>
                                        <div class="col-md-9">
                                            <input type="type" class="form-control"  name="login_id" id="login_id" required>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <div class="col-md-9">
                                            <input type="type" class="form-control"  name="password" id="password" required>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sales Person</label>
                                        <div class="col-md-9">
                                            <input type="type" class="form-control"  name="sales" id="sales" required>
                                        </div>
                                    </div>
                                </div>
                                   <div class="col-md-4">
                                    <div class="form-group">
                                        <label>GST NO</label>
                                        <div class="col-md-9">
                                            <input type="type" class="form-control"  name="gst" id="gst">
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>OPERATOR TYPE</label>
                                        <select class="form-control" id="sub_main_eligible" name="sub_main_eligible" required>
                                                <option value="" disabled selected>Choose your option</option>
                                                 <option value="N">DIRECT ACCOUNT</option>
                                                  <option value="Y1">MAIN_LCO</option>
                                                     <option value="Y">SUB_LCO</option>
                                            </select>
                                    </div>
                                </div>
                                  <div class="col-md-4" style="display: none;">
                                    <div class="form-group">
                                        <label>SUB/MAIN LCO</label>
                                        <input type="sub_main" class="form-control" id="sub_main" name="sub_main" required>
                                       
                                    </div>
                                </div>
                                 <div id="mainop1" class="col-md-4">
                                    <div class="form-group">
                                        <label>Main Operator_id</label>
                                        <input type="number" class="form-control"  name="mainop" id="mainop">
                            
                                    </div>
                                </div>
                              
                              

                                
                            </div>
                    
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-info btn-block" value="submit" name="submit" id="submit">Submit</button>
                                </div>
                            </div>
                             <?php

            if(isset($_GET['success'])){
            echo "<h2 id='success'>Data inserted successfully</h2>";
            }
              
        ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(){
    $("#sub_main_eligible").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue=="N")
            {
                  $("#mainop").val("");

                $("#sub_main").val("N");
                $("#mainop").val("0"); 
                 $("#mainop1").hide();
            }
            else if(optionValue=="Y")
            {
 
                 $("#mainop").val(""); 
             $("#sub_main").val("Y"); 
                $("#mainop1").show();  
            }
             else if(optionValue=="Y1")
            {
                  $("#mainop").val("");
             $("#sub_main").val("N"); 
             $("#mainop").val("0");  
                $("#mainop1").hide();

            }
           /* if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".box").hide();
            }*/
            console.log(optionValue);
        });
    }).change();
});</script>
<?php include("footer.php"); ?>