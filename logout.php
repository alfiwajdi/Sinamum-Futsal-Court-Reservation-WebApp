<?php
session_start();
unset($_SESSION["user"]);
unset($_SESSION["role"]);
session_destroy();
header("location:frontpage.php?logout=TRUE");
?>