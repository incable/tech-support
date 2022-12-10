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
                        View Usage Details
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Ids</th>
                                        <th>NAME</th>
                                        <th>NETWORK NAME</th>
                                        <th>PHONE</th>
                                        <th>EMAIL</th>
                                        <th>CITY</th>
                                        <th>STATE</th>
                                        <th>LANGUAGE PREFERRED</th>
                                        <th>INSERTION TIME</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $conn = connect();
                                        $query = mysqli_query($conn,"SELECT id,Name, Network_name,phone,email_id, city, state, language_preferred,insertion_time from cableguy2_sales where product_type <> 'VK Product' and status='Open' and type <> 'CUSTOMER' order by insertion_time desc ");
                                        close($conn);
                                        while ($data = mysqli_fetch_array($query)) {
                                            echo '<tr>
                                                    <td id="sale_id">'.$data['id'].'</td>
                                                    <td id="name">'.$data['Name'].'</td>
                                                    <td id="net_name">'.$data['Network_name'].'</td>
                                                    <td id="phone">'.$data['phone'].'</td>
                                                    <td id="email_id">'.$data['email_id'].'</td>
                                                    <td id="city">'.$data['city'].'</td>
                                                    <td id="state">'.$data['state'].'</td>
                                                    <td id="lang_pre">'.$data['language_preferred'].'</td>
                                                    <td id="time">'.$data['insertion_time'].'</td>
                                                    <td>
                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm" id="modal_status">Action
                                                            </button>
                                                        </td>
                                                </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal_status_action">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <!-- <form action="edit_operator_status.php" method="post"> -->
                                            <div class="modal-header">
                                                <h5 class="modal-title">Select Status</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-6">
                                                    <label>Select Status</label>
                                                    <select class="form-control select2" name="status" id="state_select">
                                                        <option value="" disabled selected>Select your option</option>
                                                        <option value="sent_to_hubspot">Sent to Hubspot</option>
                                                        <option value="junk_lead">Junk Lead</option>
                                                        <option value="not_able_to_contact">Not able to Contact</option>
                                                        <option value="end_customer">End Customer</option>
                                                        <option value="closed">Closed</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 sales_person">
                                                    <label>Select Sales Person</label>
                                                    <select class="form-control select2" name="sales" id="sale_person"> 
                                                        <option value="" disabled selected>Select your option</option>
                                                        <option value="48841107">Raghavendra G</option>
                                                        <option value="48841272">Nilay Rao</option>
                                                        <option value="48841282">Mahantesh S</option>
                                                        <option value="48841284">Punit B</option>
                                                        <option value="48841366">Suraj C</option>
                                                        <option value="48841350">Enuu Inayat</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer sales_person1">
                                                <button type="submit" class="btn btn-primary" name="change" id="submit_status">Change Status</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            <div class="modal-footer sales_person">
                                                <button type="submit" class="btn btn-primary" name="change" id="submit_status1">Change Status</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
  </div>
</body>
<?php include("footer.php"); ?>
<script>
    $(document).ready(function() {

        $('#example').DataTable({
                    "paging": true,
                    // "order": [[1, 'asc']],
                    "lengthChange": true,
                    "searching": true,
                    "ordering": false,
                    "info": true
                });
        $(document).on('click','#modal_status',function(){
            $('#modal_status_action').modal('show');
            var sale_id    = $(this).closest("tr").find("#sale_id").text();
            var name       = $(this).closest("tr").find('#name').text();
            var net_name   = $(this).closest("tr").find('#net_name').text();
            var phone      = $(this).closest("tr").find('#phone').text();
            var email_id   = $(this).closest("tr").find('#email_id').text();
            var city       = $(this).closest("tr").find('#city').text();
            var state      = $(this).closest("tr").find('#state').text();
            var lang_pre   = $(this).closest("tr").find('#lang_pre').text();
            var time       = $(this).closest("tr").find('#time').text();
            console.log(sale_id);
            $('.sales_person').hide();
            $('#state_select').on('change',function(){
                var check_hub = $( "#state_select option:selected" ).val();
                if (check_hub =='sent_to_hubspot'){
                    $('.sales_person').show();
                    $('.sales_person1').hide();
                    $(document).on('click','#submit_status1',function(){
                        var sales_persons = $( "#sale_person option:selected" ).val();
                        var request = {name:name,net_name:net_name,phone:phone,email_id:email_id,city:city,state:state,lang_pre:lang_pre,time:time,sales_persons:sales_persons};
                        console.log(request);
                        $.ajax({
                            type: 'post',
                            url: 'hubspot_dash.php',
                            data: {name:name,net_name:net_name,phone:phone,email_id:email_id,city:city,state:state,lang_pre:lang_pre,time:time,sales_persons:sales_persons},
                            success: function (response) {
                                var parsedData = JSON.parse(response);
                                console.log(parsedData);
                                if (parsedData['vid']!='') {
                                    alert('Successfully sent to hubspot');
                                    $.ajax({
                                        type: 'post',
                                        url: 'status_update.php',
                                        data: {status:check_hub,sale_id:sale_id},
                                        success: function (resp) {
                                            console.log(resp);
                                            window.location = "sale_manage.php";
                                        }
                                    });
                                }else{
                                    alert('Sent to hubspot faild');
                                }
                            }
                        });
                    });
                }else{
                    $('.sales_person1').show();
                    $('.sales_person').hide();
                    $(document).on('click','#submit_status',function(){
                        $.ajax({
                            type: 'post',
                            url: 'status_update.php',
                            data: {status:check_hub,sale_id:sale_id},
                            success: function (resp) {
                                alert('Status updated Successfully');
                                window.location = "sale_manage.php";
                            }
                        });
                    });
                }
            });
        }); 
    });
</script>