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
                        <small>Category-Section</small>
                    </h1>

                    <div class="col-xs-6">


                        <?php
                        insert_categories();
                        ?>


                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category"> <?php if ($_SESSION["user_role"] != "admin") {
                                                                                                                        echo "disabled";
                                                                                                                    } ?>
                            </div>

                        </form>


                        <?php

                        if (isset($_GET['update'])) {
                            $cat_id_for_edit = escape($_GET['update']);
                            include "includes/update-categories.php";
                        }

                        ?>


                    </div>

                    <div class="col-xs-6">


                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                find_all_categories();
                                ?>

                                <?php
                                delete_categories();
                                ?>

                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes/admin-footer.php"; ?>