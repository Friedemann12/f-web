<?php include "includes/header.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php" ?>
<?php include "includes/db.php"; ?>
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


            if (isset($_GET["page"])) {

                $page = escape($_GET["page"]);

            } else {
                $page = "";
            }
            if ($page == "" || $page == 1) {

                $page_1 = 0;

            } else {

                $page_1 = ($page * 5) - 5;

            }

            $query_posts = "SELECT * FROM posts";
            $count_query = mysqli_query($con, $query_posts);
            $count = mysqli_num_rows($count_query);

            $counting = ceil($count / 5);

            $query = "SELECT * FROM posts LIMIT $page_1, 5";
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

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>


    <ul class="pager">

        <?php

        for ($i = 1; $i <= $counting; $i++) {

            if ($i == $page) {

                echo "<li><a class='active_link' href='index.php?page={$i}'>$i</a></li>";

            } else {

                echo "<li><a href='index.php?page={$i}'>$i</a></li>";
            }
        }

        ?>

    </ul>


<?php include "includes/footer.php"; ?>