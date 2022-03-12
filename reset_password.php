<?php
	
	// Database connection
    include('config/db.php');
	
	// Swiftmailer lib
    require_once './lib/vendor/autoload.php';
	
	$resetMsg = "";
	
	// From email
	if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) 
	&& ($_GET["action"]=="reset") && !isset($_POST["action"]))
	{
		$key = $_GET["key"];
		$email = $_GET["email"];
		$curDate = date("Y-m-d H:i:s");
	}
	
	// From form
	if(isset($_POST["email"]) && isset($_POST["action"]) &&
	($_POST["action"]=="update"))
	{
		$password = stripslashes($_POST['password']);
		$password = mysqli_real_escape_string($connection,$password);
		$email = $_POST["email"];
		$key = $_POST["key"];
		$curDate = date("Y-m-d H:i:s");
		
		// Password hash
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		
		$updatePassword = mysqli_query($connection,"UPDATE tblUser SET `User_Password`='".$password_hash."' WHERE `User_Email`='".$email."';");
		
		if ($updatePassword)
		{
			$resetMsg = '
				<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
					<span class="badge badge-pill badge-success">Success</span>
						Password reset successful! Please login to continue.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
			mysqli_query($connection,"DELETE FROM tblReset WHERE `User_Email`='".$email."';");
			
			$sql = "SELECT * From tblUser WHERE User_Email = '{$email}' ";
			$query = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($query);
			$name = $row['User_Name'];
			
			// Reset password email contents
			$output='<p>Dear '.$name.',</p>';
			$output.='<p>Your password has been changed. If you did not make this change, please reset to a new password from this link</p>';
			$output.='<p>-------------------------------------------------------------</p>';
			$output.='<p><a href="http://localhost/TRMS/forgot_password.php" target="_blank">
			http://localhost/TRMS/forgot_password.php</a></p>'; 
			$output.='<p>-------------------------------------------------------------</p>';
			$output.='<p>If you did request this password change, No action is needed.</p>';   
			$output.='<p>Thanks,<br>';
			$output.='TRMS Admin</p>';
			
			//Email items
			$body = $output; 
			$subject = "Password Changed - TRMS";
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
			
			$mailer->send($message);
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="TRMS Template">
    <meta name="author" content="NPR">
    <meta name="keywords" content="TRMS Template">

    <!-- Title Page-->
    <title>TRMS Reset Password</title>
	<link rel="shortcut icon" href="images/icon/favicon-tm.png">

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    
    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper-login">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo-tm.png" alt="TSSSB" style="width: 50%; height: 50%">
                            </a>
                            <br />
                            <p style="text-align:center">Telekom Sales & Services Sdn. Bhd.</p>
                            <h2 class="pb-2 display-5">Technical Report Management System</h2>
                        </div>
                        <div class="login-form">
						<?php
						if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) 
						&& ($_GET["action"]=="reset") && !isset($_POST["action"]))
						{
							$query = mysqli_query($connection,
							"SELECT * FROM tblReset WHERE `Reset_Key`='".$key."' and `User_Email`='".$email."';"
							);
							
							$row = mysqli_num_rows($query);
							if ($row=="")
							{
								$resetMsg = '
									<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
										<span class="badge badge-pill badge-danger">Invalid</span>
											The link is invalid or you have already used the key.
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
								';
							}
							else
							{
								$row = mysqli_fetch_assoc($query);
								$expDate = $row['Reset_Expiry'];
								if ($expDate >= $curDate)
								{
									$sql = "SELECT * From tblUser WHERE User_Email = '{$email}' ";
									$query = mysqli_query($connection, $sql);
									$row = mysqli_fetch_array($query);
									$staff = $row['User_Staff_No'];
									?>
									<form id="frmReset" action="" method="post">
										<div class="form-group">
											<label>Email Address</label>
											<input class="au-input au-input--full" type="email" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" readonly="true">
											<input type="hidden" name="action" value="update" />
											<input type="hidden" name="key" value="<?php echo $key; ?>" />
										</div>
										<div class="form-group">
											<label>Staff No.</label>
											<input class="au-input au-input--full" type="text" name="staff_no" id="staff_no" placeholder="Staff No" value="<?php echo $staff; ?>" readonly="true">
										</div>
										<div class="form-group">
											<label>Enter New Password</label>
											<input class="au-input au-input--full" type="password" name="password" id="password" placeholder="Password" onkeyup='check();'>
											<label id="password-error" class="error text-danger" for="password"></label>
										</div>
										<div class="form-group">
											<label>Confirm New Password     <span id="message"></span></label>
											<input class="au-input au-input--full" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" onkeyup='check();'>
											<label id="confirm_password-error" class="error text-danger" for="confirm_password"></label>
										</div>
										<button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit" name="btnForgot" id="btnForgot">RESET</button>
									</form>
									<?php
								}
								else
								{
									$resetMsg = '
										<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
											<span class="badge badge-pill badge-danger">Expired</span>
												The link has expired, please try again.
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
									';
								}
							}
						}
							
							echo $resetMsg;
						?>
                            <div class="register-link">
                                <p>
                                    Already have an account?
                                    <a href="index.php">Login Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
	
    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/animsition/animsition.min.js"></script>
	<script src="vendor/jquery-validation-1.19.2/dist/jquery.validate.min.js"></script>
    <!-- Main JS-->
    <script src="js/main.js"></script>
	<!-- Form Validation-->
	<script>
	$(function() {
	   $( "#frmReset" ).validate({
			rules:
			{
				password: {required: true, minlength: 8},
				confirm_password: {required: true, equalTo: "#password"},
			},
			messages:
			{
				password: 
				{
					required: "Please key in your new password",
					minlength: "Password must be at least 8 characters",
				},
				confirm_password: 
				{
					required: "Please key in your new password again",
					equalTo: "Password must be matching",
				},
			}
		});
	});
	</script>
</body>

</html>
<!-- end document-->
