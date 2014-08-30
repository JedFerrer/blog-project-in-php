<!-- Header -->
<?php 
  // session_start(); 
  // $_SESSION['activepage'] = 'sign-up';
?>
<?php include_once('partials\header.php'); ?>

        <?php

            // //Connection to Database
            // $con = @mysqli_connect("localhost","root","","blog-sample");

            // // Check connection
            // if (mysqli_connect_errno()) {
            //     // echo "Failed to connect to MySQL: " . mysqli_connect_error();
            //     die('Could not connect: ' . mysql_error());
            // } else {
            //     // echo "Successfully connected MySQL database...";
            //     // echo "<br />";
            // }
            
            //Reset Vars
            $nameErr = $emailErr = $emailErr2 = $passwordErr = $successful = $nameValue = $emailValue = '';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

              if (empty($_POST["name"])) {
                $nameErr = 'Name is required';
              } else {
                $name = mysql_real_escape_string($_POST["name"]);
                $nameValue = $name;
              }

              if (empty($_POST["email"])) {
                $emailErr = 'Email is required';
              } else {
                $emailAdd = mysql_real_escape_string($_POST["email"]);
                $emailValue = $emailAdd;
              }

              if (empty($_POST["pass"])) {
                $passwordErr = 'Password is required';
              }


              if ($nameErr != '' or $emailErr != '' or $passwordErr !='') {
                // echo $nameErr . '</br>' . $emailErr . '</br>' . $passwordErr;
              } else {
                             
                $password = mysql_real_escape_string($_POST["pass"]);
                $rpassword = mysql_real_escape_string($_POST["rpass"]);
               
                if ($password != $rpassword) {
                    $passwordErr = "Password and confirmation password doesn't match";
                    // echo $passwordErr;
                }

                if (!filter_var($emailAdd, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid Email";
                    //echo $passwordErr;
                }
                
                if ($emailErr != '' or $passwordErr !='') {
                    // echo $emailErr . '</br>' . $passwordErr;
                } else {

                    $data_exists = 0;
                    $exists_query = "SELECT * FROM blog_users WHERE user_email = '$emailAdd'";
                    $run_exists_query = mysqli_query($con, $exists_query);
                    $data_exists = mysqli_num_rows($run_exists_query);

                    if ($data_exists >= 1) {
                        $emailErr2 = "The email is already used";    
                    } else {

                        $password = md5($password);
                        $sql="INSERT INTO blog_users (author_name, user_email, user_Pass)VALUES ('$name', '$emailAdd', '$password')";

                        if (!mysqli_query($con,$sql)) {
                          die('Error: ' . mysqli_error($con));
                        }
                        $successful = 'Account registration successful. You may now Sign in.';
                        //reset
                        $nameValue = $emailValue = '';
                        header("location:login.php");
                        mysqli_close($con);
                    }
                }


              }
            }
        ?>

        <div class="content-container">
            <div class="main-content-centered">
                <div class="form-fit-container">

                    <form method="post" role="form" action="">
                         <?php if ($emailErr2 != ''){ ?>
                             <div class="alert alert-danger" role="alert">
                                <?php echo $emailErr2; ?>
                             </div>
                         <?php } elseif ($successful != ''){  ?>
                             <div class="alert alert-success" role="alert">
                                <?php echo $successful; ?>
                             </div>
                         <?php }?>

                          

                         <div class="form-header-top-container">
                            <h2><strong>Sign Up</strong></h2>
                         </div>

                         <?php if($nameErr != '' or $emailErr != '' or $passwordErr != ''){ ?>
                         <div class="bg-danger validation-errors">
                            <p>The following errors are encountered</p>
                            <ul>
                                <?php if($nameErr != ''){ ?>
                                    <li> <?php echo $nameErr; ?> </li>
                                <?php } ?> 
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
                            <label for="yourName">Name<span class="required">*</span>:</label>
                            <input type="text" name="name" class="form-control" id="yourName" value="<?php echo $nameValue; ?>" placeholder="Enter your Name" maxlength="50" required>
                         </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">Email address<span class="required">*</span>:</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="<?php echo $emailValue; ?>" placeholder="Enter your Email" maxlength="50" required>
                         </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Password<span class="required">*</span>:</label>
                            <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password" maxlength="50" required>
                         </div>
                          <div class="form-group">
                            <label for="repeatPassword">Re-enter Password<span class="required">*</span>:</label>
                            <input type="password" name="rpass" class="form-control" id="repeatPassword" placeholder="Repeat Password" maxlength="50" required>
                         </div>
                         
                         <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                    </form>

                </div>
            </div>
        </div>  

  <!-- footer -->
<?php include_once('partials\footer.php'); ?>