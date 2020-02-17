<?php require_once('includes/header.php'); ?>
<?php require_once("includes/userAuth.php"); ?>
<div class="fluid-container">
  <?php require_once('includes/nav.php'); ?>
  <!--End nav-->


  <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2">
    <div class="d-flex flex-row justify-content-between">
      <h2 class="my-3">All Comments</h2>
    </div>

    <table class="table table-sm">
      <thead class="thead-light">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">User name</th>
          <th scope="col">Comment</th>
          <th scope="col">For The Post</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $query = "SELECT * FROM comments WHERE comment_post_id=:id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
          ':id' => $_GET['id']
        ]);
        $count = $stmt->rowCount();
        if ($count == 0) {
          echo "<div class='alert alert-danger' style='text-align:center'>No Comments Available! <a href='index.php'>Back To Home</a></div>";
          exit;
        }
        while ($comment = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $com_id = $comment['comment_id'];
          $com_author = $comment['comment_author'];
          $com_des = $comment['comment_des']; ?>
          <tr>
            <td><?php echo $com_id; ?></td>
            <td><?php echo $com_author; ?></td>
            <td><?php echo $com_des; ?></td>
            <td>
              <a href="../single.php?id=<?php echo $_GET['id']; ?>">
                <?php
                $query1 = "SELECT * FROM post WHERE post_id =:id";
                $stmt1 = $pdo->prepare($query1);
                $stmt1->execute([
                  ':id' => $_GET['id']

                ]);
                while ($post = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                  $post_title = $post['post_title'];
                }
                echo $post_title;
                ?>
              </a>
            </td>
            <td>
              <form action="comments.php?id=<?php echo $_GET['id'];?>" method="POST">
                <input type="hidden" name="del" value="<?php echo $com_id; ?>" />
                <input type="submit" name="delete" class="btn btn-danger" value="Delete" />
              </form>
            </td>
          </tr>

        <?php }
        ?>
      </tbody>
    </table>
    <?php
    if (isset($_POST['delete'])) {
      $comID = $_POST['del'];
      $query2 = "DELETE FROM comments WHERE comment_id=:id";
      $stmt2 = $pdo->prepare($query2);
      $stmt2->execute([
        ':id' => $comID
      ]);

      $query3 = "UPDATE post SET post_comment = post_comment - 1 WHERE post_id =:pid";
      $stmt3 = $pdo->prepare($query3);
      $stmt3->execute([
        ':pid' => $_GET['id']
      ]);
      header("Location:comments.php?id={$_GET['id']}");
    }
    ?>

  </section>

  
</div>

<?php require_once('../includes/footer.php'); ?>