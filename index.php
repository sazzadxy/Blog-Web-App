<?php require_once('includes/header.php'); ?>
<div class="fluid-container">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-md-5 p-3"> 
    <?php require_once('includes/nav.php'); ?>
  </nav>
  <!--End nav-->

  <?php
  $status = "Published";
  $post_per_page = 3;
  $query3 = 'SELECT * FROM post WHERE post_status =:status';
  $stmt3 = $pdo->prepare($query3);
  $stmt3->execute([
    ':status' => $status
  ]);
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

  <section id="main" class="mx-5">
    <h2 class="my-3">All Posts</h2>
    <?php
    $status = 'Published';
    $query = "SELECT * FROM post WHERE post_status = :status LIMIT $page_id, $post_per_page";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
      ':status' => $status
    ]);

    while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $post_id = $post['post_id'];
      $post_title = $post['post_title'];
      $post_des = substr($post['post_des'], 0, 250);
      $post_image = $post['post_img'];
      $post_date = $post['post_date'];
      $post_author = $post['post_author'];
      $post_cat_id = $post['post_cat_id'];
      $post_status = $post['post_status']; ?>


      <div class="row my-4 single-post">
        <img class="col col-lg-4 col-md-12" src="./img/<?php echo $post_image; ?>" alt="Image">
        <div class="media-body col col-lg-8 col-md-12">
          <h5 class="mt-0"><a href="single.php?id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></h5>
          <span class="posted"><a href="categories.php?id=<?php echo $post_cat_id; ?>" class="category">
              <?php

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

            </a> Posted by <?php echo $post_author; ?> at <?php echo $post_date; ?></span>

          <p>
            <?php echo $post_des; ?>
          </p>
          <span><a href="single.php?id=<?php echo $post_id; ?>" class="d-block">See more &rarr;</a></span>
        </div>
      </div>

    <?php } ?>



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


  <?php require_once('includes/footer.php'); ?>