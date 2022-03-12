<?php

    // Database connection
    include('config/db.php');

    global $email_verified, $email_already_verified, $activation_error;

    // GET the token = ?token
    if(!empty($_GET['token'])){
       $token = $_GET['token'];
    } else {
        $token = "";
    }

    if($token != "") {
        $sqlQuery = mysqli_query($connection, "SELECT * FROM tblUser WHERE User_Token = '$token' ");
        $countRow = mysqli_num_rows($sqlQuery);

        if($countRow == 1){
            while($rowData = mysqli_fetch_array($sqlQuery)){
                $is_active = $rowData['User_Is_Active'];
                  if($is_active == 'No') {
                     $update = mysqli_query($connection, "UPDATE tblUser SET User_Is_Active = 'Yes' WHERE User_Token = '$token' ");
                       if($update){
                           $email_verified = '
							<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
								<span class="badge badge-pill badge-success">Success</span>
									Email verified! You may now login.
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
                           ';
                       }
                  } else {
                        $email_already_verified = '
							<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
								<span class="badge badge-pill badge-danger">Fail</span>
									Email already verified! Please login.
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
                        ';
                  }
            }
        } else {
            $activation_error = '
				<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
					<span class="badge badge-pill badge-danger">Error</span>
						Activation error! Please register again
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
            ';
        }
    }

?>