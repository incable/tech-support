<?php include("header.php");?>
<script src="assets/js/sweetalert.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
<body id="page-top">
    <div id="wrapper">

    <?php include("sidemenu.php");?>

    <div id="content-wrapper">

    <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a ><b> Generate Bill </B></a>
          </li>
    </ol>
       
    <div class="row" >
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5"> From Date</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">
                <input type="date" class="form-control" name="from_date" id="from_date" value="">
                </span>
              </a>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5"> To Date</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">
                <input type="date" class="form-control" name="to_date" id="to_date" value="">
                </span>
              </a>
            </div>
          </div>
    </div>
    <div class="row" >
                        &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary btn-flat" id="search">Get Report</button>
    </div>
</div>           
</div>
</div>
<script>
  $(document).on("click", "#search", function() {

    var from = $("#from_date").val();
	var to = $("#to_date").val();
    if( from == "" || to == "")
    {
        swal("Select From and To Date", "", "warning");
    }
    else{
        waitingDialog.show('Loading Please Wait...');
                var request = {
                    'from_date': from,
                    'to_date': to
                };

                $.ajax({
                    url: ' https://ld3igodwbj.execute-api.us-west-2.amazonaws.com/prod/support_mainlco_bill',
                    header: {
                        'content-type': 'application/json'
                    },
                    type: 'POST',
                    data: JSON.stringify(request),
                    success: function(response,status) {
                        console.log(status);

                     if(status=="success")
                     {
                        window.location.href ="mso_billing.php";
                     }
                     else
                     {
                        waitingDialog.hide();
                        swal("Sorry Please try again", "", "warning");
                     }
                    }
                   
    
                 });
                 
    } 
});
</script>
</body>
    
                                





<?php include("footer.php"); ?>