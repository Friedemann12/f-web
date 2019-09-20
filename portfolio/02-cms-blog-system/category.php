<?php include "includes/header.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php" ?>
<?php include "includes/db.php"; ?>
    <!-- Page Content -->
    <div class="container">

    <div class="row">


        <!-- Blog Entries Column -->


        <div class="col-md-8">
            <?php

            if (isset($_GET["category"])) {
                $posts_cat_id = escape($_GET['category']);


                $query = "SELECT * FROM categories WHERE cat_id = {$posts_cat_id} ";
                $cat_query = mysqli_query($con, $query);

                if (!$cat_query) {
                    die("Query Failed " . mysqli_error($con));
                } else {
                    $row = mysqli_fetch_assoc($cat_query);
                    $posts_category = $row["cat_title"];
                }


                $query = "SELECT * FROM posts WHERE post_cat_id = $posts_cat_id";
                $slct_posts = mysqli_query($con, $query);

                if (empty(mysqli_fetch_assoc($slct_posts))) {
                    echo "<h1 class='page-header'>No {$posts_category} related Posts yet!</h1>
                       <iframe src=\"https://giphy.com/embed/JIX9t2j0ZTN9S\" width=\"480\" height=\"480\" frameBorder=\"0\" class=\"giphy-embed\" allowFullScreen></iframe>                   
                    <p class='lead'>But we're working on it!</p>";

                } else {

                    $slct_posts = mysqli_query($con, $query);

                    echo "<h1 class='page-header'>
                            All {$posts_category} related Posts
                            <small>Secondary Text</small>
                          </h1>";

                    while ($row = mysqli_fetch_assoc($slct_posts)) {
                        $post_id = $row["post_id"];
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_img = $row["post_img"];
                        $post_content = substr($row["post_content"], 0, 300);

                        echo "                        <h2>
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
                    <?php
                }
            } ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php"; ?>