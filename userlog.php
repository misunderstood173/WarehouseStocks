<?php
require('userconnectedcheck.php');
$user = $_SESSION['user'];
$user_id = $_SESSION['ID'];
if (isset($_POST['user_id']) && isset($_POST['user_full_name'])) {
	$user = $_POST['user_full_name'];
	$user_id = $_POST['user_id'];
}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/table.css">
	<title><?php echo $user. "'s log"; ?></title>
</head>
<body>
<?php
require 'menu.php';
echo buildDefaultMenu();
?>
	<h3><?php echo $user. "'s log"; ?></h3>
<?php

echo "<table>";
echo "<tr>
      <th>Action</th>
      <th>Description</th>
      <th>Product ID</th>
      <th>Log time</th>
      <th>IP address</th>
      </tr>";

try {
  require "connection.php";
  $stmt = $conn->prepare(
    "SELECT action_type.type, employee_log.description,  employee_log.product_modified_ID,
    employee_log.log_time ,employee_log.ip_address
    FROM employee_log
    JOIN action_type ON employee_log.action_type_ID = action_type.ID
    WHERE employee_log.employee_ID = :employee_ID
    ORDER BY employee_log.log_time DESC"
    );
  $stmt->bindParam(':employee_ID', $user_id);
  $stmt->execute();

  $entryFormat =
  "<tr>
    <td>%s</td>
    <td>%s</td>
    <td>%s</td>
    <td>%s</td>
    <td>%s</td>
  </tr>
  ";
  foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {
      echo sprintf($entryFormat, $result['type'], $result['description'],
                  $result['product_modified_ID'], $result['log_time'], $result['ip_address']);
  }

} catch (PDOException  $e) {
  echo "Connection failed: " . $e->getMessage();
}

echo '</table>';
?>

</body>
</html>
