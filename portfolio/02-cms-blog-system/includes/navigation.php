<?php session_start(); ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">The Blog</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php
                include "db.php";

                $query = "SELECT * FROM categories";
                $slct_cats = mysqli_query($con, $query);

                while ($row = mysqli_fetch_assoc($slct_cats)) {
                    $cat_id = $row["cat_id"];
                    $cat_title = $row["cat_title"];

                    echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";

                }


                ?>
            </ul>


            <ul class="nav navbar-nav navbar-right">
                <?php

                if (isset($_SESSION["username"]) && $_SESSION["user_role"] === "admin") {

                    echo '
                            <li>
                                <a href = "./logout.php">
                                <span class="glyphicon glyphicon-log-out"></span>
                                <span>Logout</span>
                                </a>
                            </li>
                            <li>
                    <a href = "admin/index.php" > Admin</a>
                </li>
                       
                ';
                } else if (isset($_SESSION["username"])) {

                    echo '
          
                
                                <li>
                                    <a href = "../includes/logout.php">
                                        <span class="glyphicon glyphicon-log-out"></span>
                                        <span>Logout</span>
                                    </a>                
                                </li>
                
                
            ';
                }

                if (isset($_GET['source'])) {
                    $source = $_GET['source'];
                } else {
                    $source = '';
                }

                if ($source == "logged-out") {

                    echo "    <span class=\"navbar-text navbar-right\">
                            You're Logged out, See You soon!
                          </span>";

                } else if ($source == "login-success") {

                    echo "    <span class=\"navbar-text navbar-right\">
                            Welcome Back, {$_SESSION["username"]}!
                          </span>";
                }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
