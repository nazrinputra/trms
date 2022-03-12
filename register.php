<?php
	include('./controllers/register_control.php');
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
    <title>TRMS Register</title>
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
		<?php echo $email_exist; ?>
		<?php echo $staff_exist; ?>
		<?php echo $email_verify_err; ?>
		<?php echo $email_verify_success; ?>
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
					<form id="frmRegister" action="" method="post">
						<div class="form-group">
							<label>Enter Staff No.</label>
							<input class="au-input au-input--full" type="text" name="staff_no" id="staff_no" placeholder="Staff No">
							<label id="staff_no-error" class="error text-danger" for="staff_no"></label>
						</div>
						<div class="form-group">
							<label>Enter Full Name</label>
							<input class="au-input au-input--full" type="text" name="name" id="name" placeholder="Full Name">
							<label id="name-error" class="error text-danger" for="name"></label>
						</div>
						<div class="form-group">
							<label>Enter Email Address</label>
							<input class="au-input au-input--full" type="email" name="email" id="email" placeholder="Email">
							<label id="email-error" class="error text-danger" for="email"></label>
						</div>
						<div class="form-group">
							<label>Enter Password</label>
							<input class="au-input au-input--full" type="password" name="password" id="password" placeholder="Password" onkeyup='check();'>
							<label id="password-error" class="error text-danger" for="password"></label>
						</div>
						<div class="form-group">
							<label>Enter Confirm Password     <span id="message"></span></label>
							<input class="au-input au-input--full" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" onkeyup='check();'>
							<label id="confirm_password-error" class="error text-danger" for="confirm_password"></label>
						</div>
						<div class="form-group">
							<label for="gender">Choose your Gender:</label>
								<div class="col-12 col-md-9">
									<select name="gender" id="gender" class="form-control">
										<option value="">Please select</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
									<label id="gender-error" class="error text-danger" for="gender"></label>
								</div>
						</div>
						<button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit" name="btnRegister" id="btnRegister">REGISTER</button>
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

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/animsition/animsition.min.js"></script>
	<script src="vendor/jquery-validation-1.19.2/dist/jquery.validate.min.js"></script>
    <!-- Main JS-->
    <script src="js/main.js"></script>
	<!-- Form Validation-->
	<script>
	$(function() {
	   $( "#frmRegister" ).validate({
			rules:
			{
				staff_no: {required: true},
				name: {required: true},
				email: {required: true, email: true},
				password: {required: true, minlength: 8},
				confirm_password: {required: true, equalTo: "#password"},
				gender: {required: true},
				role: {required: true},
			},
			messages:
			{
				staff_no: "Please key in your staff number",
				name: "Please key in your name",
				email: 
				{
					required: "Please key in your email",
					email: "Email address is incomplete",
				},
				password: 
				{
					required: "Please key in your password",
					minlength: "Password must be at least 8 characters",
				},
				confirm_password: 
				{
					required: "Please key in your password again",
					equalTo: "Password must be matching",
				},
				gender: "Please specify your gender",
				role: "Please select your role",
			}
		});
	});
	</script>
</body>

</html>
<!-- end document-->
