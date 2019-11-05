<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Update Category</label>


        <?php

        if (isset($_GET['update'])) {
            $cat_id_for_edit = escape($_GET['update']);


            $query = "SELECT * FROM categories WHERE cat_id = {$cat_id_for_edit}";
            $slct_cats_id = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($slct_cats_id)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row["cat_id"];

                ?>

                <input value="<?php if (isset($cat_title)) {
                                            echo $cat_title;
                                        } ?>" type="text" class="form-control" name="cat_title">

        <?php }
        } ?>

        <?php

        // UPDATE QUERY
        if ($_SESSION["user_role"] === "admin"){

        if (isset($_POST["update"])) {

            $cat_title_for_edit = escape($_POST["cat_title"]);

            $query = "UPDATE categories SET cat_title = '{$cat_title_for_edit}' WHERE cat_id = {$cat_id_for_edit}";

            $update_query = mysqli_query($con, $query);

            header("Location: categories.php");

            if (!$update_query) {
                die("Update aborted" . mysqli_error($con));
            }
        }
    }
        ?>


    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update Category" <?php if ($_SESSION["user_role"] != "admin") {
                                                                                                echo "disabled";
                                                                                            } ?>>
    </div>

</form>