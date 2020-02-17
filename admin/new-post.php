<?php require_once('includes/header.php'); ?>
<?php require_once("includes/userAuth.php");?>

<div class="fluid-container">
 <?php require_once('includes/nav.php');?>
     <!--End nav-->        

        <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2 pt-3">
            <h2 class="pb-3">Add New Post</h2>
            <?php 
            if (isset($_POST['new-post'])) {
                $post_title = $_POST['post-title'];
                $post_cat_id = $_POST['cat-id'];
                $post_status = $_POST['status'];
                $post_content = $_POST['post-content'];
                $post_date = date('D, d M Y h:i:s a');
                $post_author = "Admin";
                $post_img = $_FILES['post-img']['name'];
                $post_temp_img = $_FILES['post-img']['tmp_name'];
                move_uploaded_file("{$post_temp_img}","../img/{$post_img}");
                if (empty($post_title) || empty($post_cat_id) || empty($post_status) || empty($post_content) || empty($post_img)) {
                    echo "<div class='alert alert-danger'style='text-align:center'>Fields Can't Blank!</div>";
                }else{
                    $query = "INSERT INTO post (post_title, post_des, post_img, post_date, post_author, post_cat_id, post_status) VALUES (:title,:des,:img,:date,:author,:cat_id,:status)";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([
                        ':title' => $post_title,
                        ':des' => $post_content,
                        ':img' => $post_img,
                        ':date' => $post_date,
                        ':author' => $post_author,
                        ':cat_id' => $post_cat_id,
                        ':status' => $post_status
                    ]);
                    echo "<div class='alert alert-success'style='text-align:center'>Post Added Successfully. <a href='index.php'>Back To Home</a></div>";
                }               
            }
            
            ?>

            <form action="new-post.php" method="post" enctype="multipart/form-data">
                <div class="form-group"> 
                    <label for="post-title">Post Title</label>
                    <input type="text" name="post-title" class="form-control" id="post-title" placeholder="Enter post title">
                </div>
                <div class="form-group">
                    <label for="category">Select Category</label>
                    <select class="form-control" name="cat-id" id="category">
                        <?php
                        $query2 ="SELECT * FROM categories";
                        $stmt2 = $pdo->prepare($query2);
                        $stmt2->execute();
                        while ($categories = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                            $cat_id = $categories['cat_id'];
                            $cat_title = $categories['cat_title']; ?>
                            echo "<option value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>";
                       <?php } 
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Post Status</label>
                    <select class="form-control" name="status" id="category">
                        <option>Published</option>
                        <option>Draft</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="post-image">Upload post image</label>
                    <input type="file" name="post-img" class="form-control-file" id="post-image">
                </div>
                <div class="form-group">
                    <label for="post-content">Post Content</label>
                    <textarea class="form-control" name="post-content" id="post-content" rows="6" placeholder="Your post content"></textarea>
                </div>
                <button type="submit" name="new-post" class="btn btn-primary">Submit</button>
            </form>
        </section>

    </div>
    <?php require_once('../includes/footer.php'); ?>