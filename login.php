<?php
include ("bd.php");
$resultat = mysql_query("SELECT * FROM users,");
$array = mysql_fetch_array($resultat);
  
printf("$array[login]<br><a  href='profile.php?id=$array[id]'");

?>