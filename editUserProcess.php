<title>Edit User</title>
<?php
require 'userconnectedcheck.php';
require 'adminconnectedcheck.php';
require 'inputTest.php';

if (isset($_POST['user_id']) && isset($_POST['full_name']) && isset($_POST['username']) && isset($_POST['password'])) {
  $user_id = $_POST['user_id'];
  $user_full_name = inputTest($_POST['full_name']);
  $username = inputTest($_POST['username']);
  $password = inputTest($_POST['password']);

  try {
    if ($user_full_name != '' && $username != '' && $password != '') {
      require 'connection.php';

      $sql = $conn->prepare(
        "UPDATE employees SET Full_name = :user_full_name, username = :username, password = :password
        WHERE employees.ID = :user_id"
        );
      $sql->bindParam(':user_full_name', $user_full_name);
      $sql->bindParam(':username', $username);
      $password_hash = password_hash($password, PASSWORD_DEFAULT);
      $sql->bindParam(':password', $password_hash);
      $sql->bindParam(':user_id', $user_id);
      $sql->execute();

      echo 'User updated successfully !';
    }
    else {
      echo 'All fields required!';
    }

    echo  '<p><a href="/warehousestocks/users.php">Go back</a></p>';

    } catch (PDOException  $e) {
      die("Connection failed: " . $e->getMessage());
    } catch (Exception $e) {
      die($e->getMessage());
    }
}
?>
