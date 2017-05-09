<?php
function getUserByID($conn, $user_id)
{
	try {
		$sql = $conn->prepare(
			'SELECT employees.ID, employees.Full_name, employees.username,
  	     employees.password, employees.account_type,
         IF(employees.enabled = 1, "Enabled", "Disabled") as "Account status"
      FROM employees
			WHERE employees.ID = :id'
			);
		$sql->bindParam(':id', $user_id);
		$sql->execute();

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		return $row;
	} catch (PDOException  $e) {
		throw new PDOException("Can't get user " . $e->getMessage());
	}
}
?>
