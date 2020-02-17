<!-- <?php ob_start(); ?> -->
<?php require_once('includes/header.php'); ?>
<?php require_once("includes/userAuth.php"); ?>
<div class="fluid-container">
  <?php require_once('includes/nav.php'); ?>
  <!--End nav-->
  <!-- <?php session_start(); ?> -->

  <?php
  //$status ='Published';
  $post_per_page = 6;
  $query3 = 'SELECT * FROM post';
  $stmt3 = $pdo->prepare($query3);
  $stmt3->execute();
  $post_count = $stmt3->rowCount();
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page == 1) {
      $page_id = 0;
    } else {
      //$page_id = ($page -1) * $post_per_page;
      $page_id = ($post_per_page * $page) - $post_per_page;
    }
  } else {
    $page_id = 0;
    $page = 1;
  }
  $total_page = ceil($post_count / $post_per_page);
  ?>

  <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2">
    <div class="d-flex flex-row justify-content-between">
      <h2 class="my-3">All Posts</h2>
      <a class="btn btn-success align-self-center d-block" href="new-post.php">Add New Post</a>
    </div>

    <table class="table table-sm">
      <thead class="thead-light">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Post Title</th>
          <th scope="col">Post Category</th>
          <th scope="col">Post Status</th>
          <!-- <th scope="col" class="d-none d-md-table-cell">Post Tags</th> -->
          <th scope="col">Comments</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT * FROM post LIMIT $page_id, $post_per_page";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 0) {
          echo "<div class='alert alert-danger' style='text-align:center'>No Post Found !</div>";
        } else {
          while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post_id = $post['post_id'];
            $post_title = $post['post_title'];
            $post_cat_id = $post['post_cat_id'];
            $post_status = $post['post_status'];
            $post_comment = $post['post_comment']; ?>
            <tr>
              <td><?php echo $post_id; ?></td>
              <td><?php echo $post_title; ?></td>
              <td><?php
                  $query1 = 'SELECT * FROM categories WHERE cat_id = :id';
                  $stmt1 = $pdo->prepare($query1);
                  $stmt1->execute([
                    ':id' => $post_cat_id
                  ]);

                  while ($categories = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $cat_title = $categories['cat_title'];
                  }
                  echo $cat_title;

                  ?>
              </td>
              <td><?php echo $post_status; ?></td>
              <!-- <td class="d-none d-md-table-cell">works, php</td> -->
              <td>
                <a href="comments.php?id=<?php echo $post_id ?>"><?php echo $post_comment; ?></a>
              </td>
              <td>
                <form action="edit-post.php" method="POST">
                  <input type="hidden" value="<?php echo $post_id; ?>" name="edt" />
                  <input type="submit" name="edit-post" class="btn btn-primary" value="Edit" />
                </form>
              </td>
              <td>
                <form action="index.php" method="POST">
                  <input type="hidden" value="<?php echo $post_id; ?>" name="del" />
                  <input type="submit" name="delete-post" class="btn btn-danger" value="Delete" />
                </form>
              </td>
            </tr>
        <?php   }
        }
        ?>

        <?php
        if (isset($_POST['del'])) {
          $id = $_POST['del'];
          $query2 = "DELETE FROM post WHERE post_id =:id";
          $stmt2 = $pdo->prepare($query2);
          $stmt2->execute([
            ':id' => $id
          ]);
          header("Location:index.php");
        }
        

        ?>



      </tbody>
    </table>

  </section>

  <?php
  if ($post_count > $post_per_page) { ?>

    <ul class="pagination px-5 justify-content-center">
      <?php 
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $first = $page = 1;
      }else{
        $first = 1;
      }
      $page_id = 0;
      if ($first  != $page_id) {
        echo '<li class="page-item ">
        <a class="page-link" href="index.php?page='.$first. '">First</a>
        </li>';
      } else {
        echo '<li class="page-item disabled"> <a class="page-link" href="#">Last</a>
        </li>';
      }
      ?>
      <?php
      if (isset($_GET['page'])) {
        $prev = $_GET['page'] - 1;
      } else {
        $prev = 0;
      }
      if ($prev + 1 <= 1) {
        echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>';
      } else {
        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $prev . '" tabindex="-1">Previous</a></li>';
      }
      ?>
      <?php
      if (isset($_GET['page'])) {
        $active = $_GET['page'];
      } else {
        $active = 1;
      }
      for ($i = 1; $i <= $total_page; $i++) {
        if ($i == $active) {
          echo '<li class="page-item active"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
        } else {
          echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
        }
      }
      ?>
      <?php
      if (isset($_GET['page'])) {
        $next = $_GET['page'] + 1;
      } else {
        $next = 1;
      }
      if ($next - 1 >= $total_page) {
        echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
      } else {
        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $next . '">Next</a></li>';
      }
      ?>
      <?php
      if (isset($_GET['page'])) {
        $last =  $_GET['page'] + $total_page;
      } else {
        $last = $total_page;
      }
      $last = $total_page;
      if ($last  <= $total_page) {
        echo '<li class="page-item ">
        <a class="page-link" href="index.php?page=' . $last . '">Last</a>
        </li>';
      } else {
        echo '<li class="page-item disabled"> <a class="page-link" href="#">Last</a>
        </li>';
      }

      ?>

    </ul>

  <?php }
  ?>

</div>
<?php require_once('../includes/footer.php'); ?>