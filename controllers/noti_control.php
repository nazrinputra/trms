<?php
   
    // Database connection
    include('config/db.php');
    
    if(isset($_POST["btnNoti"])) 
	{
        $noti_date = stripslashes($_POST['noti_date']);
		$noti_title = stripslashes($_POST['noti_title']);
		$noti_content = stripslashes($_POST['noti_content']);
		$noti_class = stripslashes($_POST['noti_class']);
		
        $noti_date = mysqli_real_escape_string($connection,$noti_date);
		$noti_title = mysqli_real_escape_string($connection,$noti_title);
		$noti_content = mysqli_real_escape_string($connection,$noti_content);
		$noti_class = mysqli_real_escape_string($connection,$noti_class);

			// Query
			$sql = "INSERT into `tblNotification` (Noti_Title, Noti_Content, Noti_Class, Noti_Date_added, Noti_Is_Active) 
			VALUES ('{$noti_title}', '{$noti_content}', '{$noti_class}', '{$noti_date}', 'Yes')";
			
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
							Add notification success! All user will be able to see the notification.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
				header("Location: notification.php");
			}
    }
?>