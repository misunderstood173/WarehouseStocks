<?php
function getUserByID($conn, $user_id)
{
  try {
    $sql = $conn->prepare(
      "SELECT employees.ID, employees.Full_name, employees.username, employees.password
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

?>
