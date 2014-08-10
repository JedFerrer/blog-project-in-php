<?php session_start(); include_once('db-connection.php'); ?>
<?php
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		 $sql = "DELETE FROM blog_post WHERE id = '$id'";
         $run_sql_query = mysqli_query($con, $sql);
		
		if($run_sql_query){
			echo 'boom';
			header('location:blog-home.php');
		}
	}
?>