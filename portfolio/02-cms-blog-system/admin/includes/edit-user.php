<?php

if (isset($_GET["u_id"])) {

    $user_id_for_edit = escape($_GET["u_id"]);


    $query = "SELECT * FROM users WHERE user_id = {$user_id_for_edit}";
    $slct_user_by_id = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($slct_user_by_id)) {
        $user_id = $row["user_id"];
        $username = $row['username'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
    }
}

if (isset($_POST["edit-user"])) {
    $user_role = escape($_POST['user_role']);

    $query = "UPDATE users SET ";
    $query .= "user_role = '{$user_role}' ";
    $query .= "WHERE user_id = {$user_id_for_edit} ";

    $update_user = mysqli_query($con, $query);

    if (!$update_user) {
        die("Updating failed " . mysqli_error($con));
    } else {
        $_SESSION["user_role"] = "$user_role";
        header("Location: users.php?source=success-updating");

    }
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <label>User ID</label>
    <p><?php echo $user_id; ?></p>

    <label>Username</label>
    <p><?php echo $username; ?></p>

    <div class="form-group">
        <label for="user_role">Post Author</label>
        <select name="user_role">
            <option>user</option>
            <option>test-admin</option>
            <option>admin</option>
        </select>
    </div>

    <div class="form-group"><input class="btn btn-primary" type="submit" name="edit-user" value="Edit User"></div>

</form>