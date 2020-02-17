<?php require_once('includes/header.php'); ?>
<?php
if (isset($_COOKIE['_UA_'])) {
    header("Location:index.php");
}
?>
<div class="container">
    <h2 class="text-uppercase mt-5 sign-in" style="text-align:center">Sign In</h2>
    <?php
    if (isset($_POST['submit'])) {
        $userName = trim($_POST['user-name']);
        $userEmail = trim($_POST['user-email']);
        $userPass = $_POST['user-pass'];
        if (empty($userName) || empty($userEmail) || empty($userPass)) {
            echo "<div class='alert alert-danger' style='text-align:center'>ALL Fields are required!</div>";
        } else {
            $query = "SELECT * FROM user";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $name = $user['user_name'];
                $email = $user['user_email'];
                $pass = $user['user_password'];

                if ($name == $userName && $email == $userEmail && $pass == $userPass) {
                    setcookie('_UA_',md5(3), time() + 60*60*24,'','','',true);
                    header("Location:index.php");
                } else {
                    echo "<div class='alert alert-danger' style='text-align:center'>Wrong Credinatials!</div>";
                }
            }
        }
    }
    ?>

    <form action="sign-in.php" method="POST" class="py-2 d-flex justify-content-center flex-column">
        <div class="form-group m-3">
            <label for="username">Username</label>
            <input type="text" name="user-name" class="form-control" id="username" placeholder="Enter Username">
        </div>
        <div class="form-group m-3">
            <label for="email">Email address</label>
            <input type="email" name="user-email" class="form-control" id="email" placeholder="Enter Email Address">
        </div>
        <div class="form-group m-3">
            <label for="password">Password</label>
            <input type="password" name="user-pass" class="form-control" id="password" placeholder="Enter Password">
        </div>
        <button type="submit" name="submit" class="btn btn-primary m-3 align-self-end">Sign In</button>
    </form>
</div>
<?php require_once('../includes/footer.php'); ?>