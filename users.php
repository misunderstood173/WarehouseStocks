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
?>
<h3>All Warehouse Users</h3>
<?php

echo "<table>";
echo "<tr>
      <th>ID</th>
      <th>Full name</th>
      <th>Username</th>
      <th>Password</th>
      <th>Account type</th>
      <th>Account status</th>
			<th>Action</th>
      </tr>";

try {
  include "connection.php";
  $stmt = $conn->prepare(
    'SELECT employees.ID, employees.Full_name, employees.username,
	     employees.password, employees.account_type,
       IF(employees.enabled = 1, "Enabled", "Disabled") as "Account status"
    FROM employees'
    );
  $stmt->execute();

  $entryFormat =
    '<form method="post">
  	<tr>
  	 	<td>%s</td>
  		<td>%s</td>
  	  <td>%s</td>
  	  <td>%s</td>
  	  <td>%s</td>
      <td>%s</td>
  		<td>
  	 	 	<input type="submit" formaction="toggleEnableUser.php" value="Enable/Disable">
  		</td>
  	 </tr>
  	 <input type="hidden" name="user_id" value="%s">
  	 </form>
  	 ';
  foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {
      echo sprintf($entryFormat, $result['ID'], $result['Full_name'], $result['username'],
                  $result['password'], $result['account_type'], $result['Account status'],
                  $result['ID']);
  }

} catch (PDOException  $e) {
  echo "Connection failed: " . $e->getMessage();
}

echo '</table>';

?>

<a href="adduser.php">Add new user</a>

</body>
</html>
