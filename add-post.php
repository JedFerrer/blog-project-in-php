<?php session_start(); include_once('db-connection.php'); ?>
<?php
	//Reset Vars
	$titleErr = $messageErr = $titleValue = $messageValue = '';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["title"])) {
	        $titleErr = 'Name is required';
		} else {
			$title = ($_POST["title"]);
			$title = mysql_real_escape_string($title);
			$titleValue = $title;
		}

		if (empty($_POST["message"])) {
			$messageErr = 'Email is required';
		} else {
			$message = ($_POST["message"]);
			$message = mysql_real_escape_string($message);
			$messageValue = $message;
		}

		if ($titleErr != '' or $messageErr != '') {
			//
		} else {
			$author_id = $_SESSION['author_id'];
			$excerpt = implode(' ', array_slice(explode(' ', $message), 0, 50));
			$dateToday = date("Y-m-d");
			$sql="INSERT INTO blog_post (post_date, post_title, post_content, post_excerpt, author_id)VALUES ('$dateToday', '$title', '$message', '$excerpt', '$author_id')";
			if (!mysqli_query($con,$sql)) {
              die('Error: ' . mysqli_error($con));
            }

            $successful = 'Your Post has been Added';
            //reset
            $titleValue = $messageValue = '';
            header("location:blog-home.php");
            mysqli_close($con);
		}

	}
?>