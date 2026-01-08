<?php
session_start();
session_destroy();
header("location:login.php"); 

echo "Selamat Datang ".$_SESSION['username'];
echo "<br><a href= 'logout.php'>Logout</a>"
?>