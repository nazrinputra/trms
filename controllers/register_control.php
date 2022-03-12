<?php
   
    // Database connection
    include('config/db.php');

    // Swiftmailer lib
    require_once './lib/vendor/autoload.php';
    
    // Error & success messages
    global $email_exist, $staff_exist, $email_verify_err, $email_verify_success;
    
    if(isset($_POST["btnRegister"])) 
	{
        $staff_no = stripslashes($_POST['staff_no']);
        $name = stripslashes($_POST['name']);
        $email = stripslashes($_POST['email']);
		$email = strtolower($email);
        $password = stripslashes($_POST['password']);
		$gender = stripslashes($_POST['gender']);
		$role = 'Tech';

        // check if email already exist
        $email_check_query = mysqli_query($connection, "SELECT * FROM tblUser WHERE User_Email = '{$email}' ");
        $rowCountEmail = mysqli_num_rows($email_check_query);
		
		if($rowCountEmail > 0) 
		{
			$email_exist = '
				<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
					<span class="badge badge-pill badge-danger">Fail</span>
						Register fail! Email already exist.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}
		
		// check if staff no already exist
        $staff_check_query = mysqli_query($connection, "SELECT * FROM tblUser WHERE User_Staff_No = '{$staff_no}' ");
        $rowCountStaff = mysqli_num_rows($staff_check_query);
		
		if($rowCountStaff > 0) 
		{
			$staff_exist = '
				<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
					<span class="badge badge-pill badge-danger">Fail</span>
						Register fail! Staff number already exist.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}
		else
		{
			$staff_no = mysqli_real_escape_string($connection,$staff_no);
			$name = mysqli_real_escape_string($connection,$name);
			$email = mysqli_real_escape_string($connection,$email);
			$password = mysqli_real_escape_string($connection,$password);
			$gender = mysqli_real_escape_string($connection,$gender);
			$role = mysqli_real_escape_string($connection,$role);
			
			// Generate random activation token
			$token = md5(rand().time());

			// Password hash
			$password_hash = password_hash($password, PASSWORD_DEFAULT);
			
			// Assign default avatar
			if($gender == 'Male')
			{
				$avatar = 'images/icon/Avatars17.png';
			}
			if($gender == 'Female')
			{
				$avatar = 'images/icon/Avatars02.png';
			}

			// Query
			$sql = "INSERT into `tblUser` (User_Name, User_Email, User_Staff_No, User_Password, User_Gender, User_Avatar, User_Role, User_Token, User_Is_Active, User_Date_Registered)
			VALUES ('{$name}', '{$email}', '{$staff_no}', '{$password_hash}', '{$gender}', '{$avatar}', '{$role}','{$token}', 'No', now())";
			
			// Create mysql query
			$sqlQuery = mysqli_query($connection, $sql);
			
			if(!$sqlQuery)
			{
				die("MySQL query failed!" . mysqli_error($connection));
			} 

			// Send verification email
			if($sqlQuery) 
			{
				$msg = 'You have successfully registered on TRMS.<br>Click on the activation link to verify your email. <br><br>
				  <a href="http://localhost/TRMS/user_verification.php?token='.$token.'"> Click here to verify email</a>
				';
				
				$output='<p>Dear '.$name.',</p>';
				$output.='<p>Please click on the following link to verify your account.</p>';
				$output.='<p>-------------------------------------------------------------</p>';
				$output.='<p><a href="http://localhost/TRMS/user_verification.php?
				token='.$token.'" target="_blank">
				http://localhost/TRMS/user_verification.php?
				token='.$token.'</a></p>'; 
				$output.='<p>-------------------------------------------------------------</p>';
				$output.='<p>Please be sure to copy the entire link into your browser.</p>';
				$output.='<p>If you did not register at TRMS, please ignore this email.</p>';   
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
				->setFrom([$email => $from])
				->setTo($email)
				->addPart($body, "text/html")
				->setBody('Hello, '.$name.'!');

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
					$email_verify_success = '
						<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
							<span class="badge badge-pill badge-success">Success</span>
								Verification email has been sent! Check your inbox to verify your account.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
				}
			}
		}
    }
?>