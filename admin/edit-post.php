<?php require_once('includes/header.php'); ?>
<?php require_once("includes/userAuth.php"); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header("Loation:index.php");
}

if (isset($_POST['edt'])) {
    $pid = $_POST['edt'];
    $query1 = "SELECT * FROM post WHERE post_id = :pid";
    $stmt1 = $pdo->prepare($query1);
    $stmt1->execute([
        ':pid' => $pid
    ]);
    while ($post = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $post_id = $post['post_id'];
        $post_title = $post['post_title'];
        $post_cat_id = $post['post_cat_id'];
        $post_status = $post['post_status'];
        $post_content = $post['post_des'];
        $post_img = $post['post_img'];
    }
}
?>

<div class="fluid-container">
    <?php require_once('includes/nav.php'); ?>
    <!--End nav-->


    <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2 pt-3">
        <h2 class="pb-3">Edit Post</h2>
        <?php
        if (isset($_POST['update-post'])) {
            $post_title = $_POST['post-title'];
            $post_cat_id = $_POST['cat-id'];
            $post_status = $_POST['status'];
            $postid = $_POST['edit-post-id'];
            $post_content = $_POST['post-content'];
            $post_date = date('D, d M Y h:i:s a');
            $post_author = "Admin";
            $post_img = $_FILES['post-img']['name'];
            $post_temp_img = $_FILES['post-img']['tmp_name'];
            move_uploaded_file("{$post_temp_img}", "../img/{$post_img}");
            if (empty($post_img)) {
                $stmt4 = "SELECT * FROM post WHERE post_id =:id";
                $stmt4 = $pdo->prepare($stmt4);
                $stmt4->execute([
                    ':id' => $postid
                ]);
                while ($post = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                     $post_img = $post['post_img'];
                }
            }
            if (empty($post_title) || empty($post_cat_id) || empty($post_status) || empty($post_content)) {
                echo "<div class='alert alert-danger'style='text-align:center'>Fields Can't Blank!</div>";
            } else {
                $query2 = "UPDATE post SET post_title=:title, post_des=:des, post_img=:img, post_date=:date, post_author=:author, post_cat_id=:cat_id, post_status=:status WHERE post_id=:id";
                $stmt2 = $pdo->prepare($query2);
                $stmt2->execute([
                    ':title' => $post_title,
                    ':des' => $post_content,
                    ':img' => $post_img,
                    ':date' => $post_date,
                    ':author' => $post_author,
                    ':cat_id' => $post_cat_id,
                    ':status' => $post_status,
                    ':id' => $postid
                ]);
                header("Location:index.php");
            }
        }

        ?>
        <form action="edit-post.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" value="<?php echo $post_id; ?>" name="edit-post-id" />
                <label for="post-title">Post Title</label>
                <input type="text" name="post-title" value="<?php echo $post_title; ?>" class="form-control" id="post-title" placeholder="Enter post title">
            </div>
            <div class="form-group">
                <label for="category">Select Category</label>
                <select class="form-control" name="cat-id" id="category">
                    <?php
                    $query3 = "SELECT * FROM categories";
                    $stmt3 = $pdo->prepare($query3);
                    $stmt3->execute();
                    while ($categories = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                        $cat_id = $categories['cat_id'];
                        $cat_title = $categories['cat_title']; ?>
                        echo "<option value="<?php echo $cat_id; ?>" <?php echo $cat_id == $post_cat_id ? 'selected' : '' ?>><?php echo $cat_title; ?></option>";
                    <?php }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="category">Post Status</label>
                <select class="form-control" name="status" id="category">
                    <option <?php echo $post_status == 'Published' ? 'selected' : '' ?>>Published</option>
                    <option <?php echo $post_status == 'Draft' ? 'selected' : '' ?>>Draft</option>
                </select>
            </div>
            <div class="form-group">
                <img src="../img/<?php echo $post_img; ?>" style="width:5em;height:5em" />
                <label for="post-image">Upload post image</label>
                <input type="file" name="post-img" class="form-control-file" id="post-image">
            </div>
            <div class="form-group">
                <label for="post-content">Post Content</label>
                <textarea name="post-content" class="form-control" id="post-content" rows="5" col="20" placeholder="Your post content">
                    <?php echo $post_content; ?></textarea>
            </div>
            <button type="submit" name="update-post" class="btn btn-primary">Submit</button>
        </form>
    </section>
</div>
<?php require_once('../includes/footer.php'); ?>