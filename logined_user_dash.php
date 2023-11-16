<h1>LOGINED USER DASH</h1>

<?php
session_start();

echo $_SESSION['u_username'];
echo "<br>";
echo $_SESSION['u_name'];
echo "<br>";
echo $_SESSION['u_role'];
?>