<?php
function AllUnitsOfMeasure()
{
  try {
    include "connection.php";

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
?>
