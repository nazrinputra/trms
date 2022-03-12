<?php
   
    // Database connection
    include('config/db.php');
    
    if(isset($_POST["btnNoti"])) 
	{
        $noti_id = stripslashes($_POST['noti_id']);
		$noti_date = stripslashes($_POST['noti_date']);
		$noti_title = stripslashes($_POST['noti_title']);
		$noti_content = stripslashes($_POST['noti_content']);
		$noti_class = stripslashes($_POST['noti_class']);
		$noti_active = stripslashes($_POST['noti_active']);
		
        $noti_date = mysqli_real_escape_string($connection,$noti_date);
		$noti_title = mysqli_real_escape_string($connection,$noti_title);
		$noti_content = mysqli_real_escape_string($connection,$noti_content);
		$noti_class = mysqli_real_escape_string($connection,$noti_class);
		$noti_active = mysqli_real_escape_string($connection,$noti_active);

			// Query
			$sql = "UPDATE `tblNotification` SET Noti_Title='{$noti_title}', Noti_Content='{$noti_content}', Noti_Class='{$noti_class}', Noti_Date_added='{$noti_date}', Noti_Is_Active='{$noti_active}' 
			WHERE Noti_ID='{$noti_id}'";
			
			// Create mysql query
			$sqlQuery = mysqli_query($connection, $sql);
			
			if(!$sqlQuery)
			{
				die("MySQL query failed!" . mysqli_error($connection));
			}
			else
			{
				$_SESSION['NotiSuccess'] = '
					<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
						<span class="badge badge-pill badge-success">Success</span>
							Edit notification success! Notification data updated in the database.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
				header("Location: notification.php");
			}
    }
?>