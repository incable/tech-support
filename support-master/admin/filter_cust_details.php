<?php include("header.php");
   //  include("../auth_admin.php");
   //  include("../dbConnect.php");
   //  $employee_name = $_SESSION['employee_name'];
  	// $email = $_SESSION['email'];
  	// $phone = $_SESSION['phone'];
  	// $employeeid = $_SESSION['id'];
  	
   $id = $_GET['id'];
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
                        Filter Customer Details
                    </div>
                </div>
                <div class="container-fluid">
                	<div class="row">
                        <div class="col-lg-6">
                            <div class="card-header">
                            	<center>
                            		<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModal" style="width:100%;padding:7%;"> 
								  		 AREA    STEP.1
									</button>
								</center>
								<!-- Modal -->
								<form action="filter_cust_details.php?id=<?php echo $id;?>" method="POST">
									<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  	<div class="modal-dialog" role="document">
									    	<div class="modal-content">
									      		<div class="modal-header">
									        		<h5 class="modal-title" id="exampleModalLabel">Area Details</h5>
									        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          			<span aria-hidden="true">&times;</span>
									        		</button>
									      		</div>
									      		<div class="modal-body">
									      			<p style="color:red;"><b>NOTE: Below Table colume should not be NULL/Empty. </b></p>
									      			<div class="table-responsive">
                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Area Name</th>
                                                                    <th>City</th>
                                                                    <th>State</th>
                                                                    <th>Operator Id</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            	<?php 
												        			$conn = connect();
												        			mysqli_set_charset($conn,'utf8');
												        			$query = mysqli_query($conn,"SELECT DISTINCT area_name,city,state,owner_id FROM staging_support where owner_id = '$id';");
												        			close($conn);
												        			$conn = connect();
												        			mysqli_set_charset($conn,'utf8');
												        			$query_insert = array();
												        			while ($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
												        				echo '<tr>
												        						<td>'.$fetch['area_name'].'</td>
												        						<td>'.$fetch['city'].'</td>
												        						<td>'.$fetch['state'].'</td>
												        						<td>'.$fetch['owner_id'].'</td>
												        				      </tr>';
												        				$query_insert[] = "('{$fetch['area_name']}','{$fetch['city']}','{$fetch['state']}','{$fetch['owner_id']}')";
												        			}
												        			close($conn);
												        		?>
                                                            </tbody>
                                                        </table>
                                                    </div>
									        		
									      		</div>
									      		<div class="modal-footer">
									        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									        		<button type="submit"  name="area" class="btn btn-warning">Insert Areas</button>
									      		</div>
									      		
									    	</div>
									  	</div>
									</div>
								</form>
								<?php 
                        		if (isset($_POST['area'])) {
									if (count($query_insert)>0) {
										$query_insert_string = implode(',', $query_insert);
                                		$conn = connect();
                                		mysqli_set_charset($conn,'utf8');
                                		$query_insert = mysqli_query($conn, "INSERT INTO AREA (area_name,city,state,operator_id) VALUES {$query_insert_string}");
                                		close($conn);
                                		if ( $query_insert) {
	                                		echo 	'<div class="alert alert-success" role="alert">
												  		Areas Inserted Successfuly..
													</div>';
	                                	}else{
	                                		echo 	'<div class="alert alert-warning" role="alert">
													  	Areas Not Inserted Successfuly..!
													</div>';
	                                	}
									}
								}
                        	 	?>
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <div class="card-header">
                                <center>
                            		<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModal1" style="width:100%;padding:7%;">
								  		AGENT    STEP.2
									</button>
								</center>
								<!-- Modal -->
								<form action="filter_cust_details.php?id=<?php echo $id;?>" method="POST">
									<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  	<div class="modal-dialog" role="document">
									    	<div class="modal-content">
									      		<div class="modal-header">
									        		<h5 class="modal-title" id="exampleModalLabel">Agent Details</h5>
									        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          			<span aria-hidden="true">&times;</span>
									        		</button>
									      		</div>
									      		<div class="modal-body">
									      			<p style="color:red;"><b>NOTE: Below Table colume should not be NULL/Empty. </b></p>
									      			<div class="table-responsive">
                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Agent Name</th>
                                                                    <th>Operator Id</th>
                                                                    <th>Login Id</th>
                                                                    <th>Password</th>
                                                                    <th>Date</th>
                                                                    <th>Active</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            	<?php 
												        			$conn = connect();
												        			mysqli_set_charset($conn,'utf8');
												        			$query = mysqli_query($conn,"SELECT DISTINCT agent_name,owner_id FROM staging_support where owner_id = '$id';");
												        			close($conn);
												        			$conn = connect();
												        			$query_insert1 = array();
												        			while ($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
												        				$random = rand(10,100);
												        				$date = date('Y-m-d');
												        				$agentID = $fetch['agent_name'].$random;
												        				$Active = 'Y';
												        				echo '<tr>
												        						<td>'.$fetch['agent_name'].'</td>
												        						<td>'.$fetch['owner_id'].'</td>
												        						<td>'.$agentID.'</td>
												        						<td>'.$agentID.'</td>
												        						<td>'.$date.'</td>
												        						<td>'.$Active.'</td>
												        				      </tr>';
												        				$query_insert1[] = "('{$fetch['agent_name']}','{$fetch['owner_id']}','{$date}','{$agentID}','{$agentID}','{$Active}')";
												        			}
												        			close($conn);
												        		?>
                                                            </tbody>
                                                        </table>
                                                    </div>
									      		</div>
									      		<div class="modal-footer">
									        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									        		<button type="submit"  name="agent" class="btn btn-warning">Insert Agents</button>
									      		</div>
									      		
									    	</div>
									  	</div>
									</div>
								</form>
								<?php 
								if (isset($_POST['agent'])) {
									if (count($query_insert1)>0) {
										$query_insert_string1 = implode(',', $query_insert1);
                               			$conn = connect();
                               			mysqli_set_charset($conn,'utf8');
                                		$query_insert = mysqli_query($conn, "INSERT INTO AGENT (Name,Operator_id,Created_Date,AGENT_PASSWD,AGENT_LOGIN_ID,Active) VALUES {$query_insert_string1}");
                                		close($conn);
                                		if ( $query_insert) {
	                                		echo 	'<div class="alert alert-success" role="alert">
												  		Agents Inserted Successfuly..
													</div>';
	                                	}else{
	                                		echo 	'<div class="alert alert-warning" role="alert">
													  	Agents Not Inserted Successfuly..!
													</div>';
	                                	}
									}
								}
								?>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:1%;">
                        <div class="col-lg-6">
                            <div class="card-header">
                                <center>
	                                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#bd-example-modal-lg" style="width:100%;padding:7%;">
	                                	SUBSCRIPTION    STEP.3
	                            	</button>
	                        	</center>
	                        	<form action="filter_cust_details.php?id=<?php echo $id;?>" method="POST">
			                        <div class="modal fade "id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
											    	<h5 class="modal-title" id="exampleModalLabel">Subscrptions Details</h5>
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          	<span aria-hidden="true">&times;</span>
											        </button>
											    </div>
											    <div class="modal-body">
											    	<p style="color:red;"><b>NOTE: Below Table colume should not be NULL/Empty. </b></p>
												   	<div class="table-responsive">
			                                        	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			                                            	<thead>
			                                                	<tr>
			                                                    	<th>Pack Name</th>
			                                                        <th>Pack Type</th>
			                                                        <th>Pack Price</th>
			                                                        <th>Pack Tax</th>
			                                                        <th>Operator Id</th>
			                                                    </tr>
			                                                </thead>
			                                                <tbody>
			                                                  	<?php 
			                                                  		$conn = connect();
			                                                  		mysqli_set_charset($conn,'utf8');
			                                                   		$query = mysqli_query($conn, "SELECT DISTINCT pack_name,pack_type,pack_price,pack_gst,owner_id FROM staging_support where owner_id = '$id';");
			                                                   		 mysqli_set_charset($conn,'utf8');
			                                                   		close($conn);
			                                                   		$query_insert2 = array();
			                                                   		while ($fetch1 = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
			                                                   			$pack_price = $fetch1['pack_price'];
			                                                   			$price= number_format($pack_price / 1.18,2);
			                                                   			$tax = number_format($pack_price - $price,2);

			                                                   			echo '<tr>
															       				<td>'.$fetch1['pack_name'].'</td>
															       				<td>'.$fetch1['pack_type'].'</td>
															       				<td>'.$fetch1['pack_price'].'</td>
															       				<td>'.$fetch1['pack_gst'].'</td>
															       				<td>'.$fetch1['owner_id'].'</td>
															       			</tr>';
															       		$query_insert2[] = "('{$fetch1['pack_name']}','{$fetch1['pack_price']}','{$fetch1['pack_gst']}','{$pack_price}','{$fetch1['owner_id']}','{$fetch1['pack_type']}')";
			                                                   		}
			                                                   	?>
			                                                </tbody>
			                                            </table>
			                                        </div>
			                                    </div>
			                                    <div class="modal-footer">
										        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										        	<button type="submit"  name="subscription" class="btn btn-warning">Insert Subscriptions</button>
										      	</div>
											</div>
								     	</div>
								    </div>
								</form>
								<?php 
								if (isset($_POST['subscription'])) {
			                		if (count($query_insert2)>0) {
			                    		$query_insert_string2 = implode(',', $query_insert2);
			                    		$conn = connect();
                               			$query_insert = mysqli_query($conn, "INSERT INTO SUBSCRIPTION (subs_desc,subs_prc,tax_amnt,subs_grnd_tot_prc,operator_id,pack_type) VALUES {$query_insert_string2}");
                                		close($conn);
                                		if ( $query_insert) {
	                                		echo 	'<div class="alert alert-success" role="alert">
												  		Subscriptions Inserted Successfuly..
													</div>';
	                                	}else{
	                                		echo 	'<div class="alert alert-warning" role="alert">
													  	Subscriptions Not Inserted Successfuly..!
													</div>';
	                                	}
			                		}
			            		}
								?>
							</div>
                        </div>
	                    <div class="col-lg-6">
	                        <div class="card-header">
	                            <center>
	                                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#bd-example-modal-lg1" style="width:100%;padding:7%;">
	                                	CUSTOMER    STEP.4
	                            	</button>
	                        	</center>
	                        	<form action="filter_cust_details.php?id=<?php echo $id;?>" method="POST">
			                        <div class="modal fade "id="bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-xl" role="document">
											<div class="modal-content">
												<div class="modal-header">
											    	<h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          	<span aria-hidden="true">&times;</span>
											        </button>
											    </div>
											    <div class="modal-body">
											    	<p style="color:red;"><b>NOTE: Below Table colume should not be NULL/Empty. </b></p>
											    	<?php

											    		$conn = connect();
											    		mysqli_set_charset($conn,'utf8');
											    		$area=mysqli_query($conn,"UPDATE staging_support ss INNER JOIN AREA a ON ss.area_name = a.area_name SET ss.area_id = a.id WHERE ss.owner_id=a.Operator_id and ss.owner_id = '$id';");
											    		$agent=mysqli_query($conn,"UPDATE staging_support ss INNER JOIN AGENT a ON ss.agent_name = a.Name SET ss.agent_id = a.Agent_Id WHERE ss.owner_id=a.Operator_id and ss.owner_id = '$id';");
											    		$subsc=mysqli_query($conn,"UPDATE staging_support ss INNER JOIN SUBSCRIPTION s ON ss.pack_name = s.subs_desc SET ss.subs_id = s.subs_id WHERE ss.owner_id=s.operator_id and ss.owner_id = '$id';");
											    		close($conn); 
											    	?>
												   	<div class="table-responsive">
			                                        	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			                                            	<thead>
			                                                	<tr>
			                                                		<th>Derived Id</th>
			                                                    	<th>Customer_id</th>
			                                                        <th>Name</th>
			                                                        <th>Alias_name</th>
			                                                        <th>stb_number</th>
			                                                        <th>stb_serial_number</th>
			                                                        <th>stb_vc_number</th>
			                                                        <th>address1</th>
			                                                        <th>area_id</th>
			                                                        <th>area_name</th>
			                                                        <th>city</th>
			                                                        <th>state</th>
			                                                        <th>phone</th>
			                                                        <th>email</th>
			                                                        <th>subs_id</th>
			                                                        <th>product_start_date</th>
			                                                        <th>pack_price</th>
			                                                        <th>pack_gst</th>
			                                                        <th>agent_id</th>
			                                                        <th>owner_id</th>
			                                                        <th>GSTIN</th>
			                                                        <th>UDF1</th>
			                                                        <th>Balance</th>
			                                                    </tr>
			                                                </thead>
			                                                <tbody>
			                                                  	<?php 
			                                                  		$conn = connect();
			                                                  		mysqli_set_charset($conn,'utf8');
			                                                   		$query = mysqli_query($conn, "SELECT derived_id,customer_id,full_name, alias_name,stb_number,stb_serial_number,stb_vc_number,address1,area_id,area_name,city,state,phone,email,subs_id,product_start_date,pack_price,pack_gst,agent_id,owner_id,GSTIN,udf1,balanace FROM staging_support where owner_id = '$id' and (udf1 = 'p' OR udf1 = 'P');");
			                                                   		mysqli_set_charset($conn,'utf8');
			                                                   		close($conn);
			                                                   		$query_insert3 = array();
			                                                   		while ($fetch1 = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
			                                                   			if ($fetch1['udf1'] != 's' OR $fetch1['udf1'] != 'S') {
			                                                   				$pack_price = $fetch1['pack_price'];
			                                                   			$price= number_format($pack_price / 1.18,2);
			                                                   			$tax = number_format($pack_price - $price,2);

			                                                   			echo '<tr>
			                                                   					<td>'.$fetch1['derived_id'].'</td>
															       				<td>'.$fetch1['customer_id'].'</td>
															       				<td>'.$fetch1['full_name'].'</td>
															       				<td>'.$fetch1['alias_name'].'</td>
															       				<td>'.$fetch1['stb_number'].'</td>
															       				<td>'.$fetch1['stb_serial_number'].'</td>
															       				<td>'.$fetch1['stb_vc_number'].'</td>
															       				<td>'.$fetch1['address1'].'</td>
															       				<td>'.$fetch1['area_id'].'</td>
															       				<td>'.$fetch1['area_name'].'</td>
															       				<td>'.$fetch1['city'].'</td>
															       				<td>'.$fetch1['state'].'</td>
															       				<td>'.$fetch1['phone'].'</td>
															       				<td>'.$fetch1['email'].'</td>
															       				<td>'.$fetch1['subs_id'].'</td>
															       				<td>'.$fetch1['product_start_date'].'</td>
															       				<td>'.$fetch1['pack_price'].'</td>
															       				<td>'.$fetch1['pack_gst'].'</td>
															       				<td>'.$fetch1['agent_id'].'</td>
															       				<td>'.$fetch1['owner_id'].'</td>
															       				<td>'.$fetch1['GSTIN'].'</td>
															       				<td>'.$fetch1['udf1'].'</td>
															       				<td>'.$fetch1['balanace'].'</td>
															       			</tr>';
															       		$query_insert3[] = "('{$fetch1['customer_id']}','{$fetch1['full_name']}','{$fetch1['alias_name']}','{$fetch1['stb_number']}','{$fetch1['stb_serial_number']}','{$fetch1['stb_vc_number']}','{$fetch1['address1']}','{$fetch1['area_id']}','{$fetch1['area_name']}','{$fetch1['city']}','{$fetch1['state']}','{$fetch1['phone']}','{$fetch1['email']}','{$fetch1['subs_id']}','{$fetch1['product_start_date']}','{$fetch1['pack_price']}','{$fetch1['pack_gst']}','{$fetch1['agent_id']}','{$fetch1['owner_id']}','{$fetch1['GSTIN']}','{$fetch1['balanace']}','{$fetch1['derived_id']}')";
			                                                   			}
			                                                   		}
			                                                   	?>
			                                                </tbody>
			                                            </table>
			                                        </div>
			                                    </div>
			                                    <div class="modal-footer">
										        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										        	<button type="submit"  name="customers" class="btn btn-warning">Insert Subscriptions</button>
										      	</div>
											</div>
								     	</div>
								    </div>
								</form>
								<?php
								if (isset($_POST['customers'])) {
			            			if (count($query_insert3)>0) {
			            				$query_insert_string3 = implode(',', $query_insert3);
			                    		$conn = connect();
			                    		mysqli_set_charset($conn,'utf8');
                               			$query_insert = mysqli_query($conn, "INSERT INTO CUSTOMER (CUSTOMER_ID,NAME,ALIAS_NAME,STB,STB_SERIAL,VC_Number, ADDRESS, AREA_ID, AREA, CITY, STATE, PHONE, EMAIL,SUBS_PLAN_ID,PRODUCT_END_DATE,Monthly_Rental, Tax_Amount, AGENT_ID, OPERATOR_ID,GSTIN,Opening_Balance,Derived_Id) VALUES {$query_insert_string3}");
                                		close($conn);
                                		if ( $query_insert) {
	                                		echo 	'<div class="alert alert-success" role="alert">
												  		Customer Inserted Successfuly..
													</div>';
	                                	}else{
	                                		echo 	'<div class="alert alert-warning" role="alert">
													  	Customer Not Inserted Successfuly..!
													</div>';
	                                	}
			            			}
			             		}
								?>
	                        </div>
	                    </div>
                    </div>
			        <div class="row" style="margin-top:1%;">
			        	<div class="col-lg-6">
                            <div class="card-header">
                                <center>
	                                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#bd-example-modal-lg2" style="width:100%;padding:7%;">
	                                	STB MASTER    STEP.5
	                            	</button>
	                        	</center>
	                        	<form action="filter_cust_details.php?id=<?php echo $id;?>" method="POST">
			                        <div class="modal fade "id="bd-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
											    	<h5 class="modal-title" id="exampleModalLabel">STB-Master Details</h5>
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          	<span aria-hidden="true">&times;</span>
											        </button>
											    </div>
											    <div class="modal-body">
											    	<p style="color:red;"><b>NOTE: Below Table colume should not be NULL/Empty. </b></p>
											    	<?php 
											    		$conn = connect();
											    		mysqli_set_charset($conn,'utf8');
											    		$query = mysqli_query($conn,"UPDATE staging_support ss INNER JOIN CUSTOMER c ON ss.derived_id=c.Derived_Id SET ss.cust_num =c.CUST_NUM WHERE ss.owner_id=c.operator_id and ss.owner_id = '$id';");
														close($conn); 
											    	?>
												   	<div class="table-responsive">
			                                        	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			                                            	<thead>
			                                                	<tr>
			                                                        <th>Customer Num</th>
			                                                        <th>Operator id</th>
			                                                        <th>Status</th>
			                                                        <th>STB No</th>
			                                                        <th>STB Serial No</th>
			                                                        <th>VC No</th>
			                                                    </tr>
			                                                </thead>
			                                                <tbody>
			                                                  	<?php 
			                                                  		$conn = connect();
			                                                  		mysqli_set_charset($conn,'utf8');
			                                                   		$query = mysqli_query($conn, "SELECT cust_num,owner_id,service_status,stb_number,
			                                                   			stb_serial_number,stb_vc_number,udf2 FROM staging_support where owner_id = '$id' and (udf2 = 'p' OR udf2 = 'P');");
			                                                   		close($conn);
			                                                   		$query_insert4 = array();
			                                                   		while ($fetch1 = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
			                                                   			if ($fetch1['udf2'] != 's' OR $fetch1['udf2'] != 'S') {
				                                                   			echo '<tr>
																       				<td>'.$fetch1['cust_num'].'</td>
																       				<td>'.$fetch1['owner_id'].'</td>
																       				<td>'.$fetch1['service_status'].'</td>
																       				<td>'.$fetch1['stb_number'].'</td>
																       				<td>'.$fetch1['stb_serial_number'].'</td>
																       				<td>'.$fetch1['stb_vc_number'].'</td>
																       			</tr>';
																       		$query_insert4[] = "('{$fetch1['cust_num']}','{$fetch1['owner_id']}','{$fetch1['service_status']}','{$fetch1['stb_number']}','{$fetch1['stb_serial_number']}','{$fetch1['stb_vc_number']}')";
																       	}
			                                                   		}
			                                                   	?>
			                                                </tbody>
			                                            </table>
			                                        </div>
			                                    </div>
			                                    <div class="modal-footer">
										        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										        	<button type="submit"  name="stb_master" class="btn btn-warning">Insert Subscriptions</button>
										      	</div>
											</div>
								     	</div>
								    </div>
								</form>
								<?php
								if (isset($_POST['stb_master'])) {
				                	if (count($query_insert4)>0) {
					                    $query_insert_string4 = implode(',', $query_insert4);
					                    $conn = connect();
		                                $query_insert = mysqli_query($conn, "INSERT INTO STB_MASTER (CUST_NUM,OPERATOR_ID,SERVICE_STATUS,STB_NUMBER,STB_SERIAL,VC_NUMBER) VALUES {$query_insert_string4}");
	                                	close($conn);
	                                	if ( $query_insert) {
	                                		echo 	'<div class="alert alert-success" role="alert">
												  		STB Master Inserted Successfuly..
													</div>';
	                                	}else{
	                                		echo 	'<div class="alert alert-warning" role="alert">
													  	STB Master Not Inserted Successfuly..!
													</div>';
	                                	}
				                	}
			            		} 
								?>
	                        </div>
	                    </div>
	                    <div class="col-lg-6">
                            <div class="card-header">
                                <center>
                            		<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModal3" style="width:100%;padding:7%;"> 
								  		 PACKAGE MASTER    STEP.6
									</button>
								</center>
								<!-- Modal -->
								<form action="filter_cust_details.php?id=<?php echo $id;?>" method="POST">
									<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  	<div class="modal-dialog" role="document">
									    	<div class="modal-content">
									      		<div class="modal-header">
									        		<h5 class="modal-title" id="exampleModalLabel">Package Master Details</h5>
									        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          			<span aria-hidden="true">&times;</span>
									        		</button>
									      		</div>
									      		<div class="modal-body">
									      			<p style="color:red;"><b>NOTE: Below Table colume should not be NULL/Empty. </b></p>
									      			<?php 
											    		$conn = connect();
											    		$query = mysqli_query($conn,"UPDATE staging_support ss INNER JOIN STB_MASTER sm ON ss.cust_num=sm.CUST_NUM SET ss.stb_id =sm.STB_ID where ss.owner_id=sm.OPERATOR_ID and ss.owner_id = '$id' and sm.STB_NUMBER = ss.stb_number AND sm.VC_NUMBER=ss.stb_vc_number;");
														close($conn); 
											    	?>
									      			<div class="table-responsive">
                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>STB ID</th>
                                                                    <th>SUB PLAN ID</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            	<?php 
												        			$conn = connect();
												        			$query = mysqli_query($conn,"SELECT stb_id,subs_id FROM staging_support where owner_id = '$id';");
												        			close($conn);
												        			$conn = connect();
												        			$query_insert5 = array();
												        			while ($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
												        				$month = date('m');
    																	$month_id = $month-1;
												        				echo '<tr>
												        						<td>'.$fetch['stb_id'].'</td>
												        						<td>'.$fetch['subs_id'].'</td>
												        				      </tr>';
												        				$query_insert5[] = "('{$fetch['stb_id']}','{$fetch['subs_id']}')";
												        			}
												        			close($conn);
												        		?>
                                                            </tbody>
                                                        </table>
                                                    </div>
									        		
									      		</div>
									      		<div class="modal-footer">
									        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									        		<button type="submit"  name="package" class="btn btn-warning">Insert Areas</button>
									      		</div>
									      		
									    	</div>
									  	</div>
									</div>
								</form>
								<?php
									if (isset($_POST['package'])) {
					            		if (count($query_insert5)>0) {
					            			$query_insert_string5 = implode(',', $query_insert5);
					            			$conn = connect();
			                                $query_insert = mysqli_query($conn, "INSERT INTO PACKAGE_MASTER (STB_ID, SUBS_PLAN_ID) VALUES {$query_insert_string5}");
			                                close($conn);
			                                if ( $query_insert) {
	                                			echo 	'<div class="alert alert-success" role="alert">
												  			Package Master Inserted Successfuly..
														</div>';
	                                		}else{
	                                			echo 	'<div class="alert alert-warning" role="alert">
													  		Package Master Not Inserted Successfuly..!
														</div>';
	                                		}
					            		}
					            	} 
								?>
	                        </div>
	                    </div>
	                    <div class="col-md-12" style="margin-top:1%;">
	                    	<div class="form-group"  style="color: #FF4500;">
                        	<label class="btn btn-danger btn-block">Please follow step by step insertion all insertion some interconnections are there..! </label>
                    	</div>
                        <div class="card-header">
                           	<form action="filter_cust_details.php?id=<?php echo $id;?>" method="POST">
                            	<button type="submit" class="btn btn-info btn-block" name="cbd"> CBD FINALE STEP </button>
                            </form>
                            <?php
                            	if (isset($_POST['cbd'])) {
	                            	$conn = connect();
									$query = mysqli_query($conn,"SELECT cust_num,sum(pack_price)as monthly ,sum(pack_gst) as tax,sum(balanace) as total FROM staging_support where owner_id = '$id' group by cust_num;");
									close($conn);
									$query_insert_cbd = array();
									while ($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
										$month = date('m');
		    							$month_id = $month-1;
										$query_insert_cbd[] = "('{$fetch['cust_num']}','{$month_id}','{$fetch['monthly']}','{$fetch['tax']}','{$fetch['total']}')";
									}
									
										if (count($query_insert_cbd)>0) {
										$query_cbd = implode(',', $query_insert_cbd);
				            			$conn = connect();
		                                $query_insert = mysqli_query($conn, "INSERT INTO cust_bill_detail (cust_uniq_id, mnth_id,cust_mnth_bill_amnt,tax_amnt,bill_total) VALUES {$query_cbd}");
		                                close($conn);
		                                header("Location:filter_cust_details.php");
									}
								}
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include("footer.php"); ?>