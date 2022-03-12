<?php
	include('config/db.php');
	include('config/auth.php');
	
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
    <title>TRMS › Dashboard</title>
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
                                        <li class="list-inline-item active">TRMS</li>
                                        <li class="list-inline-item seprate">
                                            <span>›</span>
                                        </li>
                                        <li class="list-inline-item">Dashboard</li>
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
				if(isset($_SESSION["success"]))
				{
					echo '
						<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
							<span class="badge badge-pill badge-success">Success</span>
							You successfully logged in to the system.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<section class="welcome p-t-10">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<h1 class="title-4">Welcome back, 
											<span>'.$_SESSION['name'].'</span>
										</h1>
										<hr class="line-seprate">
									</div>
								</div>
							</div>
						</section>
					';
					unset ($_SESSION["success"]);
				}
			?>
			<!-- END ALERT DISMISS-->
			
			<?php
				$install = mysqli_query($connection, "SELECT COUNT(*) AS install FROM tblservice WHERE `Service_Type`='Installation'");
				if($install)
				{
					$row = mysqli_fetch_array($install);
					$numInstall = $row['install'];
				}
				else
				{
					$numInstall = "";
				}
				
				$service_call = mysqli_query($connection, "SELECT COUNT(*) AS service_call FROM tblservice WHERE `Service_Type`='Service Call'");
				if($service_call)
				{
					$row = mysqli_fetch_array($service_call);
					$numService = $row['service_call'];
				}
				else
				{
					$numService = "";
				}
				
				$cable = mysqli_query($connection, "SELECT COUNT(*) AS cable FROM tblservice WHERE `Service_Type`='Cable Work'");
				if($cable)
				{
					$row = mysqli_fetch_array($cable);
					$numCable = $row['cable'];
				}
				else
				{
					$numCable = "";
				}
				
				$contract = mysqli_query($connection, "SELECT COUNT(*) AS contract FROM tblservice WHERE `Service_Type`='Contract'");
				if($contract)
				{
					$row = mysqli_fetch_array($contract);
					$numContract = $row['contract'];
				}
				else
				{
					$numContract = "";
				}
				
				$survey = mysqli_query($connection, "SELECT COUNT(*) AS survey FROM tblservice WHERE `Service_Type`='Survey'");
				if($survey)
				{
					$row = mysqli_fetch_array($survey);
					$numSurvey = $row['survey'];
				}
				else
				{
					$numSurvey = "";
				}
				
				$total = mysqli_query($connection, "SELECT COUNT(*) AS total FROM tblservice");
				if($total)
				{
					$row = mysqli_fetch_array($total);
					$numTotal = $row['total'];
				}
				else
				{
					$numTotal = "";
				}
			?>
			<!-- STATISTIC-->
            <section class="statistic statistic2">
                <div class="container">
                    <div class="row">
                        <div class="col col-md-6">
                            <div class="statistic__item statistic__item--green">
                                <h2 class="number"><?php echo $numInstall; ?></h2>
                                <span class="desc">installations</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-wrench"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="statistic__item statistic__item--orange">
                                <h2 class="number"><?php echo $numService; ?></h2>
                                <span class="desc">service calls</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-alert-triangle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number"><?php echo $numCable; ?></h2>
                                <span class="desc">cable works</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-input-composite"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="statistic__item statistic__item--red">
                                <h2 class="number"><?php echo $numContract; ?></h2>
                                <span class="desc">contracts</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-assignment"></i>
                                </div>
                            </div>
                        </div>
						<div class="col col-md-6">
                            <div class="statistic__item statistic__item--magenta">
                                <h2 class="number"><?php echo $numSurvey; ?></h2>
                                <span class="desc">surveys</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-comments"></i>
                                </div>
                            </div>
                        </div>
						<div class="col col-md-6">
							<div class="statistic__item statistic__item--yellow">
                                <h2 class="number"><?php echo $numTotal; ?></h2>
								<span class="desc">total jobs</span>
								<div class="icon">
									<i class="zmdi zmdi-layers"></i>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->
			
			<!--CHART-->
			<div class="container-fluid">
                <div class="row">
					<div class="col-lg-6">
						<div class="au-card m-b-30">
							<div class="au-card-inner">
								<h3 class="title-2 m-b-40">Jobs Recorded by Type</h3>
								<canvas id="barChartType"></canvas>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="au-card m-b-30">
							<div class="au-card-inner">
								<h3 class="title-2 m-b-40">Trend of Jobs Recorded</h3>
								<canvas id="lineChartJob"></canvas>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="au-card m-b-30">
							<div class="au-card-inner">
								<h3 class="title-2 m-b-40">Top Assigned Technicians</h3>
								<canvas id="doughutChartTech"></canvas>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="au-card m-b-30">
							<div class="au-card-inner">
								<h3 class="title-2 m-b-40">Total Technicians Registered</h3>
								<canvas id="barChartStatus"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--END CHART-->
			
			<?php
			$sql = "SELECT * FROM tblservice WHERE User_ID='{$_SESSION['id']}'";
			$query = mysqli_query($connection, $sql);
			if(!$query)
			{}
			else if (mysqli_num_rows($query)==0)
			{}
			else
			{
			?>
			<!-- ASSIGNED TO ME TABLE-->
			<div class="container-fluid">
				<div class="table-data__tool">
					<strong style="color: white;padding-left: 25px; padding-top: 5px;">JOBS ASSIGNED TO ME</strong>
					<a href="job.php">
						<button class="au-btn au-btn-icon au-btn--green au-btn--small">
							<i class="zmdi zmdi-plus"></i>NEW JOB
						</button>
					</a>
				</div>
				<div class="table-responsive table-responsive-data2">
					<table class="table table-data2">
						<thead>
							<tr>
								<th>Form ID</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Type</th>
								<th>Title</th>
								<th>Date</th>
								<th>Status</th>
								<th></th>
							</tr>
							<tr class="spacer"></tr>
						</thead>
						<tbody>
							<?php
							while($rowService = mysqli_fetch_array($query)) 
							{
								$service_id = $rowService['Service_ID'];
								$service_title = $rowService['Service_Title'];
								$service_date = $rowService['Service_Date'];
								$service_type = $rowService['Service_Type'];
								$service_status = $rowService['Service_Status'];
								$cust_id = $rowService['Cust_ID'];
								
								$sqlCust = "SELECT * from tblCustomer WHERE Cust_ID = '{$cust_id}'";
								$queryCust = mysqli_query($connection, $sqlCust);
								while($rowCust = mysqli_fetch_array($queryCust))
								{
									$cust_name = $rowCust['Cust_Name'];
									$cust_phone = $rowCust['Cust_Phone'];
									$cust_email = $rowCust['Cust_Email'];
								}								
							?>
								<tr class="tr-shadow">
									<td>SV<?php echo $service_id ?></td>
									<td class="desc"><?php echo $cust_name ?></td>
									<td><span class="badge-info" style="padding:5px;"><?php echo $cust_phone ?></span></td>
									<td><?php echo $service_type ?></td>
									<td class="desc"><?php echo $service_title ?></td>
									<td><?php echo $service_date ?></td>
									<td>
										<span class="status--<?php if($service_status=='Pending'){echo 'denied';}else if($service_status=='Open'){echo 'process';} ?>"><?php echo $service_status ?></span>
									</td>
									<td>
										<div class="table-data-feature">
											<?php
												if($_SESSION['role'] == 'Admin')
												{
													echo '<button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
														<a href="edit_job.php?job_id='.$service_id.'"><i class="zmdi zmdi-edit"></i></a>
													</button>';
												}
											?>
											<button class="item" data-toggle="tooltip" data-placement="top" title="View">
												<a href="view_eform.php?job_id=<?php echo $service_id ?>"><i class="zmdi zmdi-view-web"></i></a>
											</button>
										</div>
									</td>
								</tr>
								<tr class="spacer"></tr>
							<?php
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END ASSIGNED TABLE-->
			<?php
			}
			?>
			
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
    <!-- Main JS-->
    <script src="js/main.js"></script>
	<?php
		//popup notification
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
		
		
		//data for chartJS
		$currentYear = date("Y");
		
		$total = mysqli_query($connection, "SELECT COUNT(*) AS January FROM tblservice WHERE monthname(Service_Date)='January' AND YEAR(Service_Date)='{$currentYear}'");
		if($total)
		{
			$row = mysqli_fetch_array($total);
			$January = $row['January'];
		}
		else
		{
			$January = "";
		}
		
		$total = mysqli_query($connection, "SELECT COUNT(*) AS February FROM tblservice WHERE monthname(Service_Date)='February' AND YEAR(Service_Date)='{$currentYear}'");
		if($total)
		{
			$row = mysqli_fetch_array($total);
			$February = $row['February'];
		}
		else
		{
			$February = "";
		}
		
		$total = mysqli_query($connection, "SELECT COUNT(*) AS March FROM tblservice WHERE monthname(Service_Date)='March' AND YEAR(Service_Date)='{$currentYear}'");
		if($total)
		{
			$row = mysqli_fetch_array($total);
			$March = $row['March'];
		}
		else
		{
			$March = "";
		}
		
		$total = mysqli_query($connection, "SELECT COUNT(*) AS April FROM tblservice WHERE monthname(Service_Date)='April' AND YEAR(Service_Date)='{$currentYear}'");
		if($total)
		{
			$row = mysqli_fetch_array($total);
			$April = $row['April'];
		}
		else
		{
			$April = "";
		}
		
		$total = mysqli_query($connection, "SELECT COUNT(*) AS May FROM tblservice WHERE monthname(Service_Date)='May' AND YEAR(Service_Date)='{$currentYear}'");
		if($total)
		{
			$row = mysqli_fetch_array($total);
			$May = $row['May'];
		}
		else
		{
			$May = "";
		}
		
		$total = mysqli_query($connection, "SELECT COUNT(*) AS June FROM tblservice WHERE monthname(Service_Date)='June' AND YEAR(Service_Date)='{$currentYear}'");
		if($total)
		{
			$row = mysqli_fetch_array($total);
			$June = $row['June'];
		}
		else
		{
			$June = "";
		}
		
		$total = mysqli_query($connection, "SELECT COUNT(*) AS July FROM tblservice WHERE monthname(Service_Date)='July' AND YEAR(Service_Date)='{$currentYear}'");
		if($total)
		{
			$row = mysqli_fetch_array($total);
			$July = $row['July'];
		}
		else
		{
			$July = "";
		}
		
		$total = mysqli_query($connection, "SELECT COUNT(*) AS August FROM tblservice WHERE monthname(Service_Date)='August' AND YEAR(Service_Date)='{$currentYear}'");
		if($total)
		{
			$row = mysqli_fetch_array($total);
			$August = $row['August'];
		}
		else
		{
			$August = "";
		}
		
		$total = mysqli_query($connection, "SELECT COUNT(*) AS September FROM tblservice WHERE monthname(Service_Date)='September' AND YEAR(Service_Date)='{$currentYear}'");
		if($total)
		{
			$row = mysqli_fetch_array($total);
			$September = $row['September'];
		}
		else
		{
			$September = "";
		}
		
		$total = mysqli_query($connection, "SELECT COUNT(*) AS October FROM tblservice WHERE monthname(Service_Date)='October' AND YEAR(Service_Date)='{$currentYear}'");
		if($total)
		{
			$row = mysqli_fetch_array($total);
			$October = $row['October'];
		}
		else
		{
			$October = "";
		}
		
		$total = mysqli_query($connection, "SELECT COUNT(*) AS November FROM tblservice WHERE monthname(Service_Date)='November' AND YEAR(Service_Date)='{$currentYear}'");
		if($total)
		{
			$row = mysqli_fetch_array($total);
			$November = $row['November'];
		}
		else
		{
			$November = "";
		}
		
		$total = mysqli_query($connection, "SELECT COUNT(*) AS December FROM tblservice WHERE monthname(Service_Date)='December' AND YEAR(Service_Date)='{$currentYear}'");
		if($total)
		{
			$row = mysqli_fetch_array($total);
			$December = $row['December'];
		}
		else
		{
			$December = "";
		}
		
		$total = mysqli_query($connection, "SELECT * FROM tbluser ORDER BY `User_Assigned` DESC LIMIT 5");
		$topTech = []; $y = 0;
		while($row = mysqli_fetch_array($total))
		{
			$topTech[$y] = $row['User_Name'];
			$topTechAssign[$y] = $row['User_Assigned'];
			$y++;
		}
		
		$total = mysqli_query($connection, "SELECT COUNT(*) AS Active FROM tblUser WHERE User_Is_Active='Yes'");
		$row = mysqli_fetch_array($total);
		$Active = $row['Active'];
		
		$total = mysqli_query($connection, "SELECT COUNT(*) AS Inactive FROM tblUser WHERE User_Is_Active='No'");
		$row = mysqli_fetch_array($total);
		$Inactive = $row['Inactive'];
	?>
	<script>
	
	//bar chart
	var ctx = document.getElementById("barChartType");
    if (ctx) {
      var myChart = new Chart(ctx, {
        type: 'bar',
        defaultFontFamily: 'Poppins',
        data: {
          labels: ["Installation", "Service Call", "Cable Work", "Contract", "Survey"],
          datasets: [
            {
              label: "Jobs",
              data: <?php echo '['.$numInstall.', '.$numService.', '.$numCable.', '.$numContract.', '.$numSurvey.']'; ?>,
              borderColor: "rgba(0, 123, 255, 0.9)",
              borderWidth: "0",
              backgroundColor: "rgba(0, 123, 220, 0.5)",
              fontFamily: "Poppins"
            },
          ]
        },
        options: {
          legend: {
            position: 'top',
            labels: {
              fontFamily: 'Poppins'
            }

          },
          scales: {
            xAxes: [{
              ticks: {
                fontFamily: "Poppins"

              }
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true,
                fontFamily: "Poppins"
              }
            }]
          }
        }
      });
    }
	
	//single line chart
	var ctx = document.getElementById("lineChartJob");
    if (ctx) {
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Jan", "Feb", "Mac", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"],
          defaultFontFamily: "Poppins",
          datasets: [
            {
              label: <?php echo '"'.$currentYear.'"'; ?>,
              borderColor: "rgba(255, 170, 21, 0.9)",
              borderWidth: "1",
              backgroundColor: "rgba(220, 170, 21, 0.5)",
              pointHighlightStroke: "rgba(26,179,148,1)",
              data: <?php echo '['.$January.', '.$February.', '.$March.', '.$April.', '.$May.', '.$June.', '.$July.', '.$August.', '.$September.', '.$October.', '.$November.', '.$December.']'; ?>,
            },
          ]
        },
        options: {
          legend: {
            position: 'top',
            labels: {
              fontFamily: 'Poppins'
            }

          },
          responsive: true,
          tooltips: {
            mode: 'index',
            intersect: false
          },
          hover: {
            mode: 'nearest',
            intersect: true
          },
          scales: {
            xAxes: [{
              ticks: {
                fontFamily: "Poppins"

              }
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true,
                fontFamily: "Poppins"
              }
            }]
          }

        }
      });
    }
	
	//doughut chart
    var ctx = document.getElementById("doughutChartTech");
    if (ctx) {
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          datasets: [{
            data: <?php echo '['.$topTechAssign[0].', '.$topTechAssign[1].', '.$topTechAssign[2].', '.$topTechAssign[3].', '.$topTechAssign[4].']'; ?>,
            backgroundColor: [
              "rgba(0, 200, 20,0.9)",
              "rgba(0, 200, 20,0.7)",
              "rgba(0, 200, 20,0.5)",
			  "rgba(0, 200, 20,0.3)",
              "rgba(0, 200, 20,0.1)",
            ],
            hoverBackgroundColor: [
              "rgba(50, 200, 123,0.9)",
              "rgba(50, 200, 123,0.7)",
              "rgba(50, 200, 123,0.5)",
			  "rgba(50, 200, 123,0.3)",
              "rgba(50, 200, 123,0.1)",
            ]

          }],
          labels: [
            <?php echo '"'.$topTech[0].'"'; ?>,
            <?php echo '"'.$topTech[1].'"'; ?>,
			<?php echo '"'.$topTech[2].'"'; ?>,
			<?php echo '"'.$topTech[3].'"'; ?>,
			<?php echo '"'.$topTech[4].'"'; ?>,
          ]
        },
        options: {
          legend: {
            position: 'top',
            labels: {
              fontFamily: 'Poppins'
            }

          },
          responsive: true
        }
      });
    }
	
	//double bar chart
    var ctx = document.getElementById("barChartStatus");
    if (ctx) {
      var myChart = new Chart(ctx, {
        type: 'bar',
        defaultFontFamily: 'Poppins',
        data: {
          labels: ["Technicians"],
          datasets: [
            {
              label: "Active",
              data: [<?php echo $Active; ?>],
              borderColor: "rgba(255, 21, 21, 0.9)",
              borderWidth: "0",
              backgroundColor: "rgba(255, 21, 21, 0.5)",
              fontFamily: "Poppins"
            },
            {
              label: "Inactive",
              data: [<?php echo $Inactive; ?>],
              borderColor: "rgba(50,0,0,0.09)",
              borderWidth: "0",
              backgroundColor: "rgba(20,0,0,0.07)",
              fontFamily: "Poppins"
            }
          ]
        },
        options: {
          legend: {
            position: 'top',
            labels: {
              fontFamily: 'Poppins'
            }

          },
          scales: {
            xAxes: [{
              ticks: {
                fontFamily: "Poppins"

              }
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true,
                fontFamily: "Poppins"
              }
            }]
          }
        }
      });
    }
	</script>

</body>

</html>
<!-- end document-->

