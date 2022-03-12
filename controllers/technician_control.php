<?php
   
    // Database connection
    include('config/db.php');
	
	require_once './lib/vendor/autoload.php';
	
	global $email_exist, $staff_exist, $email_verify_err;

    if(isset($_POST["btnTech"])) 
	{
        $tech_staff = stripslashes($_POST['tech_staff']);
        $tech_name = stripslashes($_POST['tech_name']);
        $tech_email = stripslashes($_POST['tech_email']);
		$tech_email = strtolower($tech_email);
		$tech_gender = stripslashes($_POST['tech_gender']);
		$tech_password = 'password';
		$tech_role = 'Tech';

        // check if email already exist
        $email_check_query = mysqli_query($connection, "SELECT * FROM tblUser WHERE User_Email = '{$tech_email}' ");
        $rowCountEmail = mysqli_num_rows($email_check_query);
		
		if($rowCountEmail > 0) 
		{
			$email_exist = '
				<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
					<span class="badge badge-pill badge-danger">Fail</span>
						Add technician fail! Email already exist.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}
		
		// check if staff no already exist
        $staff_check_query = mysqli_query($connection, "SELECT * FROM tblUser WHERE User_Staff_No = '{$tech_staff}' ");
        $rowCountStaff = mysqli_num_rows($staff_check_query);
		
		if($rowCountStaff > 0) 
		{
			$staff_exist = '
				<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
					<span class="badge badge-pill badge-danger">Fail</span>
						Add technician fail! Staff number already exist.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}
		else
		{
			$tech_staff = mysqli_real_escape_string($connection,$tech_staff);
			$tech_name = mysqli_real_escape_string($connection,$tech_name);
			$tech_email = mysqli_real_escape_string($connection,$tech_email);
			$tech_password = mysqli_real_escape_string($connection,$tech_password);
			$tech_gender = mysqli_real_escape_string($connection,$tech_gender);
			$tech_role = mysqli_real_escape_string($connection,$tech_role);
			
			// Generate random activation token
			$token = md5(rand().time());

			// Password hash
			$password_hash = password_hash($tech_password, PASSWORD_DEFAULT);
			
			// Assign default avatar
			if($tech_gender == 'Male')
			{
				$avatar = 'images/icon/Avatars17.png';
			}
			if($tech_gender == 'Female')
			{
				$avatar = 'images/icon/Avatars02.png';
			}

			// Query
			$sql = "INSERT into `tblUser` (User_Name, User_Email, User_Staff_No, User_Password, User_Gender, User_Avatar, User_Role, User_Token, User_Is_Active, User_Date_Registered)
			VALUES ('{$tech_name}', '{$tech_email}', '{$tech_staff}', '{$password_hash}', '{$tech_gender}', '{$avatar}', '{$tech_role}','{$token}', 'No', now())";
			
			// Create mysql query
			$sqlQuery = mysqli_query($connection, $sql);
			
			if(!$sqlQuery)
			{
				die("MySQL query failed!" . mysqli_error($connection));
			} 

			// Send verification email
			if($sqlQuery) 
			{
				$msg = 'You have been successfully added to TRMS by an administrator.<br>Click on the activation link to verify your email. <br><br>
				  <a href="http://localhost/TRMS/user_verification.php?token='.$token.'"> Click here to verify email</a>
				';
				
				$output='<p>Dear '.$tech_name.',</p>';
				$output.='<p>Please click on the following link to verify your account.</p>';
				$output.='<p>-------------------------------------------------------------</p>';
				$output.='<p><a href="http://localhost/TRMS/user_verification.php?
				token='.$token.'" target="_blank">
				http://localhost/TRMS/user_verification.php?
				token='.$token.'</a></p>'; 
				$output.='<p>-------------------------------------------------------------</p>';
				$output.='<p>Please be sure to copy the entire link into your browser.</p>';
				$output.='<p>If you did not want to use TRMS, please ignore this email.</p>';   
				$output.='<p>Thanks,<br>';
				$output.='TRMS Admin</p>';
				
				//Email items
				$body = $output; 
				$subject = "Account Creation - TRMS";
				$from = "TRMS Admin";
				
				// Create the Transport
				$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
				->setUsername('trms0011@gmail.com')
				->setPassword('Fitri0011');

				// Create the Mailer using your created Transport
				$mailer = new Swift_Mailer($transport);

				// Create a message
				$message = (new Swift_Message($subject))
				->setFrom([$tech_email => $from])
				->setTo($tech_email)
				->addPart($body, "text/html")
				->setBody('Hello, '.$tech_name.'!');

				// Send the message
				$result = $mailer->send($message);
				  
				if(!$result)
				{
					$email_verify_err = '
						<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
							<span class="badge badge-pill badge-danger">Fail</span>
								Verification email could not be sent!
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
				} 
				else 
				{
					$_SESSION['verify_success'] = '
						<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
							<span class="badge badge-pill badge-success">Success</span>
								Verification email has been sent! Technician need to verify their account first.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
					header("Location: technician.php");
				}
			}
		}
    }
?>