<?php
function getEmployeeID ($conn, $employeeName)
{
  $stmt = $conn->prepare("SELECT employees.ID FROM employees WHERE employees.Full_name=:name");
  $stmt->bindParam(':name', $employeeName);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if (! $row) {
    throw new Exception("User not found!");
  }
  return $row['ID'];
}

function getUnitOfMeasureID($conn, $unitOfMeasure)
{
  $stmt = $conn->prepare("SELECT units_of_measure.ID FROM units_of_measure WHERE units_of_measure.unit_name = :name");
  $stmt->bindParam(':name', $unitOfMeasure);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if (! $row) {
    throw new Exception("Unit of Measure not found!");
  }
  return $row['ID'];
}

function getCountryID($conn, $country)
{
  $stmt = $conn->prepare("SELECT countries.ID FROM countries WHERE countries.country_name = :name");
  $stmt->bindParam(':name', $country);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if (! $row) {
    throw new Exception("Country of Origin not found!");
  }
  return $row['ID'];
}
 ?>
