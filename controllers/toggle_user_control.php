<?php
   
    include('../config/db.php');
    
    if(isset($_GET["user_id"])) 
	{
		$user_id = $_GET["user_id"];
		$sql = "SELECT * From tblUser WHERE User_ID = '{$user_id}' ";
        $query = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_array($query))
		{
			$currentStatus = $row["User_Is_Active"];
		}
		
		if($currentStatus == 'Yes')
		{
			$newStatus = 'No';
		}
		if($currentStatus == 'No')
		{
			$newStatus = 'Yes';
		}
		
		$sql = "UPDATE tblUser SET `User_Is_Active`='{$newStatus}' WHERE `User_ID`='{$user_id}'";
		mysqli_query($connection, $sql);
		
		header("Location: http://localhost/TRMS/technician.php");
    }
?>