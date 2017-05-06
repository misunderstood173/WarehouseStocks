<?php
session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] != '')
{
	echo "<title>Warehouse</title>";
	die('You are already logged in. Go to the <a href="warehouse.php">Warehouse</a>');
}
?>

<!doctype html>
<html>
<head>
	<title>Log In to Warehouse</title>
</head>
<body>
	<h3>Log In to Warehouse</h3>
<?php
	$username = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = test_input($_POST["username"]);
		$password = test_input($_POST["password"]);

		try {
			include "connection.php";

			$stmt = $conn->prepare("SELECT employees.ID, employees.Full_name, employees.account_type, employees.enabled FROM employees
															WHERE employees.username=:username AND employees.password=:password");
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password', $password);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if (!$row) {
				echo 'Login Failed !';
			}
			elseif ($row['enabled'] == 0) {
				echo "Account disabled";
			}
			else {
				//log action
				$_SESSION["user"] = $row['Full_name'];
				$_SESSION["ID"] = $row['ID'];
				if ($row['account_type'] == 'admin') {
					$_SESSION['admin'] = True;
				}
				$stmt = $conn->prepare('INSERT INTO employee_log (employee_ID, action_type_ID, description, ip_address)
											VALUES (:id, 1, :description, :ip)');
				$desc = $row['Full_name'] . '[' . $username . '] has logged in';
				include 'ipaddress.php';
				$ip = get_client_ip();
				$stmt->bindParam(':id', $row['ID']);
				$stmt->bindParam(':description', $desc);
				$stmt->bindParam(':ip', $ip);
				$stmt->execute();

				header('Location: warehouse.php');
			}


		} catch (PDOException  $e) {
			echo "Connection failed: " . $e->getMessage();
		}

	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
}

 ?>

<form method="post" action="#">
	<div class="inputField">
		<label for="username">Username: </label>
		<input type="text" id="username" name="username" maxlength="32" tabindex="1" value="<?php echo $username; ?>">
	</div>
	<div class="inputField">
	<label for="password">Password: </label>
	<input type="password" id="password" name="password" maxlength="32" tabindex="2">
	</div>
	<input type="submit" name="btnLogIn" value="Log In" tabindex="3">
</form>
	<p><a href="index.html">Go back</a></p>

</body>
</html>
