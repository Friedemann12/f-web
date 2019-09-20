<?php

function escape($string)
{

    global $con;

    return mysqli_real_escape_string($con, trim(strip_tags($string)));

}


function insert_categories()
{
    global $con;


    if (isset($_POST['submit'])) {

        $cat_title = escape($_POST["cat_title"]);

        if ($cat_title == "" || empty($cat_title)) {
            echo "This field cannot be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUES('{$cat_title}')";

            $create_cat_query = mysqli_query($con, $query);

            if (!$create_cat_query) {
                die("Something went wrong" . mysqli_error($con));
            }
        }

    }


}


function delete_categories()
{
    global $con;

    //DELETE QUERY

    if (isset($_GET["delete"])) {

        echo '<script></script>';

        $cat_id_for_delete = escape($_GET["delete"]);

        $query = "DELETE FROM categories WHERE cat_id = {$cat_id_for_delete} ";

        $delete_query = mysqli_query($con, $query);

        header("Location: categories.php");

        if (!$delete_query) {
            die("Deletion aborted" . mysqli_error($con));
        }

    }


}

function find_all_categories()
{
    global $con;

    /* find all Cats */

    $query = "SELECT * FROM categories";
    $slct_cats = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($slct_cats)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row["cat_id"];

        echo "<tr>";
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td><a href='categories.php?update={$cat_id}'>Edit</a</td>";
        echo "<td><a onclick=\"javascript: return confirm('Are you Sure you want to delete?');\" href='categories.php?delete={$cat_id}'>Delete</a</td>";
        echo "</tr>";
    }
}


function user_online()
{
    if (isset($_GET["onlineusers"])) {

        global $con;

        if (!$con) {

            session_start();

            include("../../includes/db.php");


            $session = session_id();
            $time = time();
            $time_out_in_sec = 10;
            $time_out = $time - $time_out_in_sec;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($con, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {

                mysqli_query($con, "INSERT INTO users_online (session, time) VALUES ('$session', '$time')");

            } else {

                mysqli_query($con, "UPDATE users_online SET time = '$time' WHERE session = '$session'");

            }

            $users_online = mysqli_query($con, "SELECT * FROM users_online WHERE time > '$time_out'");

            echo $count_user = mysqli_num_rows($users_online);

        }

    }
}

user_online();

