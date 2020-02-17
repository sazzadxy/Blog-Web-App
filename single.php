<?php require_once('includes/header.php'); ?>

<div class="fluid-container">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-md-5 p-3">
    <?php require_once('includes/nav.php'); ?>
  </nav>
  <!--End nav-->

  <section id="main">
    <div class="post-single-information">
      <?php
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = 'SELECT * FROM post WHERE post_id = :id';
        $stmt = $pdo->prepare($query);
        $stmt->execute([
          'id' => $id
        ]);

        $count = $stmt->rowCount();
        if ($count == 1) {
          while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post_title = $post['post_title'];
            $post_des = $post['post_des'];
            $post_image = $post['post_img'];
            $post_date = $post['post_date'];
            $post_author = $post['post_author'];
            $post_cat_id = $post['post_cat_id']; ?>

            <div class="post-single-info">
              <div class="post-single-80">
                <h3 class="category-title">Category:
                  <?php
                  $query1 = 'SELECT * FROM categories WHERE cat_id =:id';
                  $stmt1 = $pdo->prepare($query1);
                  $stmt1->execute([
                    ':id' => $post_cat_id
                  ]);
                  while ($categories = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $cat_title = $categories['cat_title'];
                  }
                  echo $cat_title;
                  ?>
                </h3>
                <h3 class="post-single-title">Topic: <?php echo $post_title; ?></h3>
                <div class="post-single-box">
                  Posted by <?php echo $post_author; ?> at <?php echo $post_date; ?>
                </div>
              </div>
            </div>
            <div class="post-main">
              <img class="img-fluid" style="width:100%;height:auto" src="./img/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>" />
              <p class="mt-4">
                <?php echo $post_des; ?>
              </p>
            </div>
    </div>
      <?php  }
        } else {
          echo "<p class='alert alert-danger' style='text-align:center'>No Post Available !</p>";
        }
      } ?>


<div class="comments">
  <?php
  $query2 = 'SELECT * FROM comments WHERE comment_post_id  =:id';
  $stmt2 = $pdo->prepare($query2);
  $stmt2->execute([
    ':id' => $_GET['id']
  ]);
  $comment_count = $stmt2->rowCount();
  if ($comment_count == 0) {
    echo "No Comments Yet.";
  } else {
    echo '<h2 class="comment-count">'.$comment_count. ' Comments</h2>';
    while ($comment = $stmt2->fetch(PDO::FETCH_ASSOC)) {
      $comment_des = $comment['comment_des'];
      $comment_date = $comment['comment_date'];
      $comment_author = $comment['comment_author']; ?>

      <div class="comment-box">
        <img src="./img/user.jpg" style="width:88px;height:88px;border-radius:50%" alt="Commenter photo" class="comment-photo">
        <div class="comment-content">
          <span class="comment-author"><b><?php echo $comment_author; ?></b></span>
          <span class="comment-date"><?php echo $comment_date; ?></span>
          <p class="comment-text">
            <?php echo $comment_des; ?>
          </p>
        </div>
      </div>

  <?php }
  }
  ?>


  <h3 class="leave-comment">Leave a comment</h3>
  <?php 
  if (isset($_POST['submit-comment'])) {
    $name = trim($_POST['name']);
    // $email = trim($_POST['email']);
    $comment = $_POST['comment'];
    $date = date('D, d M Y h:i:s a'); 

    if (empty($name) || empty($comment)){
      echo "<div class='alert alert-danger' style='text-align:center'> Please Fill-up The Form !</div>";
    }else{
      $query3 = 'INSERT INTO comments (comment_des, comment_date, comment_author,comment_post_id) VALUES (:comment_des,:comment_date,:comment_author,:cp_id)';
      $stmt3 = $pdo->prepare($query3);
      $stmt3->execute([
        ':comment_des' => $comment,
        ':comment_date' => $date,
        ':comment_author' => $name,
        ':cp_id' => $_GET['id']
      ]);

      $query4 = 'UPDATE post SET post_comment = post_comment + 1  WHERE post_id =:id ';
      $stmt4 = $pdo->prepare($query4);
      $stmt4->execute([
        ':id' => $id
      ]);
      header("Location:single.php?id={$id}");
    }
  }
  ?>

  <div class="comment-submit">
    <form action="single.php?id=<?php echo $_GET['id'];?>" method="post" class="comment-form">
      <input class="input" type="text" name="name" placeholder="Your Name">
      <!-- <input class="input" type="email" placeholder="Enter valid email"> -->
      <textarea name="comment" id="" cols="20" rows="5" placeholder="Write Here...."></textarea>
      <input type="submit" value="Send" name="submit-comment" class="my-btn">
    </form>
  </div>
</div>
  </section>
  <?php require_once('includes/footer.php'); ?>