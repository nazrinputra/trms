<?php
   
    // Database connection
    include('config/db.php');
    
	global $jobSuccess;
	
    if(isset($_POST["btnJob"])) 
	{
        $service_id = stripslashes($_POST['job_id']);
		$service_id = preg_replace('/[^0-9,.]+/', '', $service_id);
		$cust_id = stripslashes($_POST['customer_id']);
		$job_date = stripslashes($_POST['job_date']);
		$job_type = stripslashes($_POST['job_type']);
		$job_title = stripslashes($_POST['job_title']);
		$job_desc = stripslashes($_POST['job_desc']);
		$job_status = stripslashes($_POST['job_status']);
		$tech_id = stripslashes($_POST['job_assign']);
		
        
		$service_id = mysqli_real_escape_string($connection,$service_id);
		$cust_id = mysqli_real_escape_string($connection,$cust_id);
		$job_date = mysqli_real_escape_string($connection,$job_date);
		$job_type = mysqli_real_escape_string($connection,$job_type);
		$job_title = mysqli_real_escape_string($connection,$job_title);
		$job_desc = mysqli_real_escape_string($connection,$job_desc);
		$job_status = mysqli_real_escape_string($connection,$job_status);
		
		$sql = "SELECT * FROM tblService WHERE Service_ID = '{$service_id}'";
		$service = mysqli_query($connection, $sql);
		while($rowService = mysqli_fetch_array($service))
		{
			$current_tech = $rowService['User_ID'];
			if($current_tech != $tech_id)
			{
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
			}
			
			$current_status = $rowService['Service_Status'];
			if($current_status == 'Closed')
			{
				$sql = "SELECT * FROM tblUser WHERE User_ID = '{$_SESSION['id']}'";
				$tech = mysqli_query($connection, $sql);
				while($rowTech = mysqli_fetch_array($tech))
				{
					$closed = $rowTech['User_Closed'];
					$sql = "UPDATE tblUser SET User_Closed = '{$closed}' WHERE User_ID = '{$_SESSION['id']}'";
					mysqli_query($connection, $sql);
					$_SESSION['closed'] = $closed;
				}
			}
			else if($job_status == 'Closed')
			{
				$sql = "SELECT * FROM tblUser WHERE User_ID = '{$_SESSION['id']}'";
				$tech = mysqli_query($connection, $sql);
				while($rowTech = mysqli_fetch_array($tech))
				{
					$closed = $rowTech['User_Closed'];
					$closed = $closed + 1;
					$sql = "UPDATE tblUser SET User_Closed = '{$closed}' WHERE User_ID = '{$_SESSION['id']}'";
					mysqli_query($connection, $sql);
					$_SESSION['closed'] = $closed;
				}
			}
		}
		
		// Query
		$sql = "UPDATE `tblService` SET Service_Title = '{$job_title}', Service_Description = '{$job_desc}', 
		Service_Type = '{$job_type}', Service_Date = '{$job_date}', Service_Status = '{$job_status}', Cust_ID = '{$cust_id}', User_ID = '{$tech_id}'
		WHERE Service_ID = '{$service_id}'";
			
		// Create mysql query
		$sqlQuery = mysqli_query($connection, $sql);
			
		if(!$sqlQuery)
		{
			die("MySQL query failed!" . mysqli_error($connection));
		}
		else
		{
			$jobSuccess = '
				<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
					<span class="badge badge-pill badge-success">Success</span>
						Update job success! You may view the form below.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}
    }
?>