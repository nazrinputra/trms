<?php
   
    // Database connection
    include('config/db.php');

    global $updateSuccess;
	
    if(isset($_POST["btnCustomer"])) 
	{
        $cust_id = stripslashes($_POST['customer_id']);
		$cust_name = stripslashes($_POST['customer_name']);
		$cust_project = stripslashes($_POST['customer_project']);
		$cust_division = stripslashes($_POST['customer_division']);
		$cust_unit = stripslashes($_POST['customer_unit']);
		$cust_phone = stripslashes($_POST['customer_phone']);
        $cust_email = stripslashes($_POST['customer_email']);
		$cust_email = strtolower($cust_email);
		$cust_address = stripslashes($_POST['customer_address']);
		
        
		$cust_name = mysqli_real_escape_string($connection,$cust_name);
		$cust_project = mysqli_real_escape_string($connection,$cust_project);
		$cust_division = mysqli_real_escape_string($connection,$cust_division);
		$cust_unit = mysqli_real_escape_string($connection,$cust_unit);
		$cust_phone = mysqli_real_escape_string($connection,$cust_phone);
		$cust_email = mysqli_real_escape_string($connection,$cust_email);
		$cust_address = mysqli_real_escape_string($connection,$cust_address);
		$updateSuccess = "test assign value";

		// Query
		$sql = "UPDATE `tblCustomer` SET Cust_Name = '{$cust_name}', Cust_Project = '{$cust_project}', Cust_Division = '{$cust_division}', 
		Cust_Unit = '{$cust_unit}', Cust_Phone = '{$cust_phone}', Cust_Email = '{$cust_email}', Cust_Address = '{$cust_address}'
		WHERE Cust_ID = '{$cust_id}'";
		
		// Create mysql query
		$sqlQuery = mysqli_query($connection, $sql);
		
		if(!$sqlQuery)
		{
			die("MySQL query failed!" . mysqli_error($connection));
		}
		else
		{
			$updateSuccess = '
				<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
					<span class="badge badge-pill badge-success">Success</span>
						Update customer success!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}
    }
?>