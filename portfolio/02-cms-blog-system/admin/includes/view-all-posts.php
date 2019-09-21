<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Views</th>
            <th>Comments</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>


        <?php
        $query = "SELECT * FROM posts";
        $slct_posts = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($slct_posts)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_cat_id = $row['post_cat_id'];
            $post_img = $row['post_img'];
            $post_tags = $row['post_tags'];
            $post_com_count = $row['post_com_count'];
            $post_date = $row['post_date'];
            $post_view_count = $row["post_view_count"];

            $query = "SELECT post_id FROM posts ";
            $sel_query = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($sel_query)) {

                $query_counter = "SELECT COUNT(*) from comments WHERE comment_post_id = $post_id ";

                $counter = mysqli_query($con, $query_counter);

                while ($row = mysqli_fetch_assoc($counter)) {
                    $query = "UPDATE posts SET post_com_count = " . $row['COUNT(*)'] . " WHERE post_id = $post_id ";
                    $inserting_counter = mysqli_query($con, $query);
                }
            }

            echo "<tr>";
            echo "<td > $post_id</td > ";
            echo "<td > $post_author</td > ";
            echo "<td > $post_title</td > ";

            $query = "SELECT * FROM categories WHERE cat_id = {$post_cat_id} ";

            $select_cat_id = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($select_cat_id)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<td>{$cat_title}</td>";
            }
            echo "<td ><img width = '100' src = '../$post_img' </td > ";
            echo "<td > $post_tags</td > ";
            echo "<td> $post_view_count</td>";
            echo "<td > $post_com_count</td > ";
            echo "<td > $post_date</td > ";

            if ($_SESSION["user_role"] === "admin") {
                echo "<td><a onclick=\"javascript: return confirm('Are you Sure you want to reset the view-count?');\" href='posts.php?source=reset-views&p_id=$post_id'> Reset</a></td>";
            } else {
                echo "<td><p> Reset</p></td>";
            }
            echo "<td ><a href = 'posts.php?source=edit-post&p_id=$post_id' > Edit</a ></td > ";
            if ($_SESSION["user_role"] === "admin") {
                echo "<td ><a onclick=\"javascript: return confirm('Are you Sure you want to delete?');\" href = 'posts.php?delete=$post_id' > Delete</a ></td > ";
            } else {
                echo "<td ><p> Delete</p></td > ";
            }
            echo "</tr > ";
        }
        ?>


    </tbody>
</table>


<?php

if (isset($_GET["source"])) {

    $source = escape($_GET["source"]);
    if ($source == "reset-views") {

        $slctd_post = escape($_GET["p_id"]);
        $view_query = "UPDATE posts SET post_view_count = 0 WHERE post_id = $slctd_post";
        $send_query = mysqli_query($con, $view_query);

        if (!$send_query) {
            die("Query Failed" . mysqli_error($con));
        }

        header("Location: posts.php?source=success-resetting");
    }
}

if (isset($_GET["delete"])) {

    $post_id_delete = escape($_GET["delete"]);

    $query = "DELETE FROM posts WHERE post_id = {$post_id_delete} ";

    $delte_query = mysqli_query($con, $query);


    if (!$delte_query) {
        die("Could not delete this post" . mysqli_error($con));
    } else {
        header("Location: posts.php?source=success-deletion");
    }
}

?>