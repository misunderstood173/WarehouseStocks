<?php
function AllUnitsOfMeasure()
{
  try {
    require "connection.php";

    $stmt = $conn->prepare(
      "SELECT units_of_measure.ID, units_of_measure.unit_name FROM units_of_measure"
      );
    $stmt->execute();

    $units_of_measure = array();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {
      $units_of_measure[$result['ID']] = $result['unit_name'];
    }
    return $units_of_measure;
  } catch (PDOException  $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}

function getUnitOfMeasureByID($conn, $um_id)
{
  try {
		$sql = $conn->prepare(
			"SELECT units_of_measure.ID, units_of_measure.unit_name, units_of_measure.Abbreviation
      FROM units_of_measure
      WHERE units_of_measure.ID = :um_id"
			);
		$sql->bindParam(':um_id', $um_id);
		$sql->execute();

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		return $row;
	} catch (PDOException  $e) {
		throw new PDOException("Can't get unit of measure " . $e->getMessage());
	}
}

function getUnitOfMeasureByNameAndAbbreviation($conn, $um_name, $um_abbreviation)
{
  try {
		$sql = $conn->prepare(
			"SELECT units_of_measure.ID, units_of_measure.unit_name, units_of_measure.Abbreviation
      FROM units_of_measure
      WHERE units_of_measure.unit_name = :um_name AND units_of_measure.Abbreviation = :um_abbreviation"
			);
		$sql->bindParam(':um_name', $um_name);
    $sql->bindParam(':um_abbreviation', $um_abbreviation);
		$sql->execute();

		$row = $sql->fetch(PDO::FETCH_ASSOC);
		return $row;
	} catch (PDOException  $e) {
		throw new PDOException("Can't get unit of measure " . $e->getMessage());
	}
}
?>
