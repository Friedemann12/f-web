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
                        <small>User-Section</small>
                    </h1>

                    <div class="table-responsive">
                        <?php
                        if (isset($_GET["source"])) {
                            $source = $_GET["source"];
                        } else {
                            $source = "";
                        }

                        switch ($source) {
                            case 'add-user';
                                include "includes/add-user.php";
                                break;
                            case 'edit-user';
                                include "includes/edit-user.php";
                                break;
                            case 'success-creating';
                                echo "<h2>User successfully created</h2>";
                                include "includes/view-all-users.php";
                                break;
                            case 'success-deletion';
                                echo "<h2>User successfully deleted</h2>";
                                include "includes/view-all-users.php";
                                break;
                            case 'success-updating';
                                echo "<h2>User successfully updated</h2>";
                                include "includes/view-all-users.php";
                                break;
                            default:
                                include "includes/view-all-users.php";
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