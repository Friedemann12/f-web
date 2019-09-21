<?php session_start(); ?>

<?php

include "../includes/db.php";

$session = session_id();

$query = "DELETE FROM users_online WHERE session = '$session' ";

$delete_query = mysqli_query($con, $query);

if (!$delete_query) {
    die("QUERY FAILED" . mysqli_error($con));
}

$_SESSION["username"] = null;
$_SESSION["firstname"] = null;
$_SESSION["lastname"] = null;
$_SESSION["user_role"] = null;


header("Location: index.php?source=logged-out")

?>
