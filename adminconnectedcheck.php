<?php
if (!isset($_SESSION['admin'])) {
  echo "<title>Warehouse</title>";
  die('You are not admin.' . '<br>' . '<p><a href="warehouse.php">Go to Warehouse</a></p>');
}
?>
