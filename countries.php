<?php
function AllCountries()
{
  try {
    include "connection.php";
    $stmt = $conn->prepare(
      "SELECT countries.ID, countries.country_name FROM countries"
      );
    $stmt->execute();

    $countries = array();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {
      $countries[$result['ID']] = $result['country_name'];
    }
    return $countries;
  } catch (PDOException  $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}
?>
