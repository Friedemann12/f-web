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
                        <small>Comment-Section</small>
                    </h1>

                    <div class="table-responsive">
                        <?php
                        if (isset($_GET["source"])) {
                            $source = $_GET["source"];
                        } else {
                            $source = "";
                        }

                        switch ($source) {
                            case 'success-approving';
                                echo "<h2>Comment successfully approved</h2>";
                                include "includes/view-all-comments.php";
                                break;
                            case 'success-unapproving';
                                echo "<h2>Comment successfully unapproved</h2>";
                                include "includes/view-all-comments.php";
                                break;
                            case 'success-deletion';
                                echo "<h2>Comment successfully deleted</h2>";
                                include "includes/view-all-comments.php";
                                break;
                            case 'success-updating';
                                echo "<h2>Comment successfully updated</h2>";
                                include "includes/view-all-comments.php";
                                break;
                            default:
                                include "includes/view-all-comments.php";
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