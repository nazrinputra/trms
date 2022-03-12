<?php
	include('config/db.php');
	include('config/auth.php');
	include('./controllers/edit_account_control.php');
	
	$sql = "SELECT * From tblNotification WHERE Noti_Is_Active = 'Yes' ";
	$query = mysqli_query($connection, $sql);
	$notiCount = mysqli_num_rows($query);
	
	if(!$query)
	{
		die("SQL query failed: " . mysqli_error($connection));
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
    <title>TRMS › Edit Account</title>
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
	<link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    
    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper-login">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="index.php">
                            <img src="images/icon/logo-tm-white.png" alt="TSSSB" style="padding-left:10px;"/>
							<p style="display: block; color: white; font-size: 5pt;">Telekom Sales & Services Sdn. Bhd.</p>
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li>
                                <a href="dashboard.php">
                                    <i class="fas fa-desktop"></i>Dashboard
                                    <span class="bot-line"></span>
                                </a>  
                            </li>
                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-copy"></i>
                                    <span class="bot-line"></span>Form
								</a>
								<ul class="header3-sub-list list-unstyled">
									<li>
                                        <a href="customer.php">Customer</a>
                                    </li>
									<li>
                                        <a href="job.php">Job</a>
                                    </li>
                                </ul>
                            </li>
							<li>
                                <a href="record.php">
                                    <i class="fas fa-archive"></i>
                                    <span class="bot-line"></span>Record</a>
                            </li>
							<li>
                                <a href="calendar.php">
                                    <i class="fas fa-calendar"></i>
                                    <span class="bot-line"></span>Calendar</a>
                            </li>
                            <li>
                                <a href="feedback.php">
                                    <i class="fas fa-comment"></i>
                                    <span class="bot-line"></span>Feedback</a>
                            </li>
                        </ul>
                    </div>
                    <div class="header__tool">
                        <div class="header-button-item <?php if($notiCount!='0'){echo 'has-noti';} ?> js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                                <div class="notifi__title">
                                    <p>You have <?php if($notiCount=='0'){echo 'no';}else{echo $notiCount;} ?> Notifications</p>
                                </div>
								
                                <!-- ALERT DROPDOWN-->
								<?php
									if($notiCount <= 0) 
									{
										echo '
											<div class="header-button-subitem">
												<div class="alert alert-primary" role="alert">
													You are all caught up!
												</div>
											</div><br>
										';
									}
									else
									{
										$sql = "SELECT * From tblNotification WHERE Noti_Is_Active = 'Yes' ";
										$query = mysqli_query($connection, $sql);
										while($rowNoti = mysqli_fetch_array($query)) 
										{
											$id = $rowNoti['Noti_ID'];
											$title = $rowNoti['Noti_Title'];
											$content = $rowNoti['Noti_Content'];
											$class = $rowNoti['Noti_Class'];
											$date = $rowNoti['Noti_Date_Added'];
											
											echo '
												<div class="header-button-subitem" onClick="openPopup'.$id.'()">
													<div class="alert alert-'.$class.' role="alert">
														'.$title.'
													</div>
												</div>
											';
										}
									}
								?>
								<!-- END ALERT DROPDOWN-->
								
                                <div class="notifi__footer">
                                    <a href="notification.php">All notifications</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="image">
                                    <img src="<?php echo $_SESSION['avatar']; ?>" alt="<?php echo $_SESSION['name']; ?>" />
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#"><?php echo $_SESSION['name']; ?></a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                <img src="<?php echo $_SESSION['avatar']; ?>" alt="<?php echo $_SESSION['name']; ?>" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#"><?php echo $_SESSION['name']; ?></a>
                                            </h5>
                                            <span class="email"><?php echo $_SESSION['email']; ?></span>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
										<div class="account-dropdown__item">
                                            <a href="account.php">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="https://www.tm.com.my/Pages/Home.aspx" target="_blank">
                                                <i class="zmdi zmdi-globe"></i>About TM</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="controllers/logout.php">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->
		
		<!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.php">
                            <img src="images/icon/logo-tm-white.png" alt="TSSSB" style="padding-left:10px;"/>
							<p style="display: block; color: white; font-size: 5pt;">Telekom Sales & Services Sdn. Bhd.</p>
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
							<a href="dashboard.php">
								<i class="fas fa-desktop"></i>Dashboard
								<span class="bot-line"></span>
							</a>  
						</li>
						<li class="has-sub">
                            <a class="js-arrow" a href="#">
                                <i class="fas fa-copy"></i>Form
							</a>
							<ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="customer.php">Customer</a>
                                </li>
								<li>
                                    <a href="job.php">Job</a>
                                </li>
                            </ul>
                        </li>
						<li>
							<a href="record.php">
								<i class="fas fa-archive"></i>
								<span class="bot-line"></span>Record
							</a>
						</li>
						<li>
							<a href="calendar.php">
								<i class="fas fa-calendar"></i>
								<span class="bot-line"></span>Calendar
							</a>
						</li>
						<li>
							<a href="feedback.php">
								<i class="fas fa-comment"></i>
								<span class="bot-line"></span>Feedback
							</a>
						</li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none">
            <div class="header__tool">
                <div class="header-button-item <?php if($notiCount!='0'){echo 'has-noti';} ?> js-item-menu">
                    <i class="zmdi zmdi-notifications"></i>
                    <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                        <div class="notifi__title">
                            <p>You have <?php if($notiCount=='0'){echo 'no';}else{echo $notiCount;} ?> Notifications</p>
                        </div>
                        <!-- ALERT DROPDOWN-->
						<?php
							if($notiCount <= 0) 
							{
								echo '
									<div class="header-button-subitem">
										<div class="alert alert-primary" role="alert">
											You are all caught up!
										</div>
									</div><br>
								';
							}
							else
							{
								$sql = "SELECT * From tblNotification WHERE Noti_Is_Active = 'Yes' ";
								$query = mysqli_query($connection, $sql);
								while($rowNoti = mysqli_fetch_array($query)) 
								{
									$id = $rowNoti['Noti_ID'];
									$title = $rowNoti['Noti_Title'];
									$content = $rowNoti['Noti_Content'];
									$class = $rowNoti['Noti_Class'];
									$date = $rowNoti['Noti_Date_Added'];
									
									echo '
										<div class="header-button-subitem" onClick="openPopup'.$id.'()">
											<div class="alert alert-'.$class.' role="alert">
												'.$title.'
											</div>
										</div>
									';
								}
							}
						?>
						<!-- END ALERT DROPDOWN-->
                        <div class="notifi__footer">
                            <a href="notification.php">All notifications</a>
                        </div>
                    </div>
                </div>
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            <img src="<?php echo $_SESSION['avatar']; ?>" alt="<?php echo $_SESSION['name']; ?>" />
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="#"><?php echo $_SESSION['name']; ?></a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="#">
                                        <img src="<?php echo $_SESSION['avatar']; ?>" alt="<?php echo $_SESSION['name']; ?>" />
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        <a href="#"><?php echo $_SESSION['name']; ?></a>
                                    </h5>
                                    <span class="email"><?php echo $_SESSION['email']; ?></span>
                                </div>
                            </div>
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                            <a href="account.php">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                <div class="account-dropdown__item">
                                    <a href="https://www.tm.com.my/Pages/Home.aspx" target="_blank">
                                        <i class="zmdi zmdi-globe"></i>About TM</a>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="controllers/logout.php">
                                    <i class="zmdi zmdi-power"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END HEADER MOBILE -->
		
		<div class="page-wrapper">
        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
		
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    <span class="au-breadcrumb-span">You are here:</span>
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                        <li class="list-inline-item active"><a href="index.php">TRMS</a></li>
                                        <li class="list-inline-item seprate">
                                            <span>›</span>
                                        </li>
                                        <li class="list-inline-item active"><a href="account.php">Account</a></li>
										<li class="list-inline-item seprate">
                                            <span>›</span>
                                        </li>
                                        <li class="list-inline-item active">Edit Account</li>
                                    </ul>
                                </div>
                                <form id="frmSearch" class="au-form-icon--sm" action="search.php" method="post">
                                    <input name="search" id="search" class="au-input--w300 au-input--style2" type="text" placeholder="Search for customer...">
                                    <button name="btnSearch" id="btnSearch" class="au-btn--submit2" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

			<?php
				$bio = $_SESSION['bio'];
				if($bio == "")
				{
					$bio = "Enter Biography";
				}
				$position = $_SESSION['position'];
				if($position == "")
				{
					$position = "Enter Position";
				}
				$phone = $_SESSION['phone'];
				if($phone == "")
				{
					$phone = "Enter Phone Number";
				}
				$address = $_SESSION['address'];
				if($address == "")
				{
					$address = "Enter Address";
				}
			?>
			<!-- PROFILE-->
			<section class="section about-section gray-bg" id="about">
				<div class="container">
					<form id="frmProfile" action="" method="post">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-lg-6">
							<div class="about-text go-to">
								<h3 class="dark-color"><?php echo $_SESSION['role']; ?> @ TRMS</h3>
								<div class="row about-list-edit">
									<div class="col-lg-6">
										<div class="media-profile">
											<label>Staff No</label>
											<input class="au-input-profile form-control" type="text" name="staff_no" id="staff_no" placeholder="<?php echo $_SESSION['staff_no']; ?>" value="<?php echo $_SESSION['staff_no']; ?>" readonly="true">
											<label id="staff_no-error" class="error text-danger" for="staff_no"><br></label>
										</div>
										<div class="media-profile">
											<label>Email</label>
											<input class="au-input-profile form-control" type="email" name="email" id="email" placeholder="<?php echo $_SESSION['email']; ?>" value="<?php echo $_SESSION['email']; ?>" readonly="true">
											<label id="email-error" class="error text-danger" for="email"><br></label>
										</div>
										<div class="media-profile">
											<label>Name</label>
											<input class="au-input-profile form-control" type="text" name="name" id="name" placeholder="<?php echo $_SESSION['name']; ?>" value="<?php echo $_SESSION['name']; ?>">
											<label id="name-error" class="error text-danger" for="name"><br></label>
										</div>
										<div class="media-profile">
											<label>Gender</label>
											<select name="gender" id="gender" class="au-input-profile form-control">
												<option value="">Please select</option>
												<option value="Male" <?php if($_SESSION['gender']=='Male'){echo 'selected';} ?>>Male</option>
												<option value="Female" <?php if($_SESSION['gender']=='Female'){echo 'selected';} ?>>Female</option>
											</select>
											<label id="gender-error" class="error text-danger" for="gender"><br></label>
										</div>
										<div class="media-profile">
											<label>Position</label>
											<input class="au-input-profile form-control" type="text" name="position" id="position" placeholder="<?php echo $position; ?>" value="<?php echo $position; ?>">
											<label id="position-error" class="error text-danger" for="position"><br></label>
										</div>
										<div class="media-profile">
											<label>Phone</label>
											<input class="au-input-profile form-control" type="text" name="phone" id="phone" placeholder="<?php echo $phone; ?>" value="<?php echo $phone; ?>">
											<label id="phone-error" class="error text-danger" for="phone"><br></label>
										</div>
										<div class="media-profile">
											<label>Address</label>
											<textarea name="address" id="address" rows="10" placeholder="<?php echo $address; ?>" class="au-input-profile form-control" style="padding-top: 5px;"><?php echo $address; ?></textarea>
											<label id="address-error" class="error text-danger" for="address"><br></label>
										</div>
										<div class="media-profile">
											<label>Biography</label>
											<textarea name="bio" id="bio" rows="10" placeholder="<?php echo $bio; ?>" class="au-input-profile form-control" style="padding-top: 5px;"><?php echo $bio; ?></textarea>
											<label id="bio-error" class="error text-danger" for="bio"><br></label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="about-avatar">
								<img src="<?php echo $_SESSION['avatar']; ?>" alt="<?php echo $_SESSION['name']; ?>">
							</div>
							
						</div>
					</div>
					<div style="display: flex;content: center; padding-top:30px;">
						<a href="choose_avatar.php"  style="display: inline-block; margin: auto; text-align: center;"><button class="au-btn au-btn--blue" type="button" name="btnAvatar" id="btnAvatar">CHANGE AVATAR</button></a>
						<button class="au-btn au-btn--blue" type="submit" name="btnUpdate" id="btnUpdate" style="display: inline-block; margin: auto;text-align: center;">UPDATE PROFILE</button>
					</div>
					</form>
				</div>
			</section>
			<!-- END PROFILE-->
			
			<!-- modal medium -->
			<?php
			$sql = "SELECT * From tblNotification WHERE Noti_Is_Active = 'Yes' ";
			$query = mysqli_query($connection, $sql);
			while($rowNoti = mysqli_fetch_array($query)) 
			{
				$id = $rowNoti['Noti_ID'];
				$title = $rowNoti['Noti_Title'];
				$content = $rowNoti['Noti_Content'];
				$class = $rowNoti['Noti_Class'];
				$date = $rowNoti['Noti_Date_Added'];
				
				echo '
					<div class="modal fade" id="modal'.$id.'" tabindex="-1" role="dialog" aria-labelledby="modal'.$id.'Label" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header modal-header-'.$class.'">
									<h5 class="modal-title" id="modal'.$id.'Label">'.$title.'</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>
										'.$content.'
									</p>
								</div>
							</div>
						</div>
					</div>
				';
			}
			?>
			<!-- end modal medium -->
		</div>
		
            <!-- COPYRIGHT-->
            <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © <?php echo date("Y"); ?> NPR. All rights reserved. <a href="template.html">Template by NPR</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>
    </div><!-- end page-wrapper-->

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
	<script src="vendor/jquery-validation-1.19.2/dist/jquery.validate.min.js"></script>
    <!-- Main JS-->
    <script src="js/main.js"></script>
	<script>
	$(function() {
	   $( "#frmProfile" ).validate({
			rules:
			{
				name: {required: true},
				gender: {required: true},
				position: {required: true},
				phone: {required: true},
				address: {required: true},
				bio: {required: true},
			},
			messages:
			{
				name: "Name is required",
				gender: "Gender is required",
				position: "Position is required",
				phone: "Phone is required",
				address: "Address is required",
				bio: "Biography is required",
			}
		});
	});
	</script>
	<?php
		$sql = "SELECT * From tblNotification WHERE Noti_Is_Active = 'Yes' ";
		$query = mysqli_query($connection, $sql);
		while($rowNoti = mysqli_fetch_array($query)) 
		{
			$id = $rowNoti['Noti_ID'];
			$title = $rowNoti['Noti_Title'];
			$content = $rowNoti['Noti_Content'];
			$class = $rowNoti['Noti_Class'];
			$date = $rowNoti['Noti_Date_Added'];
			
			echo '
				<script>
				function openPopup'.$id.'() 
				{
					$("#modal'.$id.'").modal();
				}
				</script>
			';
		}
	?>
</body>

</html>
<!-- end document-->

