<?php include "db.php"; ?>
<?php include "../admin/includes/functions.php"; ?>
<?php session_start(); ?>
<?php

if (isset($_POST['login'])) {

    $username = escape($_POST['username']);
    $password = escape($_POST['password']);


    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($con, $query);
    if (!$select_user_query) {
        die("QUERY FAILED" . mysqli_error($con));
    } else {
        $row = mysqli_fetch_assoc($select_user_query);

        $db_ib = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];


        if (password_verify($password, $db_user_password) && $db_user_role == "admin" || $db_user_role == "test_admin") {

            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;


            header("Location: ../admin/index.php");
        } else if (password_verify($password, $db_user_password)) {

            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;

            $session = session_id();
            $time = time();
            $time_out_in_sec = 30;
            $time_out = $time - $time_out_in_sec;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($con, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {

                mysqli_query($con, "INSERT INTO users_online (session, time) VALUES ('$session', '$time')");

            } else {

                mysqli_query($con, "UPDATE users_online SET time '$time' WHERE session = '$session'");

            }

            header("Location: ../index.php?source=login-success");

        } else {
            header("Location: ../index.php?source=login-failed");
        }
    }

}
?>