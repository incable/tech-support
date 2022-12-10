<?php include("header.php");
 include("db.php");
// include("../dbConnect.php");
// $employee_name = $_SESSION['employee_name'];
// $email = $_SESSION['email'];
// $phone = $_SESSION['phone'];
// $employeeid = $_SESSION['id'];

?>
 
<style>
  .dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
  }

  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content a:hover {
    background-color: #ddd;
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  .dropdown:hover .dropbtn {
    background-color: #3e8e41;
  }
</style>

<body id="page-top">
  <div id="wrapper">
    <?php include("sidemenu.php"); ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- DataTables Example -->
        <div class="card text-dark bg-light mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            INDIGITALS
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive">
              <?php  
              $sql = "select Operator_id,Operator_Comp_name from OPERATOR where MSO_ID = 5";
              $res = mysqli_query($conn,$sql);
              ?>
<form action="" method="POST">

<div class="form-group">
<label for="opid" >Select Operator ID</label>
    <select class="form-control js-example-basic-multiple" name="opid" id="red">
                                <option value="">--SELECT--</option>
              <?php
        while($row = mysqli_fetch_assoc($res)){
              ?>
                                <option value="<?php echo $row['Operator_id'] ?>"><?php echo $row['Operator_id']."  --->  ".$row['Operator_Comp_name'] ?></option>
                  <?php
        }
                  ?>
                                
                
                            </select>
</div>
<br>
Box id : <input type="text" name="boxid"/>
<br>
<input type="submit" name="submit" value="submit"/>

      </form>

      <?php
  if(isset($_POST['submit'])){
    $id = $_POST['opid'];
    $boxid = $_POST['boxid'];
    echo "<script>console.log('Debug Objects: " . $id . "' );</script>";
    $sql = "select Operator_id,Merchant_Id,Merchant_Salt,Merchant_Key,MSO_ID from OPERATOR where Operator_id = '".san_sqli(1, $id)."'";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);
     $operid = $row['Operator_id'];
     $merid = $row['Merchant_Id'];
     $mersalt = $row['Merchant_Salt'];
     $merkey = $row['Merchant_Key'];
     echo "<script>console.log('key: " . $merkey . "' );</script>";
     $msoid = $row['MSO_ID'];
            ?>

<table class="table">
    <thead>
      <tr>
        <th>OPERATOR ID</th>
        <th>Merchant_Id</th>
        <th>Merchant_Salt</th>
        <th>Merchant_Key</th>
        <th>BOX ID</th>
        <th>action</th>
        
      </tr>
    </thead>
    <tbody>
 
      <tr>
        <td><?php echo $operid ;  ?></td>
        <td><?php echo $merid ; ?></td>
        <td><?php echo $mersalt ; ?></td>
        <td><?php echo $merkey ; ?></td>
        <td><?php echo $boxid ; ?></td>
        <td><button type="button" id="fetch" class="btn btn-primary">Get Details</button></td>
      </tr>
    
     
    </tbody>
  </table>

    <?php
$arr[] = array(
'frcode'=>$mersalt,
'frcan'=>$merid,
'in_id'=>$boxid,
'owner_id'=>$operid,
'MSO'=>$msoid

);

$req = json_encode($arr[0]);
//echo $req;
   }
  
      ?>



<table id="tableID" class="display" 
        style="width:100%">
        <h2 id="b">BOUQUET</h2>     
        <thead>
            <!--Required column headers 
                for employee -->
            <tr>
                <th>bouquet_id</th>
                 <th>bouquet_name</th>
               <th>bouquet_price</th>
                <th>start_date</th>
                <th>expiry_date</th>
                <th>contract_id</th>
                 <th>status</th>
            </tr>
        </thead>
    </table>


    

<table id="tableID1" class="display" 
        style="width:100%">
        <h2 id="c">CHANNEL</h2>    
        <thead>
            <!--Required column headers 
                for employee -->
            <tr>
                <th>channel_id</th>
                 <th>channel_name</th>
              <th>start_date</th>
                  <th>expiry_date</th>
                <th>contract_id</th>
                <th>status</th> 
               
            </tr>
        </thead>
    </table>





            </div>





          </div>
        </div>
      </div>
    </div>
  </div>

  



</body>
<?php
 include("footer.php");
 ?>

 


  <script type="text/javascript">
  $(document).ready(function() {
    $('#tableID1').hide();
     $('#tableID').hide();
     $('#b').hide();
     $('#c').hide();
    var request = '<?php echo $req;   ?>';
 // var request = {"frcode":"FR5125","frcan":"20893551","in_id":"27138231","owner_id":"8345","MSO":"5"};
 console.log(request);
   $("#fetch").click(function() {
    console.log("ghghgh");
    $.ajax({
      type:"POST",
      url:"http://c2.mobiezy.in/api/b2c/support_pack.php",
      
      data: request,
      success:function(result){ 
        console.log(result);
        var data = JSON.parse(result);
        $.fn.dataTable.ext.errMode = 'none';
       
     $('#tableID').show();
     $('#b').show();
        $('#tableID').DataTable({
                "processing": true,
  
                /* Disabled features for not 
                showing extra info */
                "info": true,
                "ordering": true,
                "paging": true,
                "data": data.bouquet,
                "columns": [
                                         
                    { "data": "bouquet_id"},
                    {"data": "bouquet_name"},
                     {"data": "bouquet_price"},
                     {"data": "start_date"},
                     {"data": "expiry_date"},
                     {"data": "contract_id"},
                     {"data": "status"}
                   
                ]
            });

            $('#tableID1').show();
            $('#c').show();
            $('#tableID1').DataTable({
                "processing": true,
  
                /* Disabled features for not 
                showing extra info */
                "info": true,
                "ordering": true,
                "paging": true,
                "data": data.channels,
                "columns": [
                                         
                    { "data": "channel_id"},
                    {"data": "channel_name"},
                     {"data": "start_date"},
                     {"data": "expiry_date"},
                     {"data": "contract_id"},
                     {"data": "status"}
                   
                ]
            });
          
      
      }
    })
  });
  })
</script>

