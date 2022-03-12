<?php
   
    // Database connection
    include('config/db.php');
    
    if(isset($_POST["btnJob"])) 
	{
        $service_id = stripslashes($_POST['job_id']);
		$service_id = preg_replace('/[^0-9,.]+/', '', $service_id);
		$cust_id = stripslashes($_POST['customer_id']);
		$job_date = stripslashes($_POST['job_date']);
		$job_type = stripslashes($_POST['job_type']);
		$job_title = stripslashes($_POST['job_title']);
		$job_desc = stripslashes($_POST['job_desc']);
		$tech_id = stripslashes($_POST['job_assign']);
		
        
		$service_id = mysqli_real_escape_string($connection,$service_id);
		$cust_id = mysqli_real_escape_string($connection,$cust_id);
		$job_date = mysqli_real_escape_string($connection,$job_date);
		$job_type = mysqli_real_escape_string($connection,$job_type);
		$job_title = mysqli_real_escape_string($connection,$job_title);
		$job_desc = mysqli_real_escape_string($connection,$job_desc);
		
		// Query
		$sql = "INSERT into `tblService` (Service_ID, Service_Title, Service_Description, Service_Type, Service_Date, Service_Status, Cust_ID, User_ID) 
		VALUES ('{$service_id}', '{$job_title}', '{$job_desc}', '{$job_type}', '{$job_date}', 'Open', '{$cust_id}', '{$tech_id}')";
			
		// Create mysql query
		$sqlQuery = mysqli_query($connection, $sql);
			
		if(!$sqlQuery)
		{
			die("MySQL query failed!" . mysqli_error($connection));
		}
		else
		{
			$sql = "SELECT * FROM tblUser WHERE User_ID = '{$_SESSION['id']}'";
			$query = mysqli_query($connection, $sql);
			while($rowTech = mysqli_fetch_array($query))
			{
				$created = $rowTech['User_Created'];
				$created = $created + 1;
				$sql = "UPDATE tblUser SET User_Created = '{$created}' WHERE User_ID = '{$_SESSION['id']}'";
				mysqli_query($connection, $sql);
				$_SESSION['created'] = $created;
			}
			
			$_SESSION['JobSuccess'] = '
				<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
					<span class="badge badge-pill badge-success">Success</span>
						Add job success! You may view the form below.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
			
			$sql = "SELECT * FROM tblUser WHERE User_ID = '{$tech_id}'";
			$tech = mysqli_query($connection, $sql);
			while($rowTech = mysqli_fetch_array($tech))
			{
				$assigned = $rowTech['User_Assigned'];
				$assigned = $assigned + 1;
				$sql = "UPDATE tblUser SET User_Assigned = '{$assigned}' WHERE User_ID = '{$tech_id}'";
				mysqli_query($connection, $sql);
				$_SESSION['assigned'] = $assigned;
			}
			
			header("Location: view_eform.php?job_id={$service_id}");
		}
    }
?>