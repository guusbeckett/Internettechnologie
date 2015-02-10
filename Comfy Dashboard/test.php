<?php
$con = mysqli_connect("localhost","ipac_user","kissFM","ipac_user");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
else echo "PHP is successfully enabled on this server!"
?>
