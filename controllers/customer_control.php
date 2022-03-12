<?php
   
    // Database connection
    include('config/db.php');

    // Error & success messages
    global $email_exist, $phone_exist;
    
    if(isset($_POST["btnCustomer"])) 
	{
        $cust_name = stripslashes($_POST['customer_name']);
		$cust_project = stripslashes($_POST['customer_project']);
		$cust_division = stripslashes($_POST['customer_division']);
		$cust_unit = stripslashes($_POST['customer_unit']);
		$cust_phone = stripslashes($_POST['customer_phone']);
        $cust_email = stripslashes($_POST['customer_email']);
		$cust_email = strtolower($cust_email);
		$cust_address = stripslashes($_POST['customer_address']);
		
        // check if email already exist
        $email_check_query = mysqli_query($connection, "SELECT * FROM tblCustomer WHERE Cust_Email = '{$cust_email}' ");
        $rowCountEmail = mysqli_num_rows($email_check_query);
		
		if($rowCountEmail > 0) 
		{
			$email_exist = '
				<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
					<span class="badge badge-pill badge-danger">Fail</span>
						Add customer fail! Email already exist.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}
		
		// check if phone no already exist
        $phone_check_query = mysqli_query($connection, "SELECT * FROM tblCustomer WHERE Cust_Phone = '{$cust_phone}' ");
        $rowCountPhone = mysqli_num_rows($phone_check_query);
		
		if($rowCountPhone > 0) 
		{
			$phone_exist = '
				<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
					<span class="badge badge-pill badge-danger">Fail</span>
						Add customer fail! Phone number already exist.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}
		else
		{
			$cust_name = mysqli_real_escape_string($connection,$cust_name);
			$cust_project = mysqli_real_escape_string($connection,$cust_project);
			$cust_division = mysqli_real_escape_string($connection,$cust_division);
			$cust_unit = mysqli_real_escape_string($connection,$cust_unit);
			$cust_phone = mysqli_real_escape_string($connection,$cust_phone);
			$cust_email = mysqli_real_escape_string($connection,$cust_email);
			$cust_address = mysqli_real_escape_string($connection,$cust_address);

			// Query
			$sql = "INSERT into `tblCustomer` (Cust_Name, Cust_Project, Cust_Division, Cust_Unit, Cust_Phone, Cust_Email, Cust_Address) 
			VALUES ('{$cust_name}', '{$cust_project}', '{$cust_division}', '{$cust_unit}', '{$cust_phone}', '{$cust_email}', '{$cust_address}')";
			
			// Create mysql query
			$sqlQuery = mysqli_query($connection, $sql);
			
			if(!$sqlQuery)
			{
				die("MySQL query failed!" . mysqli_error($connection));
			}
			else
			{
				$_SESSION['CustomerSuccess'] = '
					<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
						<span class="badge badge-pill badge-success">Success</span>
							Add customer success! Proceed to create job sheet using customer info.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
				$cust_id=mysqli_insert_id($connection);
				header("Location: job.php?cust_id={$cust_id}");
			}
		}
    }
?>