<?php
   
    // Database connection
    include('config/db.php');

    global $accountNotExistErr, $emailPwdErr, $verificationRequiredErr;

    if(isset($_POST['btnLogin'])) 
	{
        $staff_no_login = stripslashes($_POST['staff_no']);
        $password_login = stripslashes($_POST['password']);

        // clean data 
        $staff_no_login = mysqli_real_escape_string($connection,$staff_no_login);
        $password_login = mysqli_real_escape_string($connection,$password_login);

        // Query if staff exists in db
        $sql = "SELECT * From tblUser WHERE User_Staff_No = '{$staff_no_login}' ";
        $query = mysqli_query($connection, $sql);
        $rowCount = mysqli_num_rows($query);

        // If query fails, show the reason 
        if(!$query){
           die("SQL query failed: " . mysqli_error($connection));
        }
		
		if($rowCount <= 0) {
			$accountNotExistErr = '
				<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
					<span class="badge badge-pill badge-danger">Fail</span>
						Staff number does not exist!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				';
		}
		else 
		{
			// Fetch user data and store in php session
			while($row = mysqli_fetch_array($query)) {
				$id = $row['User_ID'];
				$name = $row['User_Name'];
				$email = $row['User_Email'];
				$staff_no = $row['User_Staff_No'];
				$position = $row['User_Position'];
				$password_db = $row['User_Password'];
				$gender = $row['User_Gender'];
				$phone = $row['User_Phone'];
				$address = $row['User_Address'];
				$avatar = $row['User_Avatar'];
				$bio = $row['User_Bio'];
				$role = $row['User_Role'];
				$token = $row['User_Token'];
				$is_active = $row['User_Is_Active'];
				$assigned = $row['User_Assigned'];
				$created = $row['User_Created'];
				$updated = $row['User_Updated'];
				$closed = $row['User_Closed'];
			}

			// Allow only verified user
			if($is_active == 'Yes') 
			{
				if(password_verify($password_login, $password_db)) 
				{
				   $_SESSION['id'] = $id;
				   $_SESSION['name'] = $name;
				   $_SESSION['email'] = $email;
				   $_SESSION['staff_no'] = $staff_no;
				   $_SESSION['position'] = $position;
				   $_SESSION['gender'] = $gender;
				   $_SESSION['phone'] = $phone;
				   $_SESSION['address'] = $address;
				   $_SESSION['avatar'] = $avatar;
				   $_SESSION['bio'] = $bio;
				   $_SESSION['role'] = $role;
				   $_SESSION['token'] = $token;
				   $_SESSION['assigned'] = $assigned;
				   $_SESSION['created'] = $created;
				   $_SESSION['updated'] = $updated;
				   $_SESSION['closed'] = $closed;
				   $_SESSION['success'] = 'success';
				   
				   header("Location: dashboard.php");
					
				} 
				else 
				{
					$emailPwdErr .= '
						<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
							<span class="badge badge-pill badge-danger">Error</span>
								Staff number or password incorrect.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
				}
			} 
			else 
			{
				$verificationRequiredErr = '
					<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
						<span class="badge badge-pill badge-danger">Error</span>
							Account verification is required for login.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
			}


		}        
	}

?>