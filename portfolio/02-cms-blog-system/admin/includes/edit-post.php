<?php
if (isset($_GET["p_id"])) {

    $post_id_for_edit = escape($_GET["p_id"]);


    $query = "SELECT * FROM posts WHERE post_id = {$post_id_for_edit}";
    $slct_posts_by_id = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($slct_posts_by_id)) {
        $post_id = $row["post_id"];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_cat_id = $row['post_cat_id'];
        $post_status = $row['post_status'];
        $post_img = $row['post_img'];
        $post_tags = $row['post_tags'];
        $post_content = $row["post_content"];
    }
}
if ($_SESSION["user_role"] === "admin"){
if (isset($_POST["edit-post"])) {

    $post_author = escape($_POST['post_author']);
    $post_title = escape($_POST['post_title']);
    $post_cat_id = escape($_POST['post_cat_id']);
    $post_status = escape($_POST['post_status']);
    $post_img = escape($_FILES["post_img"]["name"]);
    $post_img_temp = escape($_FILES["post_img"]["tmp_name"]);
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST["post_content"]);

    move_uploaded_file($post_img_temp, "../images/$post_img");

    /*    if (empty($post_img)) {
            $query = "SELECT * FROM posts WHERE post_id = $post_id_for_edit ";
            $select_img = mysqli_query($con, $query);

            while ($row = mysqli_fetch_array($select_img)) {

                $post_img = $row['post_img'];

            }
        }*/

    $img_dir = "images/$post_img";

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_cat_id = '{$post_cat_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    if (!empty($post_img)) {
        $query .= "post_img = '{$img_dir}', ";
    }
    $query .= "post_content = '{$post_content}' ";
    $query .= "WHERE post_id = {$post_id_for_edit} ";

    $update_post = mysqli_query($con, $query);

    if (!$update_post) {
        die("Updating failed " . mysqli_error($con));
    } else {
        header("Location: posts.php?source=success-updating");
    }
}
}
?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
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


                    ?>
                    <option value="<?php echo $cat_id ?>" <?php if ($cat_id == $post_cat_id) echo 'selected' ?>><?php echo $cat_title ?>
                    </option>
            <?php }
            }
            ?>

        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_img">Post Image</label>
        <br>
        <img src="../<?php echo $post_img; ?>" width="350px">
        <hr>
        <label>Select new Image</label>
        <input type="file" name="post_img">
        <hr>
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" class="form-control" id="editor" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
    </div>


    <div class="form-group"><input class="btn btn-primary" type="submit" name="edit-post" value="Edit Post" <?php if ($_SESSION["user_role"] != "admin") {
                                                                                                                echo "disabled";
                                                                                                            } ?>></div>

</form>