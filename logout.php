<?php
session_start();
session_unset();
session_destroy();
header("Location: home.php"); // or use Home.php if you prefer
exit();
?>
