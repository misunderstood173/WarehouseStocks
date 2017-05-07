<?php
if (!isset($_SESSION['admin'])) {
  echo "<!DOCTYPE html>";
  echo "<title>Warehouse</title>";
  die('You are not admin.' . '<br>' . '<p><a href="/warehousestocks/warehouse.php">Go to Warehouse</a></p>');
}
?>
