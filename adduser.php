<?php
require 'userconnectedcheck.php';
require 'adminconnectedcheck.php';
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/warehousestocks/css/input.css">
	<title>Add new user</title>
</head>
<body>
<?php
include 'header.php';
?>
  <h3>Add new user</h3>

<?php
$full_name = $username = $password = '';
    if(isset($_POST['full_name']) && isset($_POST['username']) && isset($_POST['password']))
    {
      try {
        require 'inputTest.php';
        $employee_ID = $_SESSION['ID'];
        $full_name = inputTest($_POST['full_name']);
        $username = inputTest($_POST['username']);
        $password = inputTest($_POST['password']);
        if ($full_name != '' && $username != '' && $password != '') {
          require 'connection.php';
					require 'getIDqueries.php';

          $sql = $conn->prepare(
            "INSERT INTO employees (Full_name, username, password) VALUES (:full_name, :user, :pass)"
            );
          $sql->bindParam(':full_name', $full_name);
          $sql->bindParam(':user', $username);
          $password_hash = password_hash($password, PASSWORD_DEFAULT);
          $sql->bindParam(':pass', $password_hash);
          $sql->execute();

					//log action
					$stmt = $conn->prepare('INSERT INTO employee_log (employee_ID, action_type_ID, description, ip_address)
												VALUES (:employee_ID, 6, :description, :ip)');
					$last_id = $conn->lastInsertId();
					$descFormat = 'New user added {full_name:%s , username:%s}';
          $desc = sprintf($descFormat, $full_name, $username);
					require 'ipaddress.php';
					$ip = get_client_ip();
					$stmt->bindParam(':employee_ID', $employee_ID);
					$stmt->bindParam(':description', $desc);
					$stmt->bindParam(':ip', $ip);
					$stmt->execute();

          die('User added successfully !' . '<br>' . '<p><a href="/warehousestocks/users.php">Go back</a></p>');
        }
        else {
          echo 'All fields required!' . '<br>';
        }

        } catch (PDOException  $e) {
          die("Connection failed: " . $e->getMessage());
        }
      }
?>
<form method="post" action="#">
	<div class="inputField">
		<label for="full_name">Full name: </label>
		<input type="text" name="full_name" id="full_name" maxlength="255" tabindex="1" value="<?php echo $full_name; ?>">
	</div>
  <div class="inputField">
		<label for="username">Username: </label>
		<input type="text" name="username" id="username" tabindex="2" value="<?php echo $username; ?>">
	</div>
  <div class="inputField">
		<label for="password">Password: </label>
		<input type="text" name="password" id="password" tabindex="3" value="<?php echo $password; ?>">
	</div>
	<input type="submit" name="btnAddUser" value="Add New User" tabindex="4">
</form>
<?php include 'footer.html'; ?>
</body>
</html>
