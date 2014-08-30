<?php session_start(); include_once('db-connection.php'); ?>
<?php
	//Reset Vars
	$titleErr = $messageErr = $titleValue = $contentValue = '';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST["title"])) {
	        $titleErr = 'Title is required';
		} else {
			$title = ($_POST["title"]);
			$title = mysql_real_escape_string($title);
			$titleValue = $title;
			unset($_SESSION['title_Err_Add']);
		}

		if (empty($_POST["message"])) {
			$messageErr = 'Post Content is required';
		} else {
			$message = ($_POST["message"]);
			$message = mysql_real_escape_string($message);
			$contentValue = $message;
			unset($_SESSION['message_Err_Add']);
		}

		if ($titleErr != '' or $messageErr != '') {
			$_SESSION['title_Err_Add'] = $titleErr;
			$_SESSION['message_Err_Add'] = $messageErr;

			$_SESSION['post_title_add'] = $titleValue;
			$_SESSION['post_content_add'] = $contentValue;
			header("location:blog-home.php");
		} else {
			$author_id = $_SESSION['author_id'];
			$excerpt = implode(' ', array_slice(explode(' ', $message), 0, 50));
			$dateToday = date("Y-m-d");
			$sql="INSERT INTO blog_post (post_date, post_title, post_content, post_excerpt, author_id)VALUES ('$dateToday', '$title', '$message', '$excerpt', '$author_id')";
			if (!mysqli_query($con,$sql)) {
              die('Error: ' . mysqli_error($con));
            }

            //
           

            header("location:blog-home.php");
            mysqli_close($con);
		}

	}
?>