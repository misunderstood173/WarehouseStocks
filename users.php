<?php
require 'userconnectedcheck.php';
require 'adminconnectedcheck.php';
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
	<link rel="stylesheet" href="css/table.css">
	<title>All users</title>
</head>
<body>
<?php
require 'menu.php';
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
  require "connection.php";
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
        <input type="submit" formaction="editUser.php" value="Edit">
        <input type="submit" formaction="userlog.php" value="View log">
  		</td>
  	 </tr>
  	 <input type="hidden" name="user_id" value="%s">
     <input type="hidden" name="user_full_name" value="%s">
  	 </form>
  	 ';
  foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {
      echo sprintf($entryFormat, $result['ID'], $result['Full_name'], $result['username'],
                  $result['password'], $result['account_type'], $result['Account status'],
                  $result['ID'], $result['Full_name']);
  }

} catch (PDOException  $e) {
  echo "Connection failed: " . $e->getMessage();
}

echo '</table>';

?>

<a href="adduser.php">Add new user</a>

</body>
</html>
