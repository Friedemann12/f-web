<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>


        <form action="../search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control" placeholder='Explore "The Blog"'>
                <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>


    <!-- Login Well -->
    <?php

    if (!isset($_SESSION["username"])) {

        echo '<div class="well">
        <h4>Login</h4>';


        if (isset($_GET['source'])) {
            $source = $_GET['source'];
        } else {
            $source = '';
        }

        if ($source == "login-failed") {

            echo "<p style='color: tomato'>Login Failed. Please Check your Input</p>";

        }

        echo '
        <form action="includes/login.php" method="post">

            <div class="form-group">
                <input id="test" name="username" type ="text" placeholder="Username" class="form-control" required ="required">
            </div>
            <div class="input-group">
                <input name="password" type="password" placeholder="Password" class="form-control" required="required">
                <span class="input-group-btn">
                    <button name = "login" class="btn btn-primary" type = "submit"> Login
                    </button>
                </span>
            </div>

        </form>
        <br>
        <p> Not yet a User ? Click here to <a href = "sing-up.php"> Sing up </a></p>
    </div>
';
    }
    ?>
    <!-- Blog Categories Well -->
    <div class="well">


        <?php

        $query = "SELECT * FROM categories";
        $slct_cats_sidebar = mysqli_query($con, $query);

        ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">


                    <?php
                    while ($row = mysqli_fetch_assoc($slct_cats_sidebar)) {
                        $cat_id = $row["cat_id"];
                        $cat_title = $row["cat_title"];

                        echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";

                    }
                    ?>


                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <ul class="list-unstyled">

                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>


    <!-- Side Widget Well -->
    <?php
    include "includes/widget.php"
    ?>

</div>


<?php
if ($source == "already-user") {
    echo "<script>
focusMethod = function getFocus() {          
  document.getElementById(\"test\").focus();
}

focusMethod();
</script>";
}
?>