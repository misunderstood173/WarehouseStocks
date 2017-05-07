<?php
session_start();
if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user'] == ''))
{
  echo '<!DOCTYPE html>';
  echo "<title>Warehouse</title>";
  echo 'You are not logged in!';
  echo '<br>';
  die('<a href=/warehousestocks/login.php>Go to Login page</a>');
}
?>
