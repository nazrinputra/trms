<?php
	include('controllers/forgot_password_control.php');
	if(isset($_SESSION["id"]))
	{
		header("Location: http://localhost/TRMS/dashboard.php");
		exit(); 
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

    <title>TRMS Forgot Password</title>
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
							<?php echo $email_reset_err; ?>
							<?php echo $email_reset_success; ?>
                            <form id="frmForgot" action="" method="post">
								<strong>Forgot Your Password?</strong>
								<div class="form-group">
                                    <label>Enter your email address to reset password</label>
                                    <input class="au-input au-input--full" type="email"  name="email" id="email" placeholder="Email">
									<label id="email-error" class="error text-danger" for="email"></label>
                                </div>
								<div class="login-checkbox" style="float : right;">
                                    <label>
                                        <a href="register.php">Create Account?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit" name="btnForgot" id="btnForgot">SEND</button>
                            </form>
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
	   $( "#frmForgot" ).validate({
			rules:
			{
				email: {required: true, email: true},
			},
			messages:
			{
				email: 
				{
					required: "Please key in your email address",
					email: "Email address incomplete",
				},
			}
		});
	});
	</script>
</body>

</html>
<!-- end document-->
