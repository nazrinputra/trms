<?php
	include('config/db.php');
	include('config/auth.php');
	include('./controllers/edit_job_control.php');
	
	$sql = "SELECT * From tblNotification WHERE Noti_Is_Active = 'Yes' ";
	$query = mysqli_query($connection, $sql);
	$notiCount = mysqli_num_rows($query);
	
	if(!$query)
	{
		die("SQL query failed: " . mysqli_error($connection));
	}
	
	if(isset($_GET['job_id']))
	{
		$service_id = $_GET['job_id'];
	}
	if(!isset($_GET['job_id']))
	{
		header("Location: job.php");
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
    <title>TRMS › Form › Customer › Job</title>
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
                                        <li class="list-inline-item active">Form</li>
										<li class="list-inline-item seprate">
                                            <span>›</span>
                                        </li>
                                        <li class="list-inline-item active"><a href="customer.php">Customer</a></li>
										<li class="list-inline-item seprate">
                                            <span>›</span>
                                        </li>
                                        <li class="list-inline-item active">Job</li>
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
			
			<!-- ALERT DISMISS-->
			<?php 
			if(isset($_SESSION["CustomerSuccess"]))
			{
				echo $_SESSION['CustomerSuccess']; unset ($_SESSION['CustomerSuccess']);
			}
			echo $jobSuccess;
			?>
			<!-- END ALERT DISMISS-->

			<div class="container-fluid">
				<!-- FORM-->
				<div class="card">
					<div class="card-header">
						<strong>JOB SHEET</strong> 
					</div>
					<div class="card-body card-block">
					<form id="frmJob" action="" method="post" class="form-horizontal">
						<div class="row form-group">
							<div class="col col-md-3">
								<label for="jobsheet-input" class=" form-control-label">Job Sheet No.</label>
							</div>
							<?php
								$sql = "SELECT * From tblService WHERE Service_ID = '{$service_id}'";
								$result = mysqli_query($connection, $sql);
								while($rowService = mysqli_fetch_array($result)) 
								{
									$service_title = $rowService['Service_Title'];
									$service_desc = $rowService['Service_Description'];
									$service_status = $rowService['Service_Status'];
									$service_type = $rowService['Service_Type'];
									$service_date = $rowService['Service_Date'];
									$service_cust_id = $rowService['Cust_ID'];
									$service_user_id = $rowService['User_ID'];
								}
							?>
							<div class="col-12 col-md-9">
								<input type="text" id="job_id" name="job_id" placeholder="Job ID" class="form-control" value="SV<?php echo $service_id; ?>" readonly="true">
							</div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3">
								<label for="select" class="form-control-label">Customer</label>
							</div>
							<div class="col-12 col-md-9 input-group">
								<select name="customer_id" id="customer_id" class="form-control" onchange="getCustInfo()">
									<option value="">Please select</option>
									<?php
										$sql = "SELECT * From tblCustomer WHERE Cust_Is_Active = 'Yes' ";
										$query = mysqli_query($connection, $sql);
										$notiCount = mysqli_num_rows($query);
										
										if(!$query)
										{
											die("SQL query failed: " . mysqli_error($connection));
										}
										
										while($rowCust = mysqli_fetch_array($query)) 
										{
											$cust_id = $rowCust['Cust_ID'];
											$cust_name = $rowCust['Cust_Name'];
											$cust_project = $rowCust['Cust_Project'];
											$cust_division = $rowCust['Cust_Division'];
											
											if($service_cust_id == $cust_id)
											{
												$selected = "selected";
											}
											else
											{
												$selected = "";
											}
											
											echo '
												<option value="'.$cust_id.'" '.$selected.'>'.$cust_name.' ( '.$cust_division.', '.$cust_project.' )</option>
											';
										}
									?>
								</select>
								<?php
									//get selected for user info
								?>
								<div class="input-group-append">
									<span id="cust_info">
									<a href="edit_customer.php?cust_id=<?php echo $cust_id; ?>">
										<button type="button" class="btn btn-secondary">
											<i class="fa fa-info"></i>  INFO
										</button>
									</a>
									</span>
								</div>
								<div class="input-group-append">
									<a href="customer.php">
										<button type="button" class="btn btn-primary">
											<i class="fa fa-plus"></i>  ADD
										</button>
									</a>
								</div>
							</div>
							<div class="col col-md-3">
								<label for="contact-input" class=" form-control-label">&nbsp;</label>
							</div>
							<div class="col-12 col-md-9">
								<label id="customer_id-error" class="error text-danger" for="customer_id"></label>
							</div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3">
								<label for="contact-input" class=" form-control-label">Date</label>
							</div>
							<div class="col-12 col-md-9">
								<input type="date" id="job_date" name="job_date" value="<?php echo $service_date; ?>" class="form-control">
							</div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3">
								<label class=" form-control-label">Type of Plan</label>
							</div>
							<div class="col col-md-9">
								<div class="form-check">
									<div class="radio">
										<input type="radio" id="radInstallation" name="job_type" value="Installation" class="form-check-input" <?php if($service_type=='Installation'){echo 'checked';} ?> >Installation
									</div>
									<div class="radio">
										<input type="radio" id="radService" name="job_type" value="Service Call" class="form-check-input" <?php if($service_type=='Service Call'){echo 'checked';} ?> >Service Call
									</div>
									<div class="radio">
										<input type="radio" id="radCable" name="job_type" value="Cable Work" class="form-check-input" <?php if($service_type=='Cable Work'){echo 'checked';} ?> >Cable Work
									</div>
									<div class="radio">
										<input type="radio" id="radContract" name="job_type" value="Contract" class="form-check-input" <?php if($service_type=='Contract'){echo 'checked';} ?> >Contract
									</div>
									<div class="radio">
										<input type="radio" id="radSurvey" name="job_type" value="Survey" class="form-check-input" <?php if($service_type=='Survey'){echo 'checked';} ?> >Survey
									</div>
								</div>
								<label id="job_type-error" class="error text-danger" for="job_type"></label>
							</div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3">
								<label for="title-input" class=" form-control-label">Title</label>
							</div>
							<div class="col-12 col-md-9">
								<input type="text" id="job_title" name="job_title" placeholder="Title" class="form-control" value="<?php echo $service_title; ?>">
								<label id="job_title-error" class="error text-danger" for="job_title"></label>
							</div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3">
								<label for="desc-input" class=" form-control-label">Description</label>
							</div>
							<div class="col-12 col-md-9">
								<textarea name="job_desc" id="job_desc" rows="5" placeholder="Description" class="form-control"><?php echo $service_desc; ?></textarea>
								<label id="job_desc-error" class="error text-danger" for="job_desc"></label>
							</div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3">
								<label for="select" class=" form-control-label">Status</label>
							</div>
							<div class="col-12 col-md-9">
								<select name="job_status" id="job_status" class="form-control">
									<option value="">Please select</option>
									<option value="Open" <?php if($service_status=='Open'){echo 'selected';} ?>>Open</option>
									<option value="Pending" <?php if($service_status=='Pending'){echo 'selected';} ?>>Pending</option>
									<option value="Closed" <?php if($service_status=='Closed'){echo 'selected';} ?>>Closed</option>
								</select>
							</div>
						</div>
						<?php
							if($_SESSION['role'] == 'Admin')
							{
								?>
									<div class="row form-group">
										<div class="col col-md-3">
											<label for="select" class=" form-control-label">Assign Tech</label>
										</div>
										<div class="col-12 col-md-9">
											<select name="job_assign" id="job_assign" class="form-control">
												<option value="">Please select</option>
												<?php
													$sql = "SELECT * From tblUser WHERE User_Is_Active = 'Yes' ";
													$query = mysqli_query($connection, $sql);
													$notiCount = mysqli_num_rows($query);
													
													if(!$query)
													{
														die("SQL query failed: " . mysqli_error($connection));
													}
													
													while($rowCust = mysqli_fetch_array($query)) 
													{
														$tech_id = $rowCust['User_ID'];
														$tech_name = $rowCust['User_Name'];
														$tech_email = $rowCust['User_Email'];
														$tech_staff = $rowCust['User_Staff_No'];
														
														if($service_user_id == $tech_id)
														{
															$selected = 'selected';
														}
														else
														{
															$selected = '';
														}
														
														echo '
															<option value="'.$tech_id.'" '.$selected.'>'.$tech_name.' ( '.$tech_staff.' )</option>
														';
													}
												?>
											</select>
										</div>
									</div>
								<?php
							}
						?>
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-primary" name="btnJob" id="btnJob">
							<i class="fa fa-arrow-circle-right"></i> UPDATE
						</button>
						<button type="reset" class="btn btn-danger">
							<i class="fa fa-ban"></i> RESET
						</button>
					</div>
					</form>
				</div>
				<!-- END FORM-->
			</div>
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
		<!-- END PAGE CONTENT-->
		
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
        </div><!-- end page-wrapper-->
    </div><!-- end page-wrapper-login-->

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
	   $( "#frmJob" ).validate({
			rules:
			{
				customer_id: {required: true},
				job_type: {required: true},
				job_title: {required: true},
				job_desc: {required: true},
			},
			messages:
			{
				customer_id: "Please select a customer",
				job_type: "Please select a job type",
				job_title: "Please enter the job title",
				job_desc: "Please enter the job description",
			}
		});
	});
	</script>
	<script>
	function getCustInfo() {
	  var x = document.getElementById("customer_id").value;
	  if(x=="")
	  {
		  document.getElementById("cust_info").innerHTML = '';
	  }
	  else
	  {
		  document.getElementById("cust_info").innerHTML = '<a href="edit_customer.php?cust_id='+x+'"><button type="button" class="btn btn-secondary"><i class="fa fa-info"></i>  INFO</button></a>';
	  }
	}
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

