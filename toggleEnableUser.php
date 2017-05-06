<?php
require 'userconnectedcheck.php';
require 'adminconnectedcheck.php';

if (isset($_POST['user_id'])) {
  try {
    require "connection.php";

    $user = getUserByID($conn, $_POST['user_id']);

    $enable_value = $user['enabled'];
    if ($user['enabled'] == '1')
      $enable_value = '0';
    else
      $enable_value = '1';
    setUserEnableById($conn, $_POST['user_id'], $enable_value);

  } catch (PDOException  $e) {
    die("Connection failed: " . $e->getMessage());
  } catch (Exception $e) {
    die($e->getMessage());
  }

  header('Location: users.php');
}

function getUserByID($conn, $user_id)
{
  try {
		$sql = $conn->prepare(
			"SELECT *
			FROM employees
			WHERE employees.ID = :user_id"
			);
		$sql->bindParam(':user_id', $user_id);
		$sql->execute();

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		return $row;
	} catch (PDOException  $e) {
		throw new PDOException("Can't get user " . $e->getMessage());
	}
}

function setUserEnableById($conn, $user_id, $enable_value)
{
  try {
		$sql = $conn->prepare(
			"UPDATE employees
      SET enabled = :enable_value
      WHERE employees.ID = :user_id"
			);
		$sql->bindParam(':user_id', $user_id);
    $sql->bindParam(':enable_value', $enable_value);
		$sql->execute();

	} catch (PDOException  $e) {
		throw new PDOException("Can't enable/disable user " . $e->getMessage());
	}
}
?>
