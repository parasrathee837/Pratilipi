<?php
ob_start();
session_start();
require_once 'config.php'; 
$sqlQDelete="Delete from tbl_currentview where UserId='".$_SESSION['ADMINID']."'";
mysqli_query($conn, $sqlQDelete);
unset($_SESSION["ADMINID"]);
unset($_SESSION["USER"]);
header("Location:index.php");
?>