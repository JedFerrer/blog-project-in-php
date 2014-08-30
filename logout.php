<?php
	session_start();
    session_destroy();
 	// unset($_SESSION['myemail']);
	// unset($_SESSION['mypassword']);
	// unset($_SESSION['name']);
	// unset($_SESSION['author_id']);
    header("location:login.php");



						

?>