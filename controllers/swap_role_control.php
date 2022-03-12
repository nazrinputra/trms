<?php
   
    include('../config/db.php');
    
    if(isset($_GET["user_id"])) 
	{
		$user_id = $_GET["user_id"];
		$sql = "SELECT * From tblUser WHERE User_ID = '{$user_id}' ";
        $query = mysqli_query($connection, $sql);
		while($row = mysqli_fetch_array($query))
		{
			$currentRole = $row["User_Role"];
		}
		
		if($currentRole == 'Admin')
		{
			$newRole = 'Tech';
		}
		if($currentRole == 'Tech')
		{
			$newRole = 'Admin';
		}
		
		$sql = "UPDATE tblUser SET `User_Role`='{$newRole}' WHERE `User_ID`='{$user_id}'";
		mysqli_query($connection, $sql);
		
		header("Location: http://localhost/TRMS/technician.php");
    }
?>