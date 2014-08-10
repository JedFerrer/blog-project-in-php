<!DOCTYPE html>
<?php session_start(); ?>
<html>
    <head>
        <title>JEDIDIAH Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
        <link href="js/bootstrap.min.js" rel="stylesheet" media="screen">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <!--[if IE]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Main Stylesheet File -->
        <link href="css/style.css" rel="stylesheet" media="screen">
    </head>

    <body>
        <!-- Connection -->
        <?php include_once('db-connection.php'); ?>


        <?php
            //if(isset($_SESSION["name"])) {
        

        ?>
        <div class="header-container">
            <div class="main-content-centered">
                
                <div class="logo-container">
                    <h1>Jedidiah L. Ferrer  <small>Web Developer</small></h1>
                </div>
                <div class="link-top-container">
                <?php if(isset($_SESSION['myemail'])) { ?>
                    <a href="logout.php" class="sign-up">Log Out</a>
                <?php }?>
                </div>
                <div class="clear"></div>

            </div>
        </div>

        <div class="content-container">
            <div class="main-content-centered">
              
                <div class="blog-container">
                    <div>
                        <?php 
                            // $sql = "SELECT * FROM blog_post WHERE user_email = '$emailAdd' and user_pass = '$password'";
                            // $run_sql_query = mysqli_query($con, $sql);
                        ?>
                        <div class="textbox-wrapper">
                            <form class="post-form" action="add-post.php" method="POST">
                                <div class="form-group">
                                    <p>Title</p>
                                    <input type="text" class="form-control" name="title" maxlength="50" placeholder="Title Input">
                                    <div class="clear"></div>
                                </div>
                              
                                <div class="form-group">
                                    <p>Post</p>
                                    <textarea class="form-control" name="message" rows="3" maxlenght="500" placeholder="Post Input"></textarea>
                                    <div class="clear"></div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Post</button>
                                </div>
                                                         
                            </form>

                            <?php 
                                if(isset($_SESSION['myemail'])) {
                                    $author_id = $_SESSION['author_id'];
                                    $sql = "SELECT * FROM blog_post WHERE author_id = '$author_id' ORDER BY id DESC LIMIT 10";
                                    $run_sql_query = mysqli_query($con, $sql);

                                } else {
                                    $sql = "SELECT * FROM blog_post ORDER BY id DESC LIMIT 10";
                                    $run_sql_query = mysqli_query($con, $sql);
                                    
                                }

                                while($query2 = mysqli_fetch_array($run_sql_query)) {
                            ?>

                            <div class="entries-container">
                                <div class="title-date-container">
                                    <h4><?php echo $query2['post_date']; ?></h4>
                                    <h4><?php echo $query2['post_title']; ?></h4>
                                </div>
                                <div class="post-content-container">
                                    <p><?php echo $query2['post_excerpt']; ?></p>
                                    <?php 
                                        if(isset($_SESSION['myemail'])) { 
                                            echo "<a href='edit-post.php?id=".$query2['id']."'>Edit</a> &nbsp;";
                                            echo "<a href='delete-post.php?id=".$query2['id']."'>Delete</a>";
                                        }
                                    ?>
                                </div>  
                            </div> 

                            <?php
                                }
                            ?>

                        <!--     <div class="entries-container">
                                <div class="title-date-container">
                                    <h4>01-01-2014</h4>
                                    <h4>Lorem Ipsum</h4>
                                </div>
                                <div class="post-content-container">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        
                                </div>  
                            </div> --> 

                        </div>
                    </div>
                </div>  
            </div>
        </div>
        
        <div class="footer-container">
            <div class="main-content-centered">
                <h6>&copy; 2014 Copyright JEDIDIAH Blog | Powered by Mayon Volcano Software Ltd.</h6>
            </div>
        </div>

    </body>
</html>