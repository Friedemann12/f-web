<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">SB Admin</a>
    </div>
    <!-- Top Menu Items -->
    <?php
    if ($_SESSION["user_role"] !== "admin") {
        echo '  
        <ul class="nav navbar-nav navbar-center">
            <li>
        <h4 class="navbar-text">With your current Userrole, you are not able to edit/delete oder add something!</h4>
            </li>
        </ul>';
    }
    ?>

    <ul class="nav navbar-right top-nav">
        <li>
            <p class="navbar-text">Currently online: <span class="usersonline"></span></p>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="../index.php">Homepage</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo " {$_SESSION["firstname"]} {$_SESSION["lastname"]}"; ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="posts.php"> View all </a>
                    </li>
                    <li>
                        <a href="posts.php?source=add-post"> Add Posts </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="categories.php"><i class="fa fa-fw fa-wrench"></i> Categories </a>
            </li>
            <li>
                <a href="comments.php"><i class="fa fa-fw fa-file"></i> Comments </a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="users" class="collapse">
                    <li>
                        <a href="users.php"> View All </a>
                    </li>
                    <li>
                        <a href="users.php?source=add-user"> Add User </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>