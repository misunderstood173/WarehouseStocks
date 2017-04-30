<?php
include('userconnectedcheck.php');
if (!isset($_SESSION['admin'])) {
  die('You are not admin.' . '<br>' . '<p><a href="warehouse.php">Go to Warehouse</a></p>');
}
?>

<!doctype html>
<html>
<head>
	<title>All users</title>
</head>
<body>
<?php

include 'menu.php';
echo buildDefaultMenu();

echo "<table>";
echo "<tr>
      <th>ID</th>
      <th>Full name</th>
      <th>Username</th>
      <th>Password</th>
      <th>Account type</th>
      </tr>";

try {
  include "connection.php";
  $stmt = $conn->prepare(
    "SELECT * FROM employees"
    );
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
      echo sprintf($entryFormat, $result['ID'], $result['Full_name'],
                  $result['username'], $result['password'], $result['account_type']);
  }

} catch (PDOException  $e) {
  echo "Connection failed: " . $e->getMessage();
}

echo '</table>';

?>

<a href="adduser.php">Add new user</a>

</body>
</html>
