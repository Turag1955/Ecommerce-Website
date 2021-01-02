<?php
session_start();
unset($_SESSION['users_email']);
unset($_SESSION['users_id']);
header("location:index.php");
?>