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
          NXT
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive">
              <?php  
              $sql = "select Operator_id,Operator_Comp_name from OPERATOR where MSO_ID = 4";
              $res = mysqli_query($conn,$sql);
              ?>


<div class="form-group">
   <label for="opid" >Select Operator ID</label>
    <select class="form-control js-example-basic-multiple"  id="operatorid">
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

<select id="custnum">
    <option value="">Select customer</option>
</select>


<br>
NXT id : <input type="text" id="nxtid"/>
<br>


      <button id = 'btn'>get</button>


     
     
 </div>

 <h2 id="b">BOUQUET</h2>

<table id="tableID" class="display" 
        style="width:100%">
          
        <thead>
            <!--Required column headers 
                for employee -->
            <tr>
                <th>bouquet_id</th>
                 <th>bouquet_name</th>
                <th>category</th>
                <th>bouquet_price</th>
                <th>expiry_date</th>
                <th>status</th> 
               
            </tr>
        </thead>
    </table>


    <h2 id="c">CHANNEL</h2>

<table id="tableID1" class="display" 
        style="width:100%">
          
        <thead>
            <!--Required column headers 
                for employee -->
            <tr>
                <th>channel_id</th>
                 <th>channel_name</th>
                <th>category</th>
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

  



</body>
<?php
 include("footer.php");
 ?>
<script type="text/javascript">
     $('#tableID1').hide();
     $('#tableID').hide();
     $('#b').hide();
     $('#c').hide();
  $(document).ready(function() {
  var nxtid = $('#nxtid').val();
    $('#operatorid').on('change', function(){
        var operatorid = $(this).val();
        console.log(operatorid);
        if(operatorid){
            $.ajax({
                type:'POST',
                url:'nxtgetdata.php',
                data:'opid='+operatorid,
                success:function(html){
                    $('#custnum').html(html);

                    $('#city').html('<option value="">Select state first</option>'); 
                  
                }
            }); 
        }
       
    });
// get selected value

//var gotid = $('#operatorid').find(":selected").val();
//var cnum = $('#custnum').find(":selected").val();
$("#btn").click(function(){
  var opid = $( "#operatorid option:selected" ).val();
  var cnum = $( "#custnum option:selected" ).val();

  $.ajax({
                      type:'POST',
                      url:'nxtgetdata.php',
                      data:'salt='+opid,
                      success:function(res){
                        console.log(res);
                        var saltkey = $.trim(res);;
                        var nxtid = $('#nxtid').val();
                       
                      //  $('#lcouser').text(saltkey);
                      //  $('#nxtid').text('1234567');
                      //  $('#ownerid').text(opid);
                      //  $('#custnum').text(cnum);
                       var  request = {"lcousername":saltkey,"nxt_id":nxtid,"owner_id":opid,"cust_num":cnum};
                      var rr =  JSON.stringify(request);
                        console.log(rr);

                        $.ajax({
      type:"POST",
      url:"http://c2.mobiezy.in/api/b2c/support_pack.php",
      
      data: rr,
      success:function(rr){ 
        console.log(rr);

        var data = JSON.parse(rr);
     
        $('#tableID').show();
        $('#b').show();
        $('#tableID').DataTable().destroy();
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
                    {"data": "category"},
                    {"data": "bouquet_price"},
                    {"data": "expiry_date"},
                    {"data": "status"}
                    
                   
                ]
            });

           
     $('#c').show();
     $('#tableID1').DataTable().destroy();
            $('#tableID1').show();
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
                    {"data": "category"},
                    {"data": "expiry_date"},
                    {"data": "contract_id"},
                    {"data": "status"}
                    
                   
                ]
            });

          
      
      }
    })

                      }
                    });

 
});


  });
</script>

