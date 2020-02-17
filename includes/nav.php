<a class="navbar-brand" href="index.php" style="font-size: 22px">Blog</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

  <ul class="navbar-nav mr-auto">

    <?php

    $query = 'SELECT * FROM categories';
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    while ($categories = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $cat_id = $categories['cat_id'];
      $cat_title = $categories['cat_title']; ?>

      <li class="nav-item <?php echo $cat_id == $id ? 'active': '';?>">
        <a class="nav-link" href="categories.php?id=<?php echo $cat_id ;?>"><?php echo $cat_title; ?></a>
      </li>

    <?php }


    ?>

  </ul>


  <form class="form-inline my-2 my-lg-0" action="search.php" method="post">
    <input class="form-control mr-sm-2" name="value" style="font-size: 14px" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-info my-2 my-sm-0" type="submit"><span class="glyphicon glyphicon-search"></span>Search</button>
  </form>
</div> 