<?php
include "functions.php";
if (isset($_POST["create_post"])) {
    $post_title = escape($_POST["post_title"]);
    $post_author = escape($_POST["post_author"]);
    $post_cat_id = escape($_POST["post_cat_id"]);
    $post_tags = escape($_POST["post_tags"]);
    $post_content = escape($_POST["post_content"]);
    $post_img = escape($_FILES["post_img"]["name"]);
    $post_img_temp = escape($_FILES["post_img"]["tmp_name"]);
    $post_date = date("y-m-d");
    $post_com_count = 0;
    move_uploaded_file($post_img_temp, "../images/$post_img");
    $img_dir = "../images/$post_img";
    $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_com_count) ";
    $query .= "VALUES('{$post_cat_id}','{$post_title}','{$post_author}','{$post_date}','{$img_dir}','{$post_content}','{$post_tags}','{$post_com_count}')";
    $create_post_query = mysqli_query($con, $query);
    // global $create_post_query;
    if (!$create_post_query) {
        die("NO post created " . mysqli_error($con));
    } else {
        header("Location: posts.php?source=success-posting");
    }
}
?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_cat_id">Post Category</label>
        <select name="post_cat_id" id="" value="{post_id_for_edit}">
            <?php
            $query = "SELECT * FROM categories";
            $select_cat_id = mysqli_query($con, $query);
            if (!$select_cat_id) {
                die("Query Failed " . mysqli_error($con));
            } else {
                while ($row = mysqli_fetch_assoc($select_cat_id)) {
                    $cat_id = $row["cat_id"];
                    $cat_title = $row["cat_title"];
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            }
            ?>

        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_img">Post Image</label>
        <input type="file" name="post_img">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" class="form-control" id="editor" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>


    <div class="form-group"><input class="btn btn-primary" type="submit" name="create_post" value="Publish Post"></div>

</form>