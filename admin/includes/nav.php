<!-- <?php session_start();?> -->

      <!-- <nav class="navbar navbar-light px-md-5"  style="background-color: #e3f2fd;"> -->
      <nav class="navbar navbar-expand-lg navbar-light  px-md-5"  style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="./index.php">Admin</a>
      
          <ul class="navbar-nav d-flex flex-row">
            <li class="nav-item">
              <a class="nav-link mr-2 <?php echo (basename($_SERVER['PHP_SELF']) == "index.php")? 'active':''?> " href="./index.php">Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "categories.php")? 'active':''?> " href="./categories.php">Categories</a>
            </li>
          </ul>
          <ul class="navbar-nav d-flex flex-row-reverse">
          <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "sign-out.php")? 'active':'' ?> " href="./sign-out.php">Sign Out</a>
          </li>
          </ul>
      </nav>