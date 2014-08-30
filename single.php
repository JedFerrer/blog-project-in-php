<!-- Header -->
<?php include_once('partials\header.php'); ?>

        <div class="content-container">
            <div class="main-content-centered">
              
                <div class="blog-container">
                    <div>
                    
                        <div class="textbox-wrapper">
                            

                            <?php 

                            if(isset($_GET['id'])){
                                $id=$_GET['id'];

                                //if(isset($_SESSION['myemail'])) {
                                    //$author_id = $_SESSION['author_id'];
                                    $sql = "SELECT * FROM blog_post WHERE id = '$id'";
                                    $run_sql_query = mysqli_query($con, $sql);
                            
                                //} else {
                                    // $sql = "SELECT * FROM blog_post ORDER BY id DESC LIMIT 10";
                                    // $run_sql_query = mysqli_query($con, $sql);
                                    
                               // }

                                while($query2 = mysqli_fetch_array($run_sql_query)) {
                            ?>

                            <div class="entries-container">
                                <?php echo '<a href="blog-home.php" class="sign-up">&larr; Back to Home</a>';?>
                                <div class="title-date-container">
                                    <h5><?php echo $query2['post_date']; ?></h5>
                                    <h2 class="singles-title"><?php echo $query2['post_title']; ?></h2>
                                </div>
                                <div class="post-content-container">
                                    <p class="singles-post-content"><?php echo $query2['post_content']; ?></p>
                                    <?php 
                                        if(isset($_SESSION['myemail'])) { 
                                            echo "<a href='edit-post.php?id=".$query2['id']."'>Edit</a> &nbsp;";
                                            echo "<a href='delete-post.php?id=".$query2['id']."'>Delete</a>";
                                        }
                                    ?>
                                </div>  
                               <!--  <h2 class="devider"></h2> -->
                            </div> 

                            <?php
                                }
                            }
                            ?>


                        </div>
                    </div>
                </div>  
            </div>
        </div>
        
        <!-- footer -->
        <?php include_once('partials\footer.php'); ?>

    </body>
</html>