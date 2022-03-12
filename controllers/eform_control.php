<?php
   
    // Database connection
    include('config/db.php');
	
	global $eformSuccess;
    
    if(isset($_POST["btnLog"])) 
	{
        $service_id = stripslashes($_POST['job_id']);
		$job_status = stripslashes($_POST['job_status']);
		$job_assign = stripslashes($_POST['job_assign']);
  
		$service_id = mysqli_real_escape_string($connection,$service_id);
		$job_status = mysqli_real_escape_string($connection,$job_status);
		$job_assign = mysqli_real_escape_string($connection,$job_assign);
		
		if(isset($_POST["feedback"]))
		{
			$feedback = stripslashes($_POST['txtActivity']);
			$feedback = mysqli_real_escape_string($connection,$feedback);
			$cust_id = $_POST["cust_id"];
			$sql = "INSERT INTO `tblFeedback`(`Feedback_Content`, `Feedback_Date`, `Cust_ID`) VALUES ('{$feedback}', now(), '{$cust_id}')";
			$sqlQuery = mysqli_query($connection, $sql);
			if(!$sqlQuery)
			{
				die("MySQL query failed!" . mysqli_error($connection));
			}
		}
		
		$sql = "SELECT * FROM tblService WHERE Service_ID = '{$service_id}'";
		$service = mysqli_query($connection, $sql);
		while($rowService = mysqli_fetch_array($service))
		{
			$current_tech = $rowService['User_ID'];
			if($current_tech != $job_assign)
			{
				$sql = "SELECT * FROM tblUser WHERE User_ID = '{$job_assign}'";
				$tech = mysqli_query($connection, $sql);
				while($rowTech = mysqli_fetch_array($tech))
				{
					$assigned = $rowTech['User_Assigned'];
					$assigned = $assigned + 1;
					$sql = "UPDATE tblUser SET User_Assigned = '{$assigned}' WHERE User_ID = '{$job_assign}'";
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
		$sql = "UPDATE `tblService` SET Service_Status = '{$job_status}', User_ID = '{$job_assign}' 
		WHERE Service_ID = '{$service_id}'";
			
		// Create mysql query
		$sqlQuery = mysqli_query($connection, $sql);
			
		if(!$sqlQuery)
		{
			die("MySQL query failed!" . mysqli_error($connection));
		}
		else
		{
			$eformSuccess = '
				<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
					<span class="badge badge-pill badge-success">Success</span>
						Job updated! You may view the form below.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}
    }
?>