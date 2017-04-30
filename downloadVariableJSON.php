<?php
function downloadVariableWithName($var, $name)
{
  header('Content-Disposition: attachment; filename=' . $name . '.json');
  header('Content-Type: application/json');
  echo json_encode($var, true);
}
?>
