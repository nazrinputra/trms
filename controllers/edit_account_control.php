<?php
   
    // Database connection
    include('config/db.php');
    
    if(isset($_POST["btnUpdate"])) 
	{
		$staff_no = stripslashes($_POST['staff_no']);
		$name = stripslashes($_POST['name']);
		$gender = stripslashes($_POST['gender']);
		$position = stripslashes($_POST['position']);
		$phone = stripslashes($_POST['phone']);
		$address = stripslashes($_POST['address']);
		$address = mysqli_real_escape_string($connection,$address);
		$bio = stripslashes($_POST['bio']);
		$bio = mysqli_real_escape_string($connection,$bio);
		
		$sql = "UPDATE tblUser SET 
		`User_Name`='".$name."',
		`User_Gender`='".$gender."',
		`User_Position`='".$position."',
		`User_Phone`='".$phone."',
		`User_Address`='".$address."',
		`User_Bio`='".$bio."'
		WHERE `User_Staff_No`='".$staff_no."'";
		
		// update db and set new session values
		$sqlQuery = mysqli_query($connection, $sql);
		$_SESSION['name'] = $name;
		$_SESSION['position'] = $position;
		$_SESSION['gender'] = $gender;
		$_SESSION['phone'] = $phone;
		$_SESSION['address'] = $_POST['address'];
		$_SESSION['bio'] = $_POST['bio'];
		$_SESSION['profile'] = 'profile';
		
		header("Location: account.php");
		
		if(!$sqlQuery)
		{
			die("MySQL query failed!" . mysqli_error($connection));
		}
    }
?>