<?php
	//Connection to Database
    $con = @mysqli_connect("localhost","root","","blog-sample");

    // Check connection
    if (mysqli_connect_errno()) {
        // echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die('Could not connect: ' . mysql_error());
    } else {
    }

    $per_page = 2;
    $pages_query = ("SELECT * FROM blog_post");
    $run_pages_query = mysqli_query($con, $pages_query);
    $data_count = mysqli_num_rows($run_pages_query);
    $pages = ceil($data_count / $per_page);


	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$start = ($page - 1) * $per_page;
	$query = "SELECT post_title, post_excerpt FROM blog_post LIMIT $start, $per_page";
	$run_query = mysqli_query($con, $query);

	while($row = mysqli_fetch_array($run_query)) {
        echo $row['post_title']. '<br />';
    	echo $row['post_excerpt']. '<br />'.'<br />';
	}

    $prev = $page - 1;
    $next = $page + 1;

    //Prev Pagination
    if (!($page <= 1)){
        echo "<a href='samplepagination.php?page=$prev'>Prev</a> ";
    }

    //Number Pagination
    if($pages >= 1){
        for($x=1; $x<=$pages; $x++){
            //echo '<a href="?page='.$x.'">'.$x.'</a> ';
            echo ($x == $page) ? '<b><a href="?page='.$x.'">'.$x.'</a></b> ':'<a href="?page='.$x.'">'.$x.'</a> ';
        }
    }

    //Next Pagination
    if (!($page >= $pages)){
        echo "<a href='samplepagination.php?page=$next'>Next</a> ";
    }
?>