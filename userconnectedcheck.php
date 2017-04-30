<?php
session_start();
if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user'] == ''))
{
  echo 'You are not logged in!';
  echo '<br>';
  die('<a href=login.php>Go to Login page</a>');
}
?>
