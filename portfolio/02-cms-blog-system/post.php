<?php include "includes/header.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php" ?>

<?php include "includes/db.php" ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">


            <!-- Blog Entries Column -->


            <div class="col-md-8">
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <?php


                if (isset($_GET["author"])) {

                    $clicked_post_author = escape($_GET["author"]);

                    echo "<h2>Alle Posts von: $clicked_post_author</h2>";

                    $query = "SELECT * FROM posts WHERE post_author = '$clicked_post_author'";
                    $slct_posts = mysqli_query($con, $query);

                    if (!$slct_posts) {
                        die("Query Failed " . mysqli_error($con));
                    }

                    while ($row = mysqli_fetch_assoc($slct_posts)) {
                        $post_id = $row["post_id"];
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_img = $row["post_img"];
                        $post_content = substr($row["post_content"], 0, 300);


                        echo "  <h2>
                            <a href='post.php?p_id={$post_id}'>{$post_title}</a>
                        </h2>
                        <p class='lead'>
                            by <a href='post.php?author={$post_author}'>{$post_author}</a>
                        </p>
                        <p><span class='glyphicon glyphicon-time'></span> Posted on {$post_date}</p>
                        <hr>
                        <a href='post.php?p_id={$post_id}'>
                        <img class='img-responsive' src={$post_img} alt=''>
                        </a>
                        <hr>
                        <p>{$post_content}...</p>
                        <a class='btn btn-primary' href='post.php?p_id={$post_id}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                        <hr>";
                    }
                }
                if (isset($_GET['p_id'])) {
                    $clicked_post_id = escape($_GET["p_id"]);

                    $view_query = "UPDATE posts SET post_view_count = post_view_count +1 WHERE post_id = $clicked_post_id";
                    $send_query = mysqli_query($con, $view_query);

                    $query = "SELECT * FROM posts WHERE post_id = $clicked_post_id";
                    $slct_posts = mysqli_query($con, $query);

                    if (!$slct_posts) {
                        die("Query Failed" . mysqli_error($con));
                    }

                    while ($row = mysqli_fetch_assoc($slct_posts)) {
                        $post_id = $row["post_id"];
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_img = $row["post_img"];
                        $post_content = $row["post_content"];


                        echo "  <h2>
                            {$post_title}
                        </h2>
                        <p class='lead'>
                            by <a href='post.php?author={$post_author}'>{$post_author}</a>
                        </p>
                        <p><span class='glyphicon glyphicon-time'></span> Posted on {$post_date}</p>
                        <hr>
                        <img class='img-responsive' src={$post_img} alt=''>
                        <hr>
                        <p>{$post_content}</p>
                                              <hr>";
                    }
                } else {
                    header("Location: index.php");
                }
                ?>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>


                <!-- Blog Comments -->

                <?php

                if (isset($_POST['create_comment'])) {

                    $the_post_id = escape($_GET['p_id']);

                    $comment_author = $_SESSION["username"];
                    $comment_content = escape($_POST['comment_content']);

                    $query = "INSERT INTO comments(comment_post_id, comment_author, comment_content, comment_status, comment_date) ";

                    $query .= "VALUES ('{$the_post_id}', '{$comment_author}','{$comment_content}', 'unapproved', now())";

                    $create_comment_query = mysqli_query($con, $query);

                    if (!$create_comment_query) {
                        die('QUERY FAILED' . mysqli_error($con));
                    }

                }


                ?>
                <?php
                if (!isset($_GET["author"])) {
                echo '           <!-- Comments Form -->
            <div class="well">
                <h4 style="font-weight: bold">Leave a Comment</h4>
                <form action="" method="post" role="form">
';
                if (isset($_SESSION["username"])) {
                    echo '                   
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="comment_content" required="required"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>';
                } else {
                    echo "<h5>Please <a href='post.php?p_id={$clicked_post_id}&source=focus-login'>Login</a> to post a comment</h5>";
                }
                ?>

                </form>
            </div>
            <?php } ?>
            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->

            <?php

            if (isset($_GET["p_id"])) {

                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'approved' ";
                $selct_com_for_posts = mysqli_query($con, $query);

                while ($row = mysqli_fetch_assoc($selct_com_for_posts)) {
                    $comment_id = $row['comment_id'];
                    $comment_author = $row["comment_author"];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];

                    echo "   <div class='media'>
                    <a class='pull-left' href='#'>
                        <img class='media-object' src='http://placehold.it/64x64' alt=''>
                    </a>
                <div class='media-body'>
                    <h4 class='media-heading'>$comment_author
                        <small>$comment_date</small>
                    </h4>
                    $comment_content
                </div>
            </div><br>";
                }
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

        <!-- /.row -->
    </div>

    <hr>

<?php
if (isset($_GET['source'])) {
    $source = $_GET['source'];
} else {
    $source = '';
}

if ($source == "focus-login") {
    echo "<script>
focusMethod = function getFocus() {          
  document.getElementById(\"test\").focus();
}

focusMethod();
</script>";
}
?>

<?php include "includes/footer.php"; ?>