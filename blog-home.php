<?php session_start(); ?>
<!DOCTYPE html>

<html>
    <head>
        <title>Blog Home</title>
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

        <?php
           
        ?>
        <div class="header-container">
            <div class="main-content-centered">
                
                <div class="logo-container">
                    <h2>Jedidiah Blog  <small>My Very First Project</small></h2>
                    <?php echo $_SESSION["name"]; ?>
                </div>
                <div class="link-top-container">
                    <a href="logout.php" class="sign-up">Log Out</a>
                </div>
                <div class="clear"></div>

            </div>
        </div>

        <div class="content-container">
            <div class="main-content-centered">
              
                <div class="blog-container">
                    <div>
                    <div class="entries-container">

                        <div class="title-date-container">
                            <h4></h4>
                            <h4></h4>
                        </div>
                        <div class="post-content-container">
                            <p></p>
                
                        </div>  
                
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