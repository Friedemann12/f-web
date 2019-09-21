<?php include "includes/admin-header.php"; ?>
<?php

$query_posts = "SELECT COUNT(*) FROM posts ";
$query_comments = "SELECT COUNT(*) FROM comments ";
$query_users = "SELECT COUNT(*) FROM users ";
$query_cats = "SELECT COUNT(*) FROM categories ";
$query_a_comments = "SELECT COUNT(*) FROM comments WHERE comment_status = 'approved'  ";
$query_u_comments = "SELECT COUNT(*) FROM comments WHERE comment_status = 'unapproved'  ";
$query_a_users = "SELECT COUNT(*) FROM users WHERE user_role = 'admin' ";
$query_u_users = "SELECT COUNT(*) FROM users WHERE user_role = 'user' ";
$query_t_users = "SELECT COUNT(*) FROM users WHERE user_role = 'test_admin' ";

$posts_count = mysqli_query($con, $query_posts);
$comments_count = mysqli_query($con, $query_comments);
$users_count = mysqli_query($con, $query_users);
$cats_count = mysqli_query($con, $query_cats);
$a_comments_count = mysqli_query($con, $query_a_comments);
$u_comments_count = mysqli_query($con, $query_u_comments);
$a_user_count = mysqli_query($con, $query_a_users);
$u_user_count = mysqli_query($con, $query_u_users);
$t_user_count = mysqli_query($con, $query_t_users);

$posts_row = mysqli_fetch_assoc($posts_count);
$comments_row = mysqli_fetch_assoc($comments_count);
$users_row = mysqli_fetch_assoc($users_count);
$cats_row = mysqli_fetch_assoc($cats_count);
$a_com_row = mysqli_fetch_assoc($a_comments_count);
$u_com_row = mysqli_fetch_assoc($u_comments_count);
$a_user_row = mysqli_fetch_assoc($a_user_count);
$u_user_row = mysqli_fetch_assoc($u_user_count);
$t_user_row = mysqli_fetch_assoc($t_user_count);


?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin-navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to the ADMIN PAGE
                        <small> <?php echo "Greetings {$_SESSION['username']}"; ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->


            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $posts_row["COUNT(*)"] ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $comments_row["COUNT(*)"] ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $users_row["COUNT(*)"] ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $cats_row["COUNT(*)"] ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div align="center">

                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Counter', 'number of entities'],
                            ['Posts', <?php echo $posts_row["COUNT(*)"] ?>],
                            ['Comments', <?php echo $comments_row["COUNT(*)"] ?>],
                            ['Published Coms.', <?php echo $a_com_row["COUNT(*)"] ?>],
                            ['Unpublished Coms.', <?php echo $u_com_row["COUNT(*)"] ?>],
                            ['All Users', <?php echo $users_row["COUNT(*)"] ?>],
                            ['Admin Users', <?php echo $a_user_row["COUNT(*)"] ?>],
                            ['Simple Users', <?php echo $u_user_row["COUNT(*)"] ?>],
                            ['Categories', <?php echo $cats_row["COUNT(*)"] ?>]
                        ]);

                        var options = {
                            chart: {
                                title: 'How\'s the Website going?',
                                subtitle: 'Nice Chaaaart!',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: 1100px; height: 550px;"></div>


            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes/admin-footer.php"; ?>