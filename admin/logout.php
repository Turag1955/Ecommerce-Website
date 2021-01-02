<?php 
require_once '../connection.php';
unset($_SESSION['user_id']);
unset($_SESSION['user_login'] );
unset($_SESSION['user_role']);
header("location:index.php");