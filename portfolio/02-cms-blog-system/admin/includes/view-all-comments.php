<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Content</th>
            <th>In Response to</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>


        <?php
        $query = "SELECT * FROM comments";
        $slct_comments = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($slct_comments)) {
            $comment_id = $row['comment_id'];
            $comment_author = $row['comment_author'];
            $comment_content = substr($row['comment_content'], 0, 30);
            $comment_post_id = $row['comment_post_id'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];

            echo "<tr>";
            echo "<td>$comment_id</td> ";
            echo "<td>$comment_author</td> ";
            echo "<td>$comment_content...</td> ";
            $query_posts = "SELECT * FROM posts WHERE post_id = $comment_post_id ";

            $select_post_id = mysqli_query($con, $query_posts);

            while ($row = mysqli_fetch_assoc($select_post_id)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];

                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            }
            echo "<td>$comment_status</td> ";
            echo "<td>$comment_date</td> ";

            if ($_SESSION["user_role"] === "admin") {
                echo "<td><a href='comments.php?approve-comment=$comment_id'>Approve</a></td> ";
                echo "<td><a href='comments.php?unapprove-comment=$comment_id'>Unapprove</a></td> ";
                echo "<td><a onclick=\"javascript: return confirm('Are you Sure you want to delete?');\" href='comments.php?delete=$comment_id'>Delete</a></td> ";
            } else { }
            echo "<td><p href='comments.php?approve-comment=$comment_id' disabled>Approve</p></td> ";
            echo "<td><p href='comments.php?unapprove-comment=$comment_id'disabled>Unapprove</p></td> ";
            echo "<td><p onclick=\"javascript: return confirm('Are you Sure you want to delete?');\" href='comments.php?delete=$comment_id' disabled>Delete</p></td> ";
        }
        ?>


    </tbody>
</table>


<?php


if (isset($_GET["delete"])) {

    $comment_id_delete = escape($_GET["delete"]);

    $query = "DELETE FROM comments WHERE comment_id = {$comment_id_delete} ";

    $delte_query = mysqli_query($con, $query);


    if (!$delte_query) {
        die("Could not delete this post" . mysqli_error($con));
    } else {
        header("Location: comments.php?source=success-deletion");
    }
}

if (isset($_GET["approve-comment"])) {

    $comment_id_ap = escape($_GET["approve-comment"]);

    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id_ap ";

    $approve_query = mysqli_query($con, $query);


    if (!$approve_query) {
        die("Query Failed, please try again" . mysqli_error($con));
    } else {
        header("Location: comments.php?source=success-approving");
    }
}


if (isset($_GET["unapprove-comment"])) {

    $comment_id_unap = escape($_GET["unapprove-comment"]);

    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_id_unap ";

    $approve_query = mysqli_query($con, $query);


    if (!$approve_query) {
        die("Query Failed, please try again" . mysqli_error($con));
    } else {
        header("Location: comments.php?source=success-unapproving");
    }
}

?>