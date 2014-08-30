<!-- Header -->
<?php include_once('partials\header.php'); ?>
		<?php
			if(isset($_SESSION['myemail'])) {
				header("location:blog-home.php");
			}
		?>
<!-- 	<body> -->
		<?php
			// if(isset($_SESSION["name"])) {

			//include_once('db-connection.php');
			//reset Var
			$emailErr = $passwordErr = $emailValue = $loginErr = '';

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST["email"])) {
					$emailErr = 'Email is required';
				} else {
					$emailAdd = stripslashes($_POST["email"]);
					$emailAdd = mysql_real_escape_string($emailAdd);
					$emailValue = $emailAdd;
				}

				if (empty($_POST["pass"])) {
					$passwordErr = 'Password is required';
				}

				if ($emailErr != '' or $passwordErr !='') {
				} else {
					$password = stripslashes($_POST["pass"]);
					$password = mysql_real_escape_string($_POST["pass"]);
					$password = md5($password);


					$sql = "SELECT * FROM blog_users WHERE user_email = '$emailAdd' and user_pass = '$password'";
					$run_sql_query = mysqli_query($con, $sql);
					$name = $author_id = '';
					while($row = mysqli_fetch_array($run_sql_query)) {
					    $name = $row['author_name'];
					    $author_id = $row['id'];
					}

                    $data_exist = mysqli_num_rows($run_sql_query);

                    if($data_exist == 1) {
						$_SESSION['myemail'] = $emailAdd;
						$_SESSION['mypassword'] = $password;
						$_SESSION['name'] = $name;
						$_SESSION['author_id'] = $author_id;
						//redirect
						header("location:blog-home.php");
					} else {
						$loginErr = "Incorrect Email or Password";
					}
				}






			}


		?>
		<!-- <div class="header-container">
			<div class="main-content-centered">
				
				<div class="logo-container">
					<h2>Jedidiah Blog  <small>My Very First Project</small></h2>
				</div>
				<div class="link-top-container">
					<a href="sign-up.php" class="sign-up">Sign Up</a>
				</div>
				<div class="clear"></div>

			</div>
		</div> -->

		<div class="content-container">
			<div class="main-content-centered">
				<div class="form-container">

					<form method="post"  role="form" action="">
						<?php global $successful; ?>
						<?php if ($successful != ''){  ?>
                             <div class="alert alert-success" role="alert">
                                <?php echo $successful; ?>
                             </div>
                         <?php } ?>
                         <?php if ($loginErr != ''){  ?>
                             <div class="alert alert-danger" role="alert">
                                <?php echo $loginErr; ?>
                             </div>
                         <?php } ?>

						 <div class="form-header-top-container">
						 	<h2><strong>User Login</strong></h2>
						 </div>

						 <?php if($emailErr != '' or $passwordErr != ''){ ?>
	                         <div class="bg-danger validation-errors">
	                            <p>The following errors are encountered</p>
	                            <ul>
	                                <?php if($emailErr  != ''){ ?>
	                                    <li> <?php echo $emailErr; ?> </li>
	                                <?php } ?>
	                                <?php if($passwordErr != ''){ ?>
	                                    <li> <?php echo $passwordErr; ?> </li>
	                                <?php } ?>
	                            </ul>
	                         </div>
                         <?php } ?>

						 <div class="form-group">
						 	<label for="exampleInputEmail1">Email address</label>
						    	<input type="email" name="email" class="form-control" id="exampleInputEmail1" value="<?php echo $emailValue; ?>" placeholder="Enter your Email" required>
						 </div>
						 <div class="form-group">
						    <label for="exampleInputPassword1">Password</label>
						    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
						 </div>
						 <!-- <div class="form-group">
						 	<div class="alert alert-success alert-dismissible" role="alert">Example block-level help text here.</div>
						 </div> -->
						 <button type="submit" class="btn btn-primary btn-block">Sign In</button>
						 </br>
						 <?php echo '<a href="sign-up.php" class="sign-up">Sign Up</a>'; ?>
						 
					</form>
				</div>
 
			</div>
		</div>

	<!-- footer -->
<?php include_once('partials\footer.php'); ?>