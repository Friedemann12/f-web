<table class="table table-hover">
    <thead>
        <tr>
            <th>User-Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Image</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>


        <?php
        $query = "SELECT * FROM users";
        $slct_posts = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($slct_posts)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_image = $row['user_image'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];

            echo "<tr>";
            echo "<td > $user_id</td > ";
            echo "<td > $username</td > ";
            echo "<td > $user_firstname</td > ";
            echo "<td > $user_lastname</td > ";
            echo "<td > $user_image</td > ";
            echo "<td > $user_email</td > ";
            echo "<td > $user_role</td > ";
            echo "<td ><a href = 'users.php?source=edit-user&u_id=$user_id' > Edit</a ></td > ";
            if ($_SESSION["user_role"] === "admin") {
                echo "<td ><a onclick=\"javascript: return confirm('Are you Sure you want to delete?');\" href = 'users.php?delete=$user_id' > Delete</a ></td > ";
            } else {
                echo "<td ><p> Delete</p ></td > ";
            }
            echo "</tr > ";
        }
        ?>


    </tbody>
</table>


<?php


if (isset($_GET["delete"])) {

    $user_id_delete = escape($_GET["delete"]);

    $query = "DELETE FROM users WHERE user_id = {$user_id_delete} ";

    $delte_query = mysqli_query($con, $query);


    if (!$delte_query) {
        die("Could not delete this post" . mysqli_error($con));
    } else {
        header("Location: users.php?source=success-deletion");
    }
}

?>