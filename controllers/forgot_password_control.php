<?php
   
    // Database connection
    include('config/db.php');
	
	// Swiftmailer lib
    require_once './lib/vendor/autoload.php';
	
	date_default_timezone_set('Asia/Kuala_Lumpur');
	
	// Error & success messages
	global $email_reset_err, $email_reset_success;
	
	if(isset($_POST["email"]))
	{
		$email = stripslashes($_POST["email"]);
		$email = strtolower($email);
		
		// clean data 
		$email = mysqli_real_escape_string($connection,$email);
		
		// Query if email exists in db
        $sql = "SELECT * From tblUser WHERE User_Email = '{$email}' ";
        $query = mysqli_query($connection, $sql);
        $rowCount = mysqli_num_rows($query);
		$row = mysqli_fetch_array($query);
		$name = $row['User_Name'];
		
		// If query fails, show the reason 
        if(!$query){
           die("SQL query failed: " . mysqli_error($connection));
        }
		
		if($rowCount <= 0) {
			$emailErr = '
				<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
					<span class="badge badge-pill badge-danger">Fail</span>
						No user is registered with this email address!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				';
		}
		else
		{
			$expFormat = mktime(
			   date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
			   );
			   $expDate = date("Y-m-d H:i:s",$expFormat);
			   $key = md5(strval(4567) . $email);
			   $addKey = substr(md5(uniqid(rand(),1)),3,10);
			   $key = $key . $addKey;
			   
			// Insert Temp Table
			$queryReset = mysqli_query($connection,
			"INSERT INTO tblReset (`User_Email`, `Reset_Key`, `Reset_Expiry`)
			VALUES ('".$email."', '".$key."', '".$expDate."');");
			
			if(!$queryReset)
			{
				die("MySQL query failed!" . mysqli_error($connection));
			}
			if($queryReset) 
			{
				// Reset password email contents
				$output='<p>Dear '.$name.',</p>';
				$output.='<p>Please click on the following link to reset your password.</p>';
				$output.='<p>-------------------------------------------------------------</p>';
				$output.='<p><a href="http://localhost/TRMS/reset_password.php?
				key='.$key.'&email='.$email.'&action=reset" target="_blank">
				http://localhost/TRMS/reset_password.php?
				key='.$key.'&email='.$email.'&action=reset</a></p>'; 
				$output.='<p>-------------------------------------------------------------</p>';
				$output.='<p>Please be sure to copy the entire link into your browser.
				The link will expire after 1 day for security reason.</p>';
				$output.='<p>If you did not request this forgotten password email, no action 
				is needed, your password will not be reset. However, you may want to log into 
				your account and change your security password as someone may have guessed it.</p>';   
				$output.='<p>Thanks,<br>';
				$output.='TRMS Admin</p>';
				
				//Email items
				$body = $output; 
				$subject = "Password Recovery - TRMS";
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
				
				$resultEmail = $mailer->send($message);
				
				if(!$resultEmail)
				{
					$email_reset_err = '
						<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
							<span class="badge badge-pill badge-danger">Fail</span>
								Password reset email could not be sent!
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
				}
				else 
				{
					$email_reset_success = '
						<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
							<span class="badge badge-pill badge-success">Success</span>
								Password reset email has been sent! Check your inbox to reset your password.
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