<?php
require 'userconnectedcheck.php';
require 'adminconnectedcheck.php';
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/warehousestocks/css/input.css">
	<title>Edit User</title>
</head>
<body>
<?php
  require 'menu.php';
  echo buildDefaultMenu();
?>

<?php
if (!isset($_POST['user_id'])) {
  die();
}
try {
  require 'connection.php';
  require 'employees.php';

  $user_id = $_POST['user_id'];
  $user = getUserByID($conn, $user_id);

} catch (PDOException  $e) {
  die("Connection failed: " . $e->getMessage());
} catch (Exception $e) {
  die($e->getMessage());
}

?>
<p>Edit User <?php echo $user['username'] ?></p>
<form method="post" action="editUserProcess.php">
  <input type="hidden" name="user_id" value="<?php echo $user['ID']; ?>">
	<div class="inputField">
		<label for="full_name">Full name: </label>
		<input type="text" name="full_name" id="full_name" maxlength="255" tabindex="1" value="<?php echo $user['Full_name']; ?>">
	</div>
  <div class="inputField">
		<label for="username">Username: </label>
		<input type="text" name="username" id="username" tabindex="2" value="<?php echo $user['username']; ?>">
	</div>
  <div class="inputField">
		<label for="password">Password: </label>
		<input type="text" name="password" id="password" tabindex="3" value="">
	</div>
	<input type="submit" name="btnEditUser" value="Edit" tabindex="4">
</form>
<?php include 'footer.html'; ?>
</body>
</html>
