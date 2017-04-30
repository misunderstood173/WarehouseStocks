<?php
include('userconnectedcheck.php');
if (!isset($_SESSION['admin'])) {
  die('You are not admin.' . '<br>' . '<p><a href="warehouse.php">Go to Warehouse</a></p>');
}
?>

<!doctype html>
<html>
<head>
	<title>Add new user</title>
</head>
<body>
<?php
include 'menu.php';
echo buildDefaultMenu();

$full_name = $username = $password = '';
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      try {
        $employee_ID = $_SESSION['ID'];
        $full_name = trim($_POST['full_name']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if ($full_name != '' && $username != '' && $password != '') {
          include 'connection.php';
					include 'getIDqueries.php';

          $sql = $conn->prepare(
            "INSERT INTO employees (Full_name, username, password) VALUES (:full_name, :user, :pass)"
            );
          $sql->bindParam(':full_name', $full_name);
          $sql->bindParam(':user', $username);
          $sql->bindParam(':pass', $password);
          $sql->execute();

					//log action
					$stmt = $conn->prepare('INSERT INTO employee_log (employee_ID, action_type_ID, description, ip_address)
												VALUES (:employee_ID, 6, :description, :ip)');
					$last_id = $conn->lastInsertId();
					$descFormat = 'New user added {full_name:%s , username:%s}';
          $desc = sprintf($descFormat, $full_name, $username);
					include 'ipaddress.php';
					$ip = get_client_ip();
					$stmt->bindParam(':employee_ID', $employee_ID);
					$stmt->bindParam(':description', $desc);
					$stmt->bindParam(':ip', $ip);
					$stmt->execute();

          die('User added successfully !' . '<br>' . '<p><a href="users.php">Go back</a></p>');
        }
        else {
          echo 'All fields required!' . '<br>';
        }

        } catch (PDOException  $e) {
          die("Connection failed: " . $e->getMessage());
        }
      }
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<div class="inputField">
		<label for="full_name">Full name: </label>
		<input type="text" name="full_name" maxlength="255" tabindex="1" value="<?php echo $full_name; ?>">
	</div>
  <div class="inputField">
		<label for="username">Username: </label>
		<input list='countries' name="username" tabindex="2" value="<?php echo $username; ?>">
	</div>
  <div class="inputField">
		<label for="password">Password: </label>
		<input type="text" name="password" tabindex="3" value="<?php echo $password; ?>">
	</div>
	<input type="submit" name="btnAddUser" value="Add New User" tabindex="4">
</form>

</body>
</html>
