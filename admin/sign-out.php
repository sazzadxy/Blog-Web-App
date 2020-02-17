<?php require_once("includes/userAuth.php");?>
<?php

setcookie('_UA_',md5(3), time() - 60*60*24,'','','',true);
header("location:sign-in.php");

?>

<!-- 

<?php
session_start();
//logout.php
setcookie("type", "", time()-3600);
session_destroy();
session_write_close();
header("Location:sign-in.php");

?>

<?php
if (isset($_COOKIE['_UA_'])) {
    header("Location:sign-in.php");
}
?> -->
