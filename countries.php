<?php
function AllCountries()
{
  try {
    require "connection.php";
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

function getCountryById($conn, $id)
{
  try {
    $stmt = $conn->prepare(
      "SELECT countries.ID, countries.country_name
      FROM countries
      WHERE countries.ID = :id"
      );
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;

  } catch (PDOException  $e) {
      throw new PDOException("Can't get country " . $e->getMessage());
  }
}
?>
