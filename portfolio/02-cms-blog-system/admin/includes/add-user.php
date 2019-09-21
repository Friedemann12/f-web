<?php


if (isset($_POST["create_user"])) {
    $username = escape($_POST["username"]);
    $user_password = escape($_POST["user_password"]);
    $user_firstname = escape($_POST["user_firstname"]);
    $user_lastname = escape($_POST["user_lastname"]);
    $user_email = escape($_POST["user_email"]);
    $user_image = escape($_FILES["user_image"]["name"]);
    $user_image_temp = escape($_FILES["user_image"]["tmp_name"]);
    $user_role = escape($_POST["user_role"]);

    move_uploaded_file($user_image_temp, "../images/user-images/$user_image");

    $img_dir = "../images/$user_image";

    $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";
    $query .= "VALUES('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}', '{$user_role}')";


    $create_user_query = mysqli_query($con, $query);

    global $create_user_query;
    if (!$create_user_query) {
        die("NO User created " . mysqli_error($con));
    } else {
        header("Location: users.php?source=success-creating");
    }
}


?>


<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role">
            <option>user</option>
            <option>subscriber</option>
            <option>admin</option>
        </select>
    </div>
    <div class="form-group">
        <label for="user_email">User Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_password">User Password</label>
        <br>
        <input id="password" type="password" required="required" placeholder="password" name="user_password"><br><br>
        <input id="confirm_password" type="password" required="required" placeholder="confirm password">

        <script>
            var password = document.getElementById("password"),
                confirm_password = document.getElementById("confirm_password");

            function validatePassword() {
                if (password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("Passwords Don't Match");
                } else {
                    confirm_password.setCustomValidity('');
                }
            }

            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;
        </script>

    </div>
    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="user_image">
    </div>


    <div class="form-group"><input class="btn btn-primary" type="submit" name="create_user" value="Create User" <?php if ($_SESSION["user_role"] != "admin") {
                                                                                                                    echo "disabled";
                                                                                                                } ?>></div>

</form>