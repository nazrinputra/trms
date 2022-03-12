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
	
	if(isset($_POST["btnChoose"])) 
	{
		$staff_no = $_SESSION['staff_no'];
		$avatar = $_POST['avatar'];
		
		$sql = "UPDATE tblUser SET 
		`User_Avatar`='".$avatar."'
		WHERE `User_Staff_No`='".$staff_no."'";
		
		// update db and set new session values
		$sqlQuery = mysqli_query($connection, $sql);
		$_SESSION['avatar'] = $avatar;
		$_SESSION['pic'] = 'pic';
		
		header("Location: account.php");
		
		if(!$sqlQuery)
		{
			die("MySQL query failed!" . mysqli_error($connection));
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
    <title>TRMS › Account › Choose Avatar</title>
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
                                        <li class="list-inline-item">Choose Avatar</li>
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
					$bio = "No biography has been added.";
				}
				$position = $_SESSION['position'];
				if($position == "")
				{
					$position = "Unknown Position";
				}
				$phone = $_SESSION['phone'];
				if($phone == "0")
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
					<form id="frmAvatar" action="" method="post">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-lg-6">
							<div class="about-avatar">
								<img src="<?php echo $_SESSION['avatar']; ?>" alt="<?php echo $_SESSION['name']; ?>">
							</div>
							<h3 style="text-align:center;">Current</h3>
						</div>
						<div class="col-lg-6">
							<div class="gallery">
							  <figure class="gallery__item gallery__item--1">
								<input type="radio" name="avatar" id="avatar01" value="images/icon/Avatars01.png">
								<label for="avatar01"><img src="images/icon/Avatars01-min.png" class="gallery__img" alt="Image 1"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--2">
								<input type="radio" name="avatar" id="avatar02" value="images/icon/Avatars02.png">
								<label for="avatar02"><img src="images/icon/Avatars02-min.png" class="gallery__img" alt="Image 2"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--3">
								<input type="radio" name="avatar" id="avatar03" value="images/icon/Avatars03.png">
								<label for="avatar03"><img src="images/icon/Avatars03-min.png" class="gallery__img" alt="Image 3"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--4">
								<input type="radio" name="avatar" id="avatar04" value="images/icon/Avatars04.png">
								<label for="avatar04"><img src="images/icon/Avatars04-min.png" class="gallery__img" alt="Image 4"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--5">
								<input type="radio" name="avatar" id="avatar05" value="images/icon/Avatars05.png">
								<label for="avatar05"><img src="images/icon/Avatars05-min.png" class="gallery__img" alt="Image 5"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--6">
								<input type="radio" name="avatar" id="avatar06" value="images/icon/Avatars06.png">
								<label for="avatar06"><img src="images/icon/Avatars06-min.png" class="gallery__img" alt="Image 6"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--7">
								<input type="radio" name="avatar" id="avatar07" value="images/icon/Avatars07.png">
								<label for="avatar07"><img src="images/icon/Avatars07-min.png" class="gallery__img" alt="Image 7"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--8">
								<input type="radio" name="avatar" id="avatar08" value="images/icon/Avatars08.png">
								<label for="avatar08"><img src="images/icon/Avatars08-min.png" class="gallery__img" alt="Image 8"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--9">
								<input type="radio" name="avatar" id="avatar09" value="images/icon/Avatars09.png">
								<label for="avatar09"><img src="images/icon/Avatars09-min.png" class="gallery__img" alt="Image 9"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--10">
								<input type="radio" name="avatar" id="avatar10" value="images/icon/Avatars10.png">
								<label for="avatar10"><img src="images/icon/Avatars10-min.png" class="gallery__img" alt="Image 10"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--11">
								<input type="radio" name="avatar" id="avatar11" value="images/icon/Avatars11.png">
								<label for="avatar11"><img src="images/icon/Avatars11-min.png" class="gallery__img" alt="Image 11"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--12">
								<input type="radio" name="avatar" id="avatar12" value="images/icon/Avatars12.png">
								<label for="avatar12"><img src="images/icon/Avatars12-min.png" class="gallery__img" alt="Image 12"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--13">
								<input type="radio" name="avatar" id="avatar13" value="images/icon/Avatars13.png">
								<label for="avatar13"><img src="images/icon/Avatars13-min.png" class="gallery__img" alt="Image 13"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--14">
								<input type="radio" name="avatar" id="avatar14" value="images/icon/Avatars14.png">
								<label for="avatar14"><img src="images/icon/Avatars14-min.png" class="gallery__img" alt="Image 14"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--15">
								<input type="radio" name="avatar" id="avatar15" value="images/icon/Avatars15.png">
								<label for="avatar15"><img src="images/icon/Avatars15-min.png" class="gallery__img" alt="Image 15"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--16">
								<input type="radio" name="avatar" id="avatar16" value="images/icon/Avatars16.png">
								<label for="avatar16"><img src="images/icon/Avatars16-min.png" class="gallery__img" alt="Image 16"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--17">
								<input type="radio" name="avatar" id="avatar17" value="images/icon/Avatars17.png">
								<label for="avatar17"><img src="images/icon/Avatars17-min.png" class="gallery__img" alt="Image 17"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--18">
								<input type="radio" name="avatar" id="avatar18" value="images/icon/Avatars18.png">
								<label for="avatar18"><img src="images/icon/Avatars18-min.png" class="gallery__img" alt="Image 18"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--19">
								<input type="radio" name="avatar" id="avatar19" value="images/icon/Avatars19.png">
								<label for="avatar19"><img src="images/icon/Avatars19-min.png" class="gallery__img" alt="Image 19"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--20">
								<input type="radio" name="avatar" id="avatar20" value="images/icon/Avatars20.png">
								<label for="avatar20"><img src="images/icon/Avatars20-min.png" class="gallery__img" alt="Image 20"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--21">
								<input type="radio" name="avatar" id="avatar21" value="images/icon/Avatars21.png">
								<label for="avatar21"><img src="images/icon/Avatars21-min.png" class="gallery__img" alt="Image 21"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--22">
								<input type="radio" name="avatar" id="avatar22" value="images/icon/Avatars22.png">
								<label for="avatar22"><img src="images/icon/Avatars22-min.png" class="gallery__img" alt="Image 22"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--23">
								<input type="radio" name="avatar" id="avatar23" value="images/icon/Avatars23.png">
								<label for="avatar23"><img src="images/icon/Avatars23-min.png" class="gallery__img" alt="Image 23"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--24">
								<input type="radio" name="avatar" id="avatar24" value="images/icon/Avatars24.png">
								<label for="avatar24"><img src="images/icon/Avatars24-min.png" class="gallery__img" alt="Image 24"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--25">
								<input type="radio" name="avatar" id="avatar25" value="images/icon/Avatars25.png">
								<label for="avatar25"><img src="images/icon/Avatars25-min.png" class="gallery__img" alt="Image 25"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--26">
								<input type="radio" name="avatar" id="avatar26" value="images/icon/Avatars26.png">
								<label for="avatar26"><img src="images/icon/Avatars26-min.png" class="gallery__img" alt="Image 26"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--27">
								<input type="radio" name="avatar" id="avatar27" value="images/icon/Avatars27.png">
								<label for="avatar27"><img src="images/icon/Avatars27-min.png" class="gallery__img" alt="Image 27"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--28">
								<input type="radio" name="avatar" id="avatar28" value="images/icon/Avatars28.png">
								<label for="avatar28"><img src="images/icon/Avatars28-min.png" class="gallery__img" alt="Image 28"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--29">
								<input type="radio" name="avatar" id="avatar29" value="images/icon/Avatars29.png">
								<label for="avatar29"><img src="images/icon/Avatars29-min.png" class="gallery__img" alt="Image 29"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--30">
								<input type="radio" name="avatar" id="avatar30" value="images/icon/Avatars30.png">
								<label for="avatar30"><img src="images/icon/Avatars30-min.png" class="gallery__img" alt="Image 30"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--31">
								<input type="radio" name="avatar" id="avatar31" value="images/icon/Avatars31.png">
								<label for="avatar31"><img src="images/icon/Avatars31-min.png" class="gallery__img" alt="Image 31"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--32">
								<input type="radio" name="avatar" id="avatar32" value="images/icon/Avatars32.png">
								<label for="avatar32"><img src="images/icon/Avatars32-min.png" class="gallery__img" alt="Image 32"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--33">
								<input type="radio" name="avatar" id="avatar33" value="images/icon/Avatars33.png">
								<label for="avatar33"><img src="images/icon/Avatars33-min.png" class="gallery__img" alt="Image 33"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--34">
								<input type="radio" name="avatar" id="avatar34" value="images/icon/Avatars34.png">
								<label for="avatar34"><img src="images/icon/Avatars34-min.png" class="gallery__img" alt="Image 34"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--35">
								<input type="radio" name="avatar" id="avatar35" value="images/icon/Avatars35.png">
								<label for="avatar35"><img src="images/icon/Avatars35-min.png" class="gallery__img" alt="Image 35"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--36">
								<input type="radio" name="avatar" id="avatar36" value="images/icon/Avatars36.png">
								<label for="avatar36"><img src="images/icon/Avatars36-min.png" class="gallery__img" alt="Image 36"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--37">
								<input type="radio" name="avatar" id="avatar37" value="images/icon/Avatars37.png">
								<label for="avatar37"><img src="images/icon/Avatars13-min.png" class="gallery__img" alt="Image 37"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--38">
								<input type="radio" name="avatar" id="avatar38" value="images/icon/Avatars38.png">
								<label for="avatar38"><img src="images/icon/Avatars38-min.png" class="gallery__img" alt="Image 38"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--39">
								<input type="radio" name="avatar" id="avatar39" value="images/icon/Avatars39.png">
								<label for="avatar39"><img src="images/icon/Avatars39-min.png" class="gallery__img" alt="Image 39"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--40">
								<input type="radio" name="avatar" id="avatar40" value="images/icon/Avatars40.png">
								<label for="avatar40"><img src="images/icon/Avatars40-min.png" class="gallery__img" alt="Image 40"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--41">
								<input type="radio" name="avatar" id="avatar41" value="images/icon/Avatars41.png">
								<label for="avatar41"><img src="images/icon/Avatars41-min.png" class="gallery__img" alt="Image 41"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--42">
								<input type="radio" name="avatar" id="avatar42" value="images/icon/Avatars42.png">
								<label for="avatar42"><img src="images/icon/Avatars42-min.png" class="gallery__img" alt="Image 42"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--43">
								<input type="radio" name="avatar" id="avatar43" value="images/icon/Avatars43.png">
								<label for="avatar43"><img src="images/icon/Avatars43-min.png" class="gallery__img" alt="Image 43"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--44">
								<input type="radio" name="avatar" id="avatar44" value="images/icon/Avatars44.png">
								<label for="avatar44"><img src="images/icon/Avatars44-min.png" class="gallery__img" alt="Image 44"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--45">
								<input type="radio" name="avatar" id="avatar45" value="images/icon/Avatars45.png">
								<label for="avatar45"><img src="images/icon/Avatars45-min.png" class="gallery__img" alt="Image 45"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--46">
								<input type="radio" name="avatar" id="avatar46" value="images/icon/Avatars46.png">
								<label for="avatar46"><img src="images/icon/Avatars46-min.png" class="gallery__img" alt="Image 46"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--47">
								<input type="radio" name="avatar" id="avatar47" value="images/icon/Avatars47.png">
								<label for="avatar47"><img src="images/icon/Avatars47-min.png" class="gallery__img" alt="Image 47"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--48">
								<input type="radio" name="avatar" id="avatar48" value="images/icon/Avatars48.png">
								<label for="avatar48"><img src="images/icon/Avatars48-min.png" class="gallery__img" alt="Image 48"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--49">
								<input type="radio" name="avatar" id="avatar49" value="images/icon/Avatars49.png">
								<label for="avatar49"><img src="images/icon/Avatars49-min.png" class="gallery__img" alt="Image 49"></label>
							  </figure>
							  <figure class="gallery__item gallery__item--50">
								<input type="radio" name="avatar" id="avatar50" value="images/icon/Avatars50.png">
								<label for="avatar50"><img src="images/icon/Avatars50-min.png" class="gallery__img" alt="Image 50"></label>
							  </figure>
							</div>
						</div>
					</div>
					
					<div style="display: flex;content: center; padding-top:30px;">
						<button class="au-btn au-btn--blue" type="submit" name="btnChoose" id="btnChoose" style="display: inline-block; margin: auto;text-align: center;">CHANGE AVATAR</button>
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
    <!-- Main JS-->
    <script src="js/main.js"></script>
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

