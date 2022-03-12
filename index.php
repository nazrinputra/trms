<?php
	include('controllers/login_control.php');
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

    <!-- Title Page-->
    <title>TRMS Login</title>
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
    <div class="page-wrapper-register">
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
							<?php echo $accountNotExistErr; ?>
							<?php echo $emailPwdErr; ?>
							<?php echo $verificationRequiredErr; ?>
                            <form id="frmLogin" action="" method="post">
                                <div class="form-group">
                                    <label>Staff No.</label>
                                    <input class="au-input au-input--full" type="text" name="staff_no" id="staff_no" placeholder="Staff No">
									<label id="staff_no-error" class="error text-danger" for="staff_no"></label>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" id="password" placeholder="Password">
									<label id="password-error" class="error text-danger" for="password"></label>
                                </div>
								<div class="login-checkbox" style="float : right;">
                                    <label>
                                        <a href="forgot_password.php">Forgotten Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit" name="btnLogin" id="btnLogin">LOGIN</button>
                            </form>
                            <div class="register-link">
                                <p>
									No account yet?
									<a href="register.php">Click here to register</a>
								</p>
                            </div>
                        </div>
                    </div>
					<br>
					
					<br>
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
	   $( "#frmLogin" ).validate({
			rules:
			{
				staff_no: {required: true},
				password: {required: true, minlength: 8},
			},
			messages:
			{
				staff_no: "Please key in your staff number",
				password: 
				{
					required: "Please key in your password",
					minlength: "Password must be at least 8 characters",
				},
			}
		});
	});
	</script>
</body>

</html>
<!-- end document-->