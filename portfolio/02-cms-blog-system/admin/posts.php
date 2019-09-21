<?php include "includes/admin-header.php"; ?>



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
                        <small>Post-Section</small>
                    </h1>

                    <div class="table-responsive">
                        <?php
                        if (isset($_GET["source"])) {
                            $source = $_GET["source"];
                        } else {
                            $source = "";
                        }

                        switch ($source) {
                            case 'create-post';
                                include "includes/add-post.php";
                                break;
                            case 'edit-post';
                                include "includes/edit-post.php";
                                break;
                            case 'success-posting';
                                echo "<h2>Post successfully created</h2>";
                                include "includes/view-all-posts.php";
                                break;
                            case 'success-deletion';
                                echo "<h2>Post successfully deleted</h2>";
                                include "includes/view-all-posts.php";
                                break;
                            case 'success-updating';
                                echo "<h2>Post successfully updated</h2>";
                                include "includes/view-all-posts.php";
                                break;
                            case 'success-resetting';
                                echo "<h2>View-count successfully resetted</h2>";
                                include "includes/view-all-posts.php";
                                break;
                            default:
                                include "includes/view-all-posts.php";
                                break;
                        }
                        ?>
                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes/admin-footer.php"; ?>