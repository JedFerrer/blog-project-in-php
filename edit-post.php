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
			unset($_SESSION['title_Err_Edit']);
		}

		if (empty($_POST["message"])) {
			$messageErr = 'Post Content is required';
		} else {
			$message = ($_POST["message"]);
			$message = mysql_real_escape_string($message);
			$contentValue = $message;
			unset($_SESSION['message_Err_Edit']);
		}

		if ($titleErr != '' or $messageErr != '') {
			$_SESSION['title_Err_Edit'] = $titleErr;
			$_SESSION['message_Err_Edit'] = $messageErr;

			$_SESSION['post_title_Edit'] = $titleValue;
			$_SESSION['post_content_Edit'] = $contentValue;

			// echo $_SESSION['post_title'];
			// echo $_SESSION['post_content'];

			header("location:blog-home.php");
		} else {
			//$author_id = $_SESSION['author_id'];
			$excerpt = implode(' ', array_slice(explode(' ', $message), 0, 50));
			//$dateToday = date("Y-m-d");
			//$sql="INSERT INTO blog_post (post_date, post_title, post_content, post_excerpt, author_id)VALUES ('$dateToday', '$title', '$message', '$excerpt', '$author_id')";
			$post_id = $_SESSION['post_id'];
			$sql="UPDATE blog_post SET post_title='$title', post_content='$message', post_excerpt='$excerpt' WHERE id='$post_id'";
			if (!mysqli_query($con,$sql)) {
              die('Error: ' . mysqli_error($con));
            }

            //$successful = 'Your Post has been Added';
            //reset
            //$titleValue = $messageValue = '';
            unset($_SESSION['edit_checker']);
            
            header("location:blog-home.php");
            mysqli_close($con);
			//echo "update";
		}

	} else {
		unset($_SESSION['title_Err_Add']);
		unset($_SESSION['message_Err_Add']);

		unset($_SESSION['title_Err_Edit']);
		unset($_SESSION['message_Err_Edit']);
		
		if(isset($_GET['id'])){
			$id=$_GET['id'];
		    $sql = "SELECT * FROM blog_post WHERE id = '$id'";
            $run_sql_query = mysqli_query($con, $sql);
          	while($row = mysqli_fetch_array($run_sql_query)) {
           		$post_title = $row['post_title'];
				$post_content = $row['post_content'];
			}
		
			if($run_sql_query){
				$_SESSION['post_id'] = $id;
				$_SESSION['post_title'] = $post_title;
				$_SESSION['post_content'] = $post_content;
				$_SESSION['edit_checker'] = 'on';
				header('location:blog-home.php');
			}

		}

	}
?>