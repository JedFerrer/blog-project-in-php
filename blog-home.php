<!-- Header -->
<?php include_once('partials\header.php'); ?>

        <div class="content-container">
            <div class="main-content-centered">
              
                <div class="blog-container">
                    <div>
                    
                        <div class="textbox-wrapper">
                            <?php if(isset($_SESSION['myemail'])) { ?>
                             
                                <?php if((isset($_SESSION['title_Err_Add'])) or (isset($_SESSION['message_Err_Add']))) { ?>
                                    <div class="bg-danger validation-errors">
                                    <p>The following errors are encountered</p>
                                        <ul>
                                            <?php if ($_SESSION['title_Err_Add'] != ''){ ?>
                                                <li> <?php echo $_SESSION['title_Err_Add']; ?> </li>
                                            <?php } ?>
                                            <?php if ($_SESSION['message_Err_Add'] != ''){ ?>
                                                <li> <?php echo $_SESSION['message_Err_Add']; ?> </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } ?>

                                <?php if((isset($_SESSION['title_Err_Edit'])) or (isset($_SESSION['message_Err_Edit']))) { ?>
                                    <div class="bg-danger validation-errors">
                                    <p>The following errors are encountered</p>
                                        <ul>
                                            <?php if ($_SESSION['title_Err_Edit'] != ''){ ?>
                                                <li> <?php echo $_SESSION['title_Err_Edit']; ?> </li>
                                            <?php } ?>
                                            <?php if ($_SESSION['message_Err_Edit'] != ''){ ?>
                                                <li> <?php echo $_SESSION['message_Err_Edit']; ?> </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } ?>

                                <?php if(isset($_SESSION['edit_checker'])) { ?>

                                    <?php //unset($_SESSION['edit_checker']);?>
                                    <form class="post-form" action="edit-post.php" method="POST">
                                        <div class="form-group">
                                            <p>Title</p>
                                            <input type="text" class="form-control" name="title" maxlength="50" value="<?php echo $_SESSION['post_title']; ?>" placeholder="Title Input">
                                            <div class="clear"></div>
                                        </div>
                                      
                                        <div class="form-group">
                                            <p>Post</p>
                                            <textarea class="form-control" name="message" rows="3" maxlenght="500" placeholder="Post Content"><?php echo $_SESSION['post_content']; ?></textarea>
                                            <div class="clear"></div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-default">Update Post</button>
                                        </div>                        
                                    </form>

                                <?php } else { ?>
                                   

                                    <form class="post-form" action="add-post.php" method="POST">
                                        <div class="form-group">
                                            <p>Title</p>
                                            <input type="text" class="form-control" name="title" maxlength="50" value="<?php if(isset($_SESSION['post_title_add'])) { echo $_SESSION['post_title_add']; } ?>" placeholder="Title Input">
                                            <div class="clear"></div>
                                        </div>
                                      
                                        <div class="form-group">
                                            <p>Post</p>
                                            <textarea class="form-control" name="message" rows="3" maxlenght="500" placeholder="Post Input"><?php if(isset($_SESSION['post_title_add'])) { echo $_SESSION['post_content_add']; } ?></textarea>
                                            <div class="clear"></div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-default">Post</button>
                                        </div>                        
                                    </form>

                                <?php } ?>

                            <?php } ?>

                            <?php 

                            $per_page = 3;
                            if(isset($_SESSION['myemail'])) {
                                $author_id = $_SESSION['author_id'];
                                $pages_query = ("SELECT * FROM blog_post WHERE author_id = '$author_id'");
                            } else {
                                $pages_query = ("SELECT * FROM blog_post");
                            }
                            $run_pages_query = mysqli_query($con, $pages_query);
                            $data_count = mysqli_num_rows($run_pages_query);
                            $pages = ceil($data_count / $per_page);

                            $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                            $start = ($page - 1) * $per_page;
                            //$query = "SELECT post_title, post_excerpt FROM blog_post LIMIT $start, $per_page";
                            //$run_query = mysqli_query($con, $query);

                            // while($row = mysqli_fetch_array($run_query)) {
                            //     echo $row['post_title']. '<br />';
                            //     echo $row['post_excerpt']. '<br />'.'<br />';
                            // }

                                if(isset($_SESSION['myemail'])) {
                                    $author_id = $_SESSION['author_id'];
                                    //$sql = "SELECT * FROM blog_post WHERE author_id = '$author_id' ORDER BY id DESC LIMIT 10";
                                    $sql = "SELECT * FROM blog_post WHERE author_id = '$author_id' ORDER BY id DESC LIMIT $start, $per_page";
                                    $run_sql_query = mysqli_query($con, $sql);

                                } else {
                                    //$sql = "SELECT * FROM blog_post ORDER BY id DESC LIMIT 10";
                                    $sql = "SELECT * FROM blog_post ORDER BY id DESC LIMIT $start, $per_page";
                                    $run_sql_query = mysqli_query($con, $sql);
                                    
                                }

                                while($query2 = mysqli_fetch_array($run_sql_query)) {
                            ?>

                                    <div class="entries-container">
                                        <div class="title-date-container">
                                            <h5><?php echo $query2['post_date']; ?></h5>
                                            <h2><?php echo "<a href='single.php?id=".$query2['id']."'>".$query2['post_title']."</a> &nbsp;"; ?></h2>
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
                                        <h2 class="devider"></h2>
                                    </div> 

                            <?php } ?>

                            <?php
                                $prev = $page - 1;
                                $next = $page + 1;
                                echo '<ul class="pager">';
                                //Prev Pagination
                                if (!($page <= 1)){
                                    //echo "<a href='blog-home.php?page=$prev'>Prev</a> ";
                                    
                                      echo "<li class='previous'><a href='blog-home.php?page=$prev'>&larr; Older</a></li>";
                                    //echo '</ul>';
                                }

                                //Number Pagination
                                // if($pages >= 1){
                                //     for($x=1; $x<=$pages; $x++){
                                //         //echo '<a href="?page='.$x.'">'.$x.'</a> ';
                                //         echo ($x == $page) ? '<b><a href="?page='.$x.'">'.$x.'</a></b> ':'<a href="?page='.$x.'">'.$x.'</a> ';
                                //     }
                                // }

                                if($pages >= 1){
                                    for($x=1; $x<=$pages; $x++){
                                        //echo '<a href="?page='.$x.'">'.$x.'</a> ';
                                        //echo ($x == $page) ? '<b><a href="?page='.$x.'">'.$x.'</a></b> ':'<a href="?page='.$x.'">'.$x.'</a> ';
                                        if ($x == $page) {
                                            $active_page = $x;
                                        }
                                    }
                                }
                               

                                //Next Pagination
                                if (!($page >= $pages)){
                                    //echo "<a href='blog-home.php?page=$next'>Next</a> ";
                                   // echo '<ul class="pager">';
                                      echo "<li class='next'><a href='blog-home.php?page=$next'>Newer &rarr;</a></li>"; 
                                }
                                echo '</ul>';

                                echo  "<h1 class='page-number'>Page ".$active_page." of ".$pages."</h1>";
//<li class="previous"><a href="#">&larr; Older</a></li>
                                
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
        
        <!-- footer -->
        <?php include_once('partials\footer.php'); ?>

    </body>
</html>